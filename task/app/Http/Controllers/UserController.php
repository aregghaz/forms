<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Forms;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {

        $inputs = $request->all();
        $count = 0;
        $data = Array();
        foreach ($inputs as $key => $value) {
            if ($key !== 'formName' and $key !== '_token') {
                $data[$count] = $key;
                $count++;
            }

        }

        $form = new Forms();
        $form->field = $data;
        $form->formName = $inputs["formName"];
        $form->save();
        return redirect('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $forms = DB::table('forms')->get();
        return view('welcome', ['forms' => $forms]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function submitForm(Request $request)
    {
        $answers = new Answers();
        $inputs = $request->all();
        $ip =$request->ip();

        $count = 0;
        $data = Array();
        foreach ($inputs as $key => $value) {
            if ( $key!== 'formId' and $key !== '_token') {
                $data[$count] = $value;
                $count++;
            }

        }
        $answers->field_answers = $data;
        $answers->formId = $inputs["formId"];
        $answers->ip_address = $ip;
        $answers->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $formName = $request['formName'];
        $data = $request['data'];
        $id = $request['formId'];
        $form = Forms::find($id);
        $form->field = $data;
        $form->formName = $formName;
        $form->save();
    }


}
