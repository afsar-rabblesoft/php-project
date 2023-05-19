<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

defined('IMAGE_UPLOAD_PATH_JOB') or define("IMAGE_UPLOAD_PATH_JOB", public_path() . '/uploads/users/');

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {

        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password,'is_admin'=>1))) {
            Session::flash('success', "Logged in Successfully");
            return redirect('/admin/dashboard');
        } else {
            Session::flash('error', "Please Enter Correct Email and Password");
            return redirect()->back();
        }
    }

    public function show(Request $request)
    {
        return view('admin.index');
    }
    public function showUsers(Request $request)
    {
        $query = User::select();
        if ($request->q && $request->q != '') {
            $keyword = $request->q;
            $query = User::where('name', 'like', "%{$keyword}%")->orWhere('email', 'LIKE', "%{$keyword}%");

            $result = $query->paginate();
        } else {
            $result = $query->paginate(10);
        }
        return view('admin.user', ['result' => $result]);
    }
    public function add(Request $request)
    {

        $requestData = $request->all();
        $rules = [
            'image' => 'sometimes|mimes:jpeg,png,jpg',
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'address' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());

            return redirect()->back();
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(IMAGE_UPLOAD_PATH_JOB, $fileName);
        }else{
            $fileName='';
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->city = $request->city ?? '';
        $user->address = $request->address ?? '';
        $user->state = $request->state ?? '';
        $user->country = $request->country ?? '';
        $user->zipcode = $request->zip ?? '';
        $user->is_admin = 0;
        $user->image = $fileName ?? "";
        $user->save();
        Session::flash('success', "User Added Successfully");

        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $requestData = $request->all();

        $rules = [
            'image' => 'sometimes|mimes:jpeg,png,jpg',
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());

            return redirect()->back();
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(IMAGE_UPLOAD_PATH_JOB, $fileName);
        } else {
            $fileName = explode('users/', $requestData['image2'])[1];
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->city = $request->city;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->zipcode = $request->zip;
        $user->is_admin = 0;
        $user->image = $fileName ?? "";
        $user->save();
        Session::flash('success', "User Updated Successfully");

        return redirect()->back();
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            Session::flash('error', "User Not Exist");

            return redirect()->back();
        }
        $user->delete();
        Session::flash('success', "User Deleted Successfully");

        return redirect('/admin/user');
    }
    public function userdetail($id)
    {
        $result = User::with('surveyinfo','answers.question')->find($id);
        return view('admin.show', ['result' => $result]);
    }

    public function resetPassword(Request $request, $token)
    {
        // Check token is expired or noting happing

        $forgotPasswordEmailObj = ForgotPasswordMail::where('token', $token)->first();
        //
        if (!$forgotPasswordEmailObj) {
            ForgotPasswordMail::where('token', $token)->delete();
            return view('expired-mail');
        };
        $data['token'] = $token;
        $data['email'] = $request->get('email');

        return view('reset')->with(compact('data'));
    }

    public function updatePassword(Request $request)
    {
        $requestData = $request->all();

        $token = $requestData['token'];
        $tokenObj = ForgotPasswordMail::where('token', $token)->first();
        if (!$tokenObj) {
            return view('expired-mail');
        }

        $resourceObj = User::where('email', $requestData['email'])->where('is_admin', 0)->first();

        if (!$resourceObj) {
            return redirect()->route('password.reset',['token' => $requestData['token']])->with('error', 'Invalid request');
        }


        $resourceObj->password = Hash::make($requestData['password']);
        if ($resourceObj->save()) {
            ForgotPasswordMail::where('token', $token)->delete();
        }

        return redirect()->route("congratulation", ['email' => $requestData['email']]);
    }

    public function forgotPassword()
    {
        $data = [];
        //
        return view('admin.forgot-password')->with(compact('data'));
    }
    public function congratulation(Request $request)
    {
        $data = [];
        $requestData = $request->all();

        return view('password-reset-thanks')->with('data');
    }
}
