<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\CourseModel;


class CoursesController extends Controller
{


    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) :
            $record = CourseModel::select('*')->orderBy('id', 'desc');
            return Datatables::of($record)
                ->setRowId(function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    $name = $row->name;
                    return $name;
                })
                ->addColumn('code', function ($row) {
                    $code = $row->code;
                    return $code;
                })
                ->addColumn('actions', function ($row) {
                    $btn =  '
                    <span class="px-2">
                        <a class="text-decoration-none px-1 btn btn-info" href="' . url('/course/edit/' . Crypt::encrypt($row->id)) . '">
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
                        $record->where('name', 'like', '%' . $input . '%')->orwhere('code', 'like', '%' . $input . '%');
                    }
                })
                ->rawColumns(['code', 'actions', 'name'])
                ->make(true);
        endif;

        return view('course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return View('course.add');
    }

    public function save(Request $request)
    {
        // dd($request);
        // return $request;
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
            $post = CourseModel::insert($data);

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
        $post = CourseModel::find($id);
        return View('course.edit', compact('post'));
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

            $post = CourseModel::where('id', $request->id)->update($data);

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
        $data = CourseModel::find($request->id);
        $msg = $data->delete();
        if ($msg) {
            echo json_encode(array('text' => 'Deleted successfully', 'cls' => 'success'));
        } else {
            echo json_encode(array('text' => 'something went wrong', 'cls' => 'error'));
        }
    }
}
