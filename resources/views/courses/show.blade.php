@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Detalles del Curso: {{ $course->name }}
            </div>
            <div class="card-body">
                <h5>Información del Curso:</h5>
                <ul>
                    <li><strong>Nombre:</strong> {{ $course->name }}</li>
                    <li><strong>Descripción:</strong> {{ $course->description }}</li>
                </ul>

                <h5>Estudiantes Inscritos:</h5>
                <ul>
                    @foreach ($course->students as $student)
                        <li>{{ $student->user->name }}</li>
                    @endforeach
                </ul>

                <h5>Materias Relacionadas:</h5>
                <ul>
                    @foreach ($course->subjects as $subject)
                        <li>{{ $subject->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
