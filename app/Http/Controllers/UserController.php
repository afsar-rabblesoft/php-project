<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\Answer;
use App\Models\CompletedSurvey;
use App\Models\ForgotPasswordMail;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use App\Models\UserSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use PDF;
class UserController extends Controller
{
    //
    // User login
    public function login(Request $request)
    {
        $response = [];
        $response['success'] = FALSE;


        $requestData = $request->all();
        $rules = [
            'email' => 'required|max:255',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json($response);
        }
        $user = User::where('email', $request->email)->where('is_admin', 0)->first();
        //    $loginResponse = User::login($requestData);
        if (!$user) {
            $response['message'] = "Email Or Password is Incorrect";
            return $response;
        }

        if (!Hash::check($request->password, $user->password)) {
            $response['message'] = "Email Or Password is Incorrect";
            return $response;
        }

        $userObj = $user;
        $token = $userObj->createToken($userObj->id . ' token ')->accessToken;
        $userData = User::where('id', $userObj->id)->first();
        $userData['token'] = $token;
        $response['message'] = "Logged in Successfully";
        $response['data'] = $userData;
        $response['success'] = TRUE;


        return response()->json($response);
    }
    public function index()
    {
        $response = [];
        $response['success'] = FALSE;
        $groups = [];

        $cats = DB::table('questions')->distinct()->select('category_id')->get();

        foreach ($cats as $cat) {
            $groups['category_' . $cat->category_id] = Question::with('title')->select('id', 'category_id', 'question', 'survey_id')->where('category_id', $cat->category_id)->get();
        }

        $response['data'] = $groups;
        $response['success'] = TRUE;

        return response()->json($response);
    }

    public function forgotPassword(Request $request)
    {

        $requestData = $request->all();

        $response = [];
        $response['success'] = FALSE;
        $rules = [
            'email' => 'required|email|max:255'
        ];

        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json($response);
        }

        $token = Str::random(64);
        $userObj = User::where('email', $request->get('email'))->where('is_admin', 0)->first();

        if (!$userObj) {
            $response['message'] = "Please Enter a Valid Email";
            return $response;
        }

        $tokenMailObj = ForgotPasswordMail::where('email', $request->get('email'))->first();

        if (!$tokenMailObj) {
            $tokenMailObj = new ForgotPasswordMail;
        }

        $tokenMailObj->email = $request->get('email');
        $tokenMailObj->token = $token;
        $tokenMailObj->save();

        $mailData = [];
        $mailData['name'] = $userObj->name ?? '';
        $mailData['link'] = route('password.reset', [$token, 'email' => $request->get('email')]);
        Mail::to($request->get('email'))->send(new ForgotPassword($mailData));


        $response['message'] = "Reset Password Link Sent to the Email";
        $response['success'] = TRUE;
        return response()->json($response);
    }
    public function save(Request $request)
    {

        $requestData = $request->all();

        $response = [];
        $response['success'] = FALSE;
        $rules = [
            'survey_id' => 'required|integer',
            'answers' => 'required|array',
        ];

        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json($response);
        }
        $survey = Survey::find($request->survey_id);
        if (!$survey) {
            $response['message'] = "Survey Record Not Found";
            return $response;
        }

        $result = $request->except(['survey_id']);

        DB::beginTransaction();

        foreach ($result['answers'] as $key => $value) {

            if (is_array($value)) {
                $question_id = array_values($value)[0];
                $requestanswer = array_values($value)[1];
            } else {
                $response['message'] = "Data is Not an Array";
                return $response;
            }

            $question = Question::find($question_id);
            if (!$question) {
                DB::rollBack();
                $response['message'] = "Questions Not Found";
                return $response;
            }
            $ans = Answer::where('survey_id', $request->survey_id)->where('question_id', $question->id)->where('user_id', Auth::user()->id)->first();

            if ($ans) {
                DB::rollBack();
                $response['message'] = "Answer Already Exist";
                return $response;
            }
            $answer = new Answer();
            $answer->answer = $requestanswer;
            $answer->question_id = $question_id;
            $answer->survey_id = $request->survey_id;
            $answer->user_id = Auth::user()->id;
            $answer->save();
        }
        DB::commit();
        $completed = new UserSurvey();
        $completed->survey_id = $request->survey_id;
        $completed->user_id = Auth::user()->id;
        $completed->status = 'Completed';
        $completed->save();

        $response['message'] = "Answer Saved Successfully";
        $response['success'] = TRUE;
        return response()->json($response);
    }
    public function pdfgenerate(Request $request){
        $response = [];
        $response['success'] = FALSE;

        $result = User::with('surveyinfo','answers.question')->find(Auth::user()->id);
        $pdfName = $result->name.'-'.$result->created_at;
        $path = 'pdf/'.$pdfName.'-result.pdf';
        $pdf = PDF::loadView('pdf', compact('result'))->setPaper('a4', 'portrait');
        Storage::disk('local')->put($path, $pdf->output());
        // Storage::put($path, $pdf->output());
        
        $response['path']=  $path ;
        $response['message'] = "Pdf Generated Successfully";
        $response['success'] = TRUE;
        return response()->json($response);

     
    }
}
