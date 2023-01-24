<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\CourseModel;


class StudentController extends Controller
{

    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) :
            $record = Student::select('*')->with('subjectid')->orderBy('id', 'desc');
            return Datatables::of($record)
                ->setRowId(function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    $name = $row->name;
                    return $name;
                })
                ->addColumn('class', function ($row) {
                    $class = $row->class;
                    return $class;
                })
                ->addColumn('address', function ($row) {
                    $address = $row->address;
                    return $address;
                })
                ->addColumn('gender', function ($row) {
                    switch ($row->gender) {
                        case '1':
                            return 'Male';
                            break;
                        case '2':
                            return 'famale';
                            break;
                    }
                })
                ->addColumn('subject', function ($row) {
                    $subject = $row->subjectid;
                    return $subject->name ?? "-";
                })
                ->addColumn('actions', function ($row) {
                    $btn =  '
                    <span class="px-2">
                        <a class="text-decoration-none px-1 btn btn-info" href="' . url('/student/edit/' . Crypt::encrypt($row->id)) . '">
                        Edit
                        </a>
                    </span>
                    <span>
                        <a class="text-decoration-none px-1 bt btn btn-danger" onClick="destroy(' . $row->id . ')">
                        Delete
                        </a>
                    </span>
                ';
                    return $btn;
                })
                ->filter(function ($record) use ($request) {
                    $input = "";
                    if ($request->has('search_new') && $request->search_new != "") {
                        $input = $request->get("search_new");
                        $record->where('name', 'like', '%' . $input . '%')->orwhere('class', 'like', '%' . $input . '%');
                    }
                })
                ->rawColumns(['class', 'actions', 'name', 'gender', 'subject'])
                ->make(true);
        endif;

        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $courses = CourseModel::get();
        return View('student.add', compact('courses'));
    }

    public function save(Request $request)
    {
        // dd($request);
        // return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'class' => 'required|max:255',
            'address' => 'required|max:255',
            'gender' => 'required|max:255',
            'subject' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            echo json_encode(array('text' => $validator->errors()->all(), 'cls' => 'error'));
        } else {

            $data = [
                'name' => $request->name,
                'class' => $request->class,
                'address' => $request->address,
                'gender' => $request->gender,
                'subject' => $request->subject,
            ];
            $post = Student::insert($data);

            if ($post) {
                echo json_encode(array('text' => 'Saved successfully', 'cls' => 'success'));
            } else {
                echo json_encode(array('text' => 'something went wrong', 'cls' => 'error'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $courses = CourseModel::get();
        $post = Student::find($id);
        return View('student.edit', compact('post', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'code' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            echo json_encode(array('text' => $validator->errors()->all(), 'cls' => 'error'));
        } else {

            $data = [
                'name' => $request->name,
                'code' => $request->code,
            ];

            $post = Student::where('id', $request->id)->update($data);

            if ($post) {
                echo json_encode(array('text' => 'Update successfully', 'cls' => 'success'));
            } else {
                echo json_encode(array('text' => 'something went wrong', 'cls' => 'error'));
            }
        }
    }



    public function destroy(Request $request)
    {
        //    dd($request->id);
        $data = Student::find($request->id);
        $msg = $data->delete();
        if ($msg) {
            echo json_encode(array('text' => 'Deleted successfully', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'something went wrong', 'cls' => 'error'));
        }
    }
}
