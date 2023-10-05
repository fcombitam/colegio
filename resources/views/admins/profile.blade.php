@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar Perfil de Administrador: {{ $admin->user->name }}
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

                <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Foto de Perfil</label>
                        <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                            id="profile_picture" name="profile_picture">
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($admin->profile_picture)
                        <div class="mb-3">
                            <label>Foto Actual</label>
                            <br>
                            <img src="{{ asset('storage/' . $admin->profile_picture) }}" alt="Foto Actual" width="150">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="idtype" class="form-label">Tipo de Identificación</label>
                        <select class="form-select @error('idtype') is-invalid @enderror" id="idtype" name="idtype"
                            required>
                            <option value="{{ App\Models\Admin::ADMIN_IDTYPE_DI }}"
                                {{ $admin->idtype === App\Models\Admin::ADMIN_IDTYPE_DI ? 'selected' : '' }}>Documento
                                de Identidad</option>
                            <option value="{{ App\Models\Admin::ADMIN_IDTYPE_PASSPORT }}"
                                {{ $admin->idtype === App\Models\Admin::ADMIN_IDTYPE_PASSPORT ? 'selected' : '' }}>
                                Pasaporte</option>
                            <option value="{{ App\Models\Admin::ADMIN_IDTYPE_DE }}"
                                {{ $admin->idtype === App\Models\Admin::ADMIN_IDTYPE_DE ? 'selected' : '' }}>Documento
                                de Extranjería</option>
                        </select>
                        @error('idtype')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="identification" class="form-label">Número de Identificación</label>
                        <input type="text" class="form-control @error('identification') is-invalid @enderror"
                            id="identification" name="identification" value="{{ $admin->identification }}" required>
                        @error('identification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $admin->user->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $admin->user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <!-- Agrega aquí los campos adicionales del modelo Admin -->
                        <label for="date_of_birth" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                            id="date_of_birth" name="date_of_birth" value="{{ $admin->date_of_birth }}" required>
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Género</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender"
                            required>
                            <option value="{{ App\Models\Admin::ADMIN_GENDER_MALE }}"
                                {{ $admin->gender === App\Models\Admin::ADMIN_GENDER_MALE ? 'selected' : '' }}>
                                Masculino</option>
                            <option value="{{ App\Models\Admin::ADMIN_GENDER_FEMALE }}"
                                {{ $admin->gender === App\Models\Admin::ADMIN_GENDER_FEMALE ? 'selected' : '' }}>
                                Femenino</option>
                            <option value="{{ App\Models\Admin::ADMIN_GENDER_OTHER }}"
                                {{ $admin->gender === App\Models\Admin::ADMIN_GENDER_OTHER ? 'selected' : '' }}>Otro
                            </option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ $admin->address }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
