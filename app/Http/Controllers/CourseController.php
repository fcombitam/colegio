<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:1000'],
        ]);

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $this->generateRandomStringCourse(),
            'status' => Course::COURSE_STATUS_ACTIVE,
        ]);

        return redirect()->back()->withSuccess('Curso modificado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:1000'],
            'status' => ['required', 'string', 'in:' . Course::COURSE_STATUS_ACTIVE . ',' . Course::COURSE_STATUS_INACTIVE]
        ]);

        $course->fill([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        if (!$course->isDirty()) {
            return redirect()->back()->withError('Debes modificar un campo');
        }

        $course->save();

        return redirect()->back()->withSuccess('Curso modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
