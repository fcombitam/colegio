@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Detalles de la Materia: {{ $subject->name }}
            </div>
            <div class="card-body">
                @if ($subject->courses->count() > 0)
                    <h4>Estudiantes:</h4>
                    @foreach ($subject->courses as $course)
                        <h5>CURSO: <strong>{{ $course->name }}</strong></h5>
                        <div class="row">
                            @if ($course->students->count() > 0)
                                @foreach ($course->students as $student)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <strong>Estudiante: {{ $student->user->name }}</strong><br>
                                                @foreach ($student->notes->where('subject_id', $subject->id) as $note)
                                                    <strong>Tipo:</strong> {{ $note->type }}<br>
                                                    <strong>Comentarios:</strong> {{ $note->comments }}<br>
                                                    <strong>Nota:</strong> {{ $note->score }}<br>
                                                    <strong>Estado:</strong> {{ $note->status }}<br>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <p>No hay estudiantes en el curso "{{ $course->name }}".</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p>No hay cursos relacionados con esta materia.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
