@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar Estudiante: {{ $student->user->name }}
            </div>
            <div class="card-body">
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

                <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Foto del Estudiante</label>
                        <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                            id="profile_picture" name="profile_picture">
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($student->profile_picture)
                        <div class="mb-3">
                            <label>Foto Actual</label>
                            <br>
                            <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Foto Actual" width="150">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="idtype" class="form-label">Tipo de Identificación</label>
                        <select class="form-select @error('idtype') is-invalid @enderror" id="idtype" name="idtype"
                            required>
                            <option value="{{ App\Models\Student::STUDENT_IDTYPE_TI }}"
                                {{ $student->idtype === App\Models\Student::STUDENT_IDTYPE_TI ? 'selected' : '' }}>Tarjeta
                                de Identidad</option>
                            <option value="{{ App\Models\Student::STUDENT_IDTYPE_PASSPORT }}"
                                {{ $student->idtype === App\Models\Student::STUDENT_IDTYPE_PASSPORT ? 'selected' : '' }}>
                                Pasaporte</option>
                            <option value="{{ App\Models\Student::STUDENT_IDTYPE_DE }}"
                                {{ $student->idtype === App\Models\Student::STUDENT_IDTYPE_DE ? 'selected' : '' }}>
                                Documento de Extranjería</option>
                        </select>
                        @error('idtype')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="identification" class="form-label">Número de Identificación</label>
                        <input type="text" class="form-control @error('identification') is-invalid @enderror"
                            id="identification" name="identification" value="{{ $student->identification }}" required>
                        @error('identification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $student->user->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $student->user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Curso</label>
                        <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id"
                            required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $student->course_id === $course->id ? 'selected' : '' }}>{{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                            id="date_of_birth" name="date_of_birth" value="{{ $student->date_of_birth }}" required>
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Género</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender"
                            required>
                            <option value="{{ App\Models\Student::STUDENT_GENDER_MALE }}"
                                {{ $student->gender === App\Models\Student::STUDENT_GENDER_MALE ? 'selected' : '' }}>
                                Masculino</option>
                            <option value="{{ App\Models\Student::STUDENT_GENDER_FEMALE }}"
                                {{ $student->gender === App\Models\Student::STUDENT_GENDER_FEMALE ? 'selected' : '' }}>
                                Femenino</option>
                            <option value="{{ App\Models\Student::STUDENT_GENDER_OTHER }}"
                                {{ $student->gender === App\Models\Student::STUDENT_GENDER_OTHER ? 'selected' : '' }}>Otro
                            </option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ $student->address }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rh" class="form-label">RH</label>
                        <input type="text" class="form-control @error('rh') is-invalid @enderror" id="rh"
                            name="rh" value="{{ $student->rh }}" required>
                        @error('rh')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="diseases" class="form-label">Enfermedades</label>
                        <input type="text" class="form-control @error('diseases') is-invalid @enderror"
                            id="diseases" name="diseases" value="{{ $student->diseases }}" required>
                        @error('diseases')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="father_name" class="form-label">Nombre del Padre</label>
                        <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                            id="father_name" name="father_name" value="{{ $student->father_name }}" required>
                        @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="father_mobile" class="form-label">Teléfono del Padre</label>
                        <input type="text" class="form-control @error('father_mobile') is-invalid @enderror"
                            id="father_mobile" name="father_mobile" value="{{ $student->father_mobile }}" required>
                        @error('father_mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mother_name" class="form-label">Nombre de la Madre</label>
                        <input type="text" class="form-control @error('mother_name') is-invalid @enderror"
                            id="mother_name" name="mother_name" value="{{ $student->mother_name }}" required>
                        @error('mother_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mother_mobile" class="form-label">Teléfono de la Madre</label>
                        <input type="text" class="form-control @error('mother_mobile') is-invalid @enderror"
                            id="mother_mobile" name="mother_mobile" value="{{ $student->mother_mobile }}" required>
                        @error('mother_mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
