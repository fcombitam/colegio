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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Materias</span>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createSubjectModal">
                            Crear Materia
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Profesor</th>
                                    <th>Aula</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->id }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->code }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>{{ $subject->teacher }}</td>
                                        <td>{{ $subject->classroom }}</td>
                                        <td>{{ $subject->status }}</td>
                                        <td>
                                            <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-info btn-sm text-white">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm"
                                                onclick="abrirModalEdit('{{ $subject->id }}', '{{ $subject->name }}', '{{ $subject->description }}', '{{ $subject->teacher }}', '{{ $subject->classroom }}', '{{ $subject->status }}')">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('¿Estas seguro de eliminar esta materia?')" type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
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

    <!-- MODAL CREATE SUBJECT -->
    <div class="modal fade" id="createSubjectModal" tabindex="-1" aria-labelledby="createSubjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSubjectModalLabel">Crear Materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subjects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" required>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="teacher" class="form-label">Profesor</label>
                            <input type="text" class="form-control @error('teacher') is-invalid @enderror" id="teacher"
                                name="teacher" required>
                            @error('teacher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="classroom" class="form-label">Aula</label>
                            <input type="text" class="form-control @error('classroom') is-invalid @enderror"
                                id="classroom" name="classroom" required>
                            @error('classroom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL CREATE SUBJECT -->

    <!-- MODAL EDIT SUBJECT -->
    <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubjectModalLabel">Editar <span id="span-name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subjects.update') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="edit_id" name="edit_id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('edit_name') is-invalid @enderror"
                                id="edit_name" name="edit_name" required>
                            @error('edit_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Descripción</label>
                            <input type="text" class="form-control @error('edit_description') is-invalid @enderror"
                                id="edit_description" name="edit_description" required>
                            @error('edit_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_teacher" class="form-label">Profesor</label>
                            <input type="text" class="form-control @error('edit_teacher') is-invalid @enderror"
                                id="edit_teacher" name="edit_teacher" required>
                            @error('edit_teacher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_classroom" class="form-label">Aula</label>
                            <input type="text" class="form-control @error('edit_classroom') is-invalid @enderror"
                                id="edit_classroom" name="edit_classroom" required>
                            @error('edit_classroom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_classroom" class="form-label">Estado</label>
                            <select name="edit_status" id="edit_status"
                                class="form-control @error('edit_status') is-invalid @enderror" required>
                                <option value="{{ App\Models\Subject::SUBJECT_STATUS_ACTIVE }}">
                                    {{ App\Models\Subject::SUBJECT_STATUS_ACTIVE }}
                                </option>
                                <option value="{{ App\Models\Subject::SUBJECT_STATUS_INACTIVE }}">
                                    {{ App\Models\Subject::SUBJECT_STATUS_INACTIVE }}
                                </option>
                            </select>

                            @error('edit_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL EDIT SUBJECT -->
@endsection

@section('scripts')
    <script>
        function abrirModalEdit(id, name, description, teacher, classroom, estado) {
            $('#editSubjectModal').modal('show');
            $("#edit_id").val(id);
            $("#edit_name").val(name);
            $("#edit_description").val(description);
            $("#edit_teacher").val(teacher);
            $("#edit_classroom").val(classroom);
            $("#edit_status").val(estado);
            $("#span-name").text(name);
        }
    </script>
    <script>
        let table = new DataTable('#dataTable', {
            responsive: true
        });
    </script>
@endsection
