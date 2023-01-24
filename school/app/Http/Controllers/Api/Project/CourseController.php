<?php

namespace App\Http\Controllers\Api\Project;

use Illuminate\Support\Str;
use App\Traits\SendResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use App\Traits\ApiLanguageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CourseController extends Controller
{
    use SendResponse;

    public function index(){
        $CourseModel = CourseModel::get();
        return $this->sendGeneralResponse(true,  'CourseModel', 'Success', ['response' => $CourseModel], 200);
    }
    public function save(Request $request)
    {
        // dd($request->all());
        try {
            $validateRequest =
                [
                    'code' => 'required',
                    'name' => 'required|unique:course',
                ];
            $messages = [
                'name.required' =>  'Course name is required',
                'code' =>  'Course Code  is required',
            ];
            $validator = Validator::make($request->all(), $validateRequest, $messages);
            if ($validator->fails()) {
                $errors = implode("\n", $validator->messages()->all());
                return $this->sendError($errors, '',  200, 'Home');
            }
            $data = [
                'code' => $request->code,
                'name' => $request->name,
            ];
            CourseModel::create($data);
            return $this->sendGeneralResponse(true, 'Course Added Successfully','Success', ['response' => "success"], 200);
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
                    'code' => 'required',
                    'name' => 'required|unique:course',
                ];
            $messages = [
                'name.required' =>  'Course name is required',
                'code' =>  'Course Code  is required',
            ];
            $validator = Validator::make($request->all(), $validateRequest, $messages);
            if ($validator->fails()) {
                $errors = implode("\n", $validator->messages()->all());
                return $this->sendError($errors, '',  200, 'Home');
            }
            $data = [
                'code' => $request->code,
                'name' => $request->name,
            ];

            CourseModel::where('id', $request->id)->update($data);
            return $this->sendGeneralResponse(true, 'Course Updated Successfully','Success', ['response' => "success"], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function destroy(Request $request)
    {
        $CourseModel = CourseModel::find($request->id);
        $CourseModel->delete();
        return response()->json(['success' => true,'status' => 200,  'message' => 'Course deleted succesfully',], 200);
    }
}
