@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Éxito:</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Estudiantes</span>
                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            Crear Estudiante
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table">
                                <thead>
                                    <tr>
                                        <th class="d-none d-md-table-cell">ID</th>
                                        <th class="d-none d-md-table-cell">Código</th>
                                        <th class="d-none d-md-table-cell">Tipo de ID</th>
                                        <th class="d-none d-md-table-cell">Identificación</th>
                                        <th class="d-none d-md-table-cell">Nombre</th>
                                        <th class="d-none d-md-table-cell">Curso</th>
                                        <th class="d-none d-md-table-cell">Foto</th>
                                        <th class="d-none d-md-table-cell">Fecha de Nacimiento</th>
                                        <th class="d-none d-md-table-cell">Género</th>
                                        <th class="d-none d-md-table-cell">Dirección</th>
                                        <th class="d-none d-md-table-cell">RH</th>
                                        <th class="d-none d-md-table-cell">Enfermedades</th>
                                        <th class="d-none d-md-table-cell">Nombre del Padre</th>
                                        <th class="d-none d-md-table-cell">Teléfono del Padre</th>
                                        <th class="d-none d-md-table-cell">Nombre de la Madre</th>
                                        <th class="d-none d-md-table-cell">Teléfono de la Madre</th>
                                        <th class="d-none d-md-table-cell">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->code }}</td>
                                            <td>{{ $student->idtype }}</td>
                                            <td>{{ $student->identification }}</td>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->course->name }}</td>
                                            <td><img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Foto"
                                                    width="50"></td>
                                            <td>{{ $student->date_of_birth }}</td>
                                            <td>{{ $student->gender }}</td>
                                            <td>{{ $student->address }}</td>
                                            <td>{{ $student->rh }}</td>
                                            <td>{{ $student->diseases }}</td>
                                            <td>{{ $student->father_name }}</td>
                                            <td>{{ $student->father_mobile }}</td>
                                            <td>{{ $student->mother_name }}</td>
                                            <td>{{ $student->mother_mobile }}</td>
                                            <td>
                                                <a href="{{ route('students.show', $student->id) }}"
                                                    class="btn btn-info btn-sm text-white">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('students.edit', $student->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('students.abstract', $student->id) }}"
                                                    class="btn btn-secondary btn-sm text-white">
                                                    <i class="fas fa-book"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let table = new DataTable('#dataTable', {
            responsive: true
        });
    </script>
@endsection
