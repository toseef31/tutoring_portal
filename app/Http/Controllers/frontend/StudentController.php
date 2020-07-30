<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Student;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $students = Student::where('user_id',auth()->user()->id)->paginate(15);
        $student_mobile = Student::where('user_id',auth()->user()->id)->paginate(1);
        return view('frontend.dashboard.students',compact('students','student_mobile'));
    }

    public function addEditStudent(Request $request){
      // dd($request->all());
      $student_id = 0;
        $rPath = $request->segment(3);
        if($request->isMethod('post')){
            // dd($request->all());
            $student_id = $request->input('student_id');
            $this->validate($request, [
                'student_name' => 'required|max:100',
                'grade' => 'required',
                'college' => 'required',
                'subject' => 'required',
            ],
            [
                'student_name.max'  => 'Student name just be less then 100 characters',
            ]
            );

            $student = new Student;
            $student->user_id =auth()->user()->id;
            $student->student_name = $request->input('student_name');
            $student->grade = $request->input('grade');
            $student->email = $request->input('student_email');
            $student->college = $request->input('college');
            $student->subject = $request->input('subject');
            $student->goal = $request->input('goal');
            if($student_id == ''){
                $student_id = $student->save();
                $sMsg = 'New Student Added';
            }else{
                $student='';
                $student = Student::findOrFail($student_id);
                $student->user_id =auth()->user()->id;
                $student->student_name = $request->input('student_name');
                $student->grade = $request->input('grade');
                $student->email = $request->input('student_email');
                $student->college = $request->input('college');
                $student->subject = $request->input('subject');
                $student->goal = $request->input('goal');
                $student_id = $student->save();
                $sMsg = 'Student Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('user-portal/students');
        }else{
            $student = array();
            $student_id = '0';
            if($rPath == 'edit'){
                $student_id = $request->segment(4);
                $student = Student::findOrFail($student_id);
                if($student == null){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('user-portal/students');
                }
                // dd($student);
            }
            return view('frontend.dashboard.add-edit-students',compact('student','rPath','student_id'));
        }
    }

    public function deleteStudent(Request $request){
      // dd($request->all());
    	if($request->isMethod('delete')){
    		$student_id = trim($request->input('student_id'));
        $student = Student::find($student_id);
        $student->delete();
    		$request->session()->flash('message' , 'Student Deleted Successfully');
    	}
    	return redirect(url()->previous());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
