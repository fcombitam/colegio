<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();

        return view('students.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'idtype' => ['required', 'in:' . Student::STUDENT_IDTYPE_PASSPORT . ',' . Student::STUDENT_IDTYPE_TI . ',' . Student::STUDENT_IDTYPE_DE],
            'identification' => ['required', 'integer', 'min_digits:5', 'max_digits:20'],
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email', 'unique:users,email'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'date_of_birth' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', 'in:' . Student::STUDENT_GENDER_FEMALE . ',' . Student::STUDENT_GENDER_MALE . ',' . Student::STUDENT_GENDER_OTHER],
            'address' => ['required', 'string', 'max:250'],
            'rh' => ['required', 'string', 'max:250'],
            'diseases' => ['required', 'string', 'max:1000'],
            'father_name' => ['required', 'string', 'max:250'],
            'father_mobile' => ['required', 'integer', 'digits:10'],
            'mother_name' => ['required', 'string', 'max:250'],
            'mother_mobile' => ['required', 'integer', 'digits:10'],
            'profile_picture' => ['nullable', 'image']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'type' => User::USER_TYPE_STUDENT,
            'status' => User::USER_STATUS_ACTIVE
        ]);

        $student = Student::create([
            'idtype' => $request->idtype,
            'identification' => $request->identification,
            'course_id' => $request->course_id,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'rh' => $request->rh,
            'diseases' => $request->diseases,
            'father_name' => $request->father_name,
            'father_mobile' => $request->father_mobile,
            'mother_name' => $request->mother_name,
            'mother_mobile' => $request->mother_mobile,
            'user_id' => $user->id,
            'code' => $this->generateRandomStringStudent()
        ]);

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');

            $fileName = uniqid('profile_') . '.' . $profilePicture->getClientOriginalExtension();

            $profilePicture->storeAs('public/photo-profiles', $fileName);

            $student->profile_picture = 'photo-profiles/'.$fileName;
            $student->save();
        }

        return redirect()->back()->withSuccess('Estudiante creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $courses = Course::all();

        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'idtype' => ['required', 'in:' . Student::STUDENT_IDTYPE_PASSPORT . ',' . Student::STUDENT_IDTYPE_TI . ',' . Student::STUDENT_IDTYPE_DE],
            'identification' => ['required', 'integer', 'min_digits:5', 'max_digits:20'],
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($student->user->id)],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'date_of_birth' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', 'in:' . Student::STUDENT_GENDER_FEMALE . ',' . Student::STUDENT_GENDER_MALE . ',' . Student::STUDENT_GENDER_OTHER],
            'address' => ['required', 'string', 'max:250'],
            'rh' => ['required', 'string', 'max:250'],
            'diseases' => ['required', 'string', 'max:1000'],
            'father_name' => ['required', 'string', 'max:250'],
            'father_mobile' => ['required', 'integer', 'digits:10'],
            'mother_name' => ['required', 'string', 'max:250'],
            'mother_mobile' => ['required', 'integer', 'digits:10'],
            'profile_picture' => ['nullable', 'image']
        ]);

        $user = $student->user;

        $user->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $student->fill([
            'idtype' => $request->idtype,
            'identification' => $request->identification,
            'course_id' => $request->course_id,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'rh' => $request->rh,
            'diseases' => $request->diseases,
            'father_name' => $request->father_name,
            'father_mobile' => $request->father_mobile,
            'mother_name' => $request->mother_name,
            'mother_mobile' => $request->mother_mobile
        ]);

        if ($request->hasFile('profile_picture')) {
            $oldProfilePicture = $student->profile_picture;

            $newProfilePicturePath = $request->file('profile_picture')->store('public/photo-profiles');

            $newProfilePicturePath = str_replace('public/', '', $newProfilePicturePath);

            $student->profile_picture = $newProfilePicturePath;

            if ($oldProfilePicture && File::exists(storage_path("app/public/$oldProfilePicture"))) {
                File::delete(storage_path("app/public/$oldProfilePicture"));
            }
        }

        if (!$user->isDirty() && !$student->isDirty()) {
            return redirect()->back()->withError('Debes modificar al menos un campo');
        }

        $user->save();
        $student->save();

        return redirect()->back()->withSuccess('Estudiante actualizado correctamente');
    }

    public function createNote(Request $request)
    {
        $this->validate($request, [
            'subject_id' => ['required', 'exists:subjects,id'],
            'score' => ['required', 'integer', 'min:0', 'max:10'],
            'note_type' => ['required', 'in:' . Note::NOTE_TYPE_ACTIVITY . ',' . Note::NOTE_TYPE_EVALUATION . ',' . Note::NOTE_TYPE_HOMEWORK],
            'student_id' => ['required', 'exists:students,id'],
            'comments' => ['required', 'string', 'max:1000'],
        ]);

        $student = Student::findOrFail($request->student_id);
        $course = $student->course;

        if (!$course->subjects->contains($request->subject_id)) {
            return redirect()->back()->withError('No puedes hacer esta accion');
        }

        Note::create([
            'type' => $request->note_type,
            'comments' => $request->comments,
            'score' => $request->score,
            'status' => $request->score < 7 ? Note::NOTE_STATUS_FAIL : Note::NOTE_STATUS_APPROVED,
            'student_id' => $student->id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->back()->withSuccess('Nota creada correctamente');
    }

    public function abstract(Student $student)
    {
        return view('students.abstract', compact('student'));
    }
}
