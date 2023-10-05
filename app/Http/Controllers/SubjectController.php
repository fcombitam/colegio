<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:250'],
            'description' => ['required', 'string', 'max:1000'],
            'teacher' => ['required', 'string', 'max:250'],
            'classroom' => ['required', 'string', 'max:250']
        ]);

        Subject::create([
            'code' => $this->generateRandomStringSubject(),
            'name' => $request->name,
            'description' => $request->description,
            'teacher' => $request->teacher,
            'classroom' => $request->classroom,
            'status' => Subject::SUBJECT_STATUS_ACTIVE
        ]);

        return redirect()->back()->withSuccess('Materia Creada Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject->load('notes', 'courses');

        return view('subjects.show', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'edit_id' => ['required', 'exists:subjects,id'],
            'edit_name' => ['required', 'string', 'max:250'],
            'edit_description' => ['required', 'string', 'max:1000'],
            'edit_teacher' => ['required', 'string', 'max:250'],
            'edit_classroom' => ['required', 'string', 'max:250'],
            'edit_status' => ['required', 'in:' . Subject::SUBJECT_STATUS_ACTIVE . ',' . Subject::SUBJECT_STATUS_INACTIVE]
        ]);

        $subject = Subject::findOrFail($request->edit_id);

        $subject->fill([
            'name' => $request->edit_name,
            'description' => $request->edit_description,
            'teacher' => $request->edit_teacher,
            'classroom' => $request->edit_classroom,
            'status' => $request->edit_status,
        ]);

        if (!$subject->isDirty()) {
            return redirect()->back()->withError('Debes modificar algun campo');
        }

        $subject->save();

        return redirect()->back()->withSuccess('Materia modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if ($subject->courses->count() > 0 || $subject->notes->count() > 0) {
            return redirect()->back()->withError('No puedes eliminar materias con notas o cursos asociados');
        }

        $subject->delete();

        return redirect()->back()->withSuccess('Materia eliminada correctamente');
    }
}
