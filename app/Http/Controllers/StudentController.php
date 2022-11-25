<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\School;
use \Illuminate\Http\Request;

class StudentController extends Controller
{
    private $limit = 8;
    /**
     * Display a listing of the resource.
     *.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq)
    {
        $page = $rq['page'] ?? 1;
        $students = Student::with('school')->orderBy('created_at', 'asc')
                                ->skip(($page-1)*$this->limit)->take($this->limit)->get();

        return ['objects' => $students];
    }

    /**
     * Get numbers of students'pages
     * 
     * @return \Illuminate\Http\Response
     */
    public function getPageNum()
    {
        return ['pageNum' => ceil(Student::count()/$this->limit)];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Student::insert([
            'stu_id' => $request->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'email' => $request->email,
            'school_id' => $request->school,
            'identification' => $request->identification,
            'phone' => $request->phone,
            'username' => $request->username,
            'address' => $request->address
        ]);

        return response()->json(['msg' => 'Thêm sinh viên mới thành công'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return response()->json(['student' => $student], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Student::where('stu_id', $id)->
            update([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'school_id' => $request->school,
            'identification' => $request->identification,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return response()->json(['msg' => 'Cập nhật thông tin sinh viên thành công'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::destroy($id);

        return response()->json(['msg' => 'Sinh viên mã' . $id . 'đã được xóa'], 200);
    }
}
