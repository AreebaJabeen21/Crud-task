<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Student, Course};
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::withTrashed()->get();
        return view('students.students-list', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action_route = route('student.store');
        $courses = Course::all();

        return view('students.add-student', compact('action_route', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required',
            'cnic' => 'required|unique:students',
            'dob' => 'required|date',
            'age' => 'required|numeric',
            'gender' => 'required',
            'course' => 'nullable',
        ]);
dd($request -> course);
        $is_created= Student::create($validated_data);
        $latest_added_student = Student::latest()->first();
        $store = $latest_added_student->courses()->sync([$request -> course]);

        if(!$is_created) {
            return redirect()->back()->with(['message' => 'Something Went wrong']);
        }
        return redirect()->back()->with(['message' => 'Student added successfully!']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::withTrashed()->find( $id);
        return view('students.single-student', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::where('id', $id)
        ->withTrashed()
        ->firstOrfail();
        $action_route = route('student.update', [$students->id]);
        return view('students.add-student', compact('students', 'action_route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated_data = $request->validate([
            'name' => 'required',
            'cnic' => 'required',
            'dob' => 'required|date',
            'age' => 'required|numeric',
            'gender' => 'required',
            // 'course' => 'required|digits:4',
        ]);

        $is_student_updated = Student::where('id', $id)
            ->withTrashed()
            ->update($validated_data);
        if (!$is_student_updated) {
            return redirect()->back()->with(['message' => 'Something Went wrong']);
        }
        return redirect()->back()->with(['message' => 'Student Updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $is_student_deleted = student::where('id', $id)->delete();

        if ($is_student_deleted) {
            return back()->with(['message'=> 'Deactivated!']);
        }

        return back()->with(['message'=> 'Something went wrong, please try again!']);
    }

      /**
     * restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $is_student_restored = Student::where('id', $id)->restore();

        if ($is_student_restored) {
            return back()->with(['message'=> 'Actiavted!']);
        }

        return back()->with(['message'=> 'Something went wrong, please try again!']);
    }
}
