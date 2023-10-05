@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Boletín Académico de {{ $student->user->name }}
            </div>
            <div class="card-body">
                <h5>Curso del Estudiante:</h5>
                <p><strong>Nombre del Curso:</strong> {{ $student->course->name }}</p>

                <h5>Materias y Notas:</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Materia</th>
                            <th>Nota</th>
                            <th>Tipo de Nota</th>
                            <th>Comentarios</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student->course->subjects as $subject)
                            <tr>
                                <td>{{ $subject->name }}</td>
                                @php
                                    $note = $student->notes->where('subject_id', $subject->id)->first();
                                @endphp
                                @if ($note)
                                    <td>{{ $note->score }}</td>
                                    <td>{{ $note->type }}</td>
                                    <td>{{ $note->comments }}</td>
                                @else
                                    <td>No disponible</td>
                                    <td>No disponible</td>
                                    <td>No disponible</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
