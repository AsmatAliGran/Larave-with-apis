<?php

namespace App\Http\Controllers\Api\Project;

use Illuminate\Support\Str;
use App\Traits\SendResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use App\Models\Student;
use App\Traits\ApiLanguageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    use SendResponse;

    public function index(){
        $Student = Student::get();
        return $this->sendGeneralResponse(true,  'Student', 'Success', ['response' => $Student], 200);
    }
    public function save(Request $request)
    {
        // dd($request->all());
        try {
            $validateRequest =
                [
                    'name' => 'required',
                    'class' => 'required',
                    'address' => 'required',
                    'gender' => 'required',
                    'subject' => 'required',
                ];
            $messages = [
                'name.required' =>  'Student name is required',
                'class' =>  'Class  is required',
                'address' =>  'Class  is required',
                'gender' =>  'Class  is required',
                'subject' =>  'Class  is required',
            ];
            $validator = Validator::make($request->all(), $validateRequest, $messages);
            if ($validator->fails()) {
                $errors = implode("\n", $validator->messages()->all());
                return $this->sendError($errors, '',  200, 'Home');
            }
            $data = [
                'name' => $request->name,
                'class' => $request->class,
                'address' => $request->address,
                'gender' => $request->gender,
                'subject' => $request->subject,
            ];
            Student::create($data);
            return $this->sendGeneralResponse(true, 'Student Added Successfully','Success', ['response' => "success"], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

 
    
    public function update(Request $request)
    {
        // dd($request->all());
        try {
            $validateRequest =
            [
                'name' => 'required',
                'class' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'subject' => 'required',
            ];
        $messages = [
            'name.required' =>  'Student name is required',
            'class' =>  'Class  is required',
            'address' =>  'Class  is required',
            'gender' =>  'Class  is required',
            'subject' =>  'Class  is required',
        ];
        $validator = Validator::make($request->all(), $validateRequest, $messages);
        if ($validator->fails()) {
            $errors = implode("\n", $validator->messages()->all());
            return $this->sendError($errors, '',  200, 'Home');
        }
        $data = [
            'name' => $request->name,
            'class' => $request->class,
            'address' => $request->address,
            'gender' => $request->gender,
            'subject' => $request->subject,
        ];

            Student::where('id', $request->id)->update($data);
            return $this->sendGeneralResponse(true, 'Student Updated Successfully','Success', ['response' => "success"], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function destroy(Request $request)
    {
        $Student = Student::find($request->id);
        $Student->delete();
        return response()->json(['success' => true,'status' => 200,  'message' => 'student deleted succesfully',], 200);
    }
}
