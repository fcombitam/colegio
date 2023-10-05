@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Detalles del Estudiante: {{ $student->user->name }}
            </div>
            <div class="card-body">
                <h5>Información del Estudiante:</h5>
                <ul>
                    <li><strong>Nombre:</strong> {{ $student->user->name }}</li>
                    <li><strong>Correo Electrónico:</strong> {{ $student->user->email }}</li>
                    <li><strong>Tipo de Identificación:</strong> {{ $student->idtype }}</li>
                    <li><strong>Número de Identificación:</strong> {{ $student->identification }}</li>
                    <li><strong>Fecha de Nacimiento:</strong> {{ $student->date_of_birth }}</li>
                    <li><strong>Género:</strong> {{ $student->gender }}</li>
                    <li><strong>Dirección:</strong> {{ $student->address }}</li>
                    <li><strong>RH:</strong> {{ $student->rh }}</li>
                    <li><strong>Enfermedades:</strong> {{ $student->diseases }}</li>
                    <li><strong>Nombre del Padre:</strong> {{ $student->father_name }}</li>
                    <li><strong>Teléfono del Padre:</strong> {{ $student->father_mobile }}</li>
                    <li><strong>Nombre de la Madre:</strong> {{ $student->mother_name }}</li>
                    <li><strong>Teléfono de la Madre:</strong> {{ $student->mother_mobile }}</li>
                </ul>

                <h5>Curso del Estudiante:</h5>
                <p><strong>Nombre del Curso:</strong> {{ $student->course->name }}</p>

                <h5>Materias del Estudiante:</h5>
                <ul>
                    @foreach ($student->course->subjects as $subject)
                        <li>{{ $subject->name }}</li>
                    @endforeach
                </ul>

                <h5>Agregar Notas:</h5>
                <form action="{{ route('students.notes.store', $student->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" class="form-control @error('student_id') is-invalid @enderror" id="student_id"
                            name="student_id" value="{{ $student->id }}" required>
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Materia</label>
                        <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id"
                            name="subject_id" required>
                            @foreach ($student->course->subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="score" class="form-label">Nota</label>
                        <input type="text" class="form-control @error('score') is-invalid @enderror" id="score"
                            name="score" required>
                        @error('score')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="note_type" class="form-label">Tipo de Nota</label>
                        <select class="form-select @error('note_type') is-invalid @enderror" id="note_type" name="note_type"
                            required>
                            <option value="">
                                Selecciona...</option>
                            <option value="{{ App\Models\Note::NOTE_TYPE_ACTIVITY }}"
                                {{ old('note_type') === App\Models\Note::NOTE_TYPE_ACTIVITY ? 'selected' : '' }}>
                                Actividad</option>
                            <option value="{{ App\Models\Note::NOTE_TYPE_HOMEWORK }}"
                                {{ old('note_type') === App\Models\Note::NOTE_TYPE_HOMEWORK ? 'selected' : '' }}>Tarea
                            </option>
                            <option value="{{ App\Models\Note::NOTE_TYPE_EVALUATION }}"
                                {{ old('note_type') === App\Models\Note::NOTE_TYPE_EVALUATION ? 'selected' : '' }}>
                                Evaluación</option>
                        </select>
                        @error('note_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comments" class="form-label">Comentarios</label>
                        <textarea class="form-control @error('comments') is-invalid @enderror" id="comments" name="comments" rows="3">{{ old('comments') }}</textarea>
                        @error('comments')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Agregar Nota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
