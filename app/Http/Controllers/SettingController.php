<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class SettingController extends Controller
{
    //
    public function index()
    {
        
        $result = Survey::get();
        return view('admin.setting', ['result' => $result]);
    }
    public function addtitle(Request $request)
    {
        $requestData = $request->all();
        $rules = [
            'title' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());

            return redirect()->back();
        }
        if (!isset($request->survey_id)) {
            $survey = new Survey();
            $survey->title = $request->title;
            $survey->save();
            Session::flash('success', "Title Added Successfully");

            return redirect()->back();
        } else {

            $survey = Survey::find($request->survey_id);
            $survey->title = $request->title;
            $survey->save();
            Session::flash('success', "Title Updated Successfully");

            return redirect()->back();
        }
    }
    public function addquestions(Request $request)
    {
        // unset($request['_token']);
        // unset($request['category']);
        $questions = $request->except('_token', 'category', 'survey_id');
        foreach ($questions as $key => $value) {
            $ques = new Question();
            $ques->survey_id = $request->survey_id;
            $ques->category_id = $request->category;
            $ques->question = $value;
            $ques->save();
        }

        Session::flash('success', "Questions Added Successfully");

        return redirect()->back();
    }
    public function surveys()
    {
        return view('admin.survey');
    }
}
