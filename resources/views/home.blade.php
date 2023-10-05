@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (auth()->user()->type == App\Models\User::USER_TYPE_ADMIN)
                        <div class="alert alert-info">
                            <h3>Bienvenido, {{ auth()->user()->name }}!</h3>
                            <p>¡Estás autenticado como administrador en la plataforma!</p>
                            <p>Aquí puedes gestionar y supervisar todas las operaciones de la plataforma. ¡Disfruta de tu acceso privilegiado!</p>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h3>¡Hola, {{ auth()->user()->name }}!</h3>
                            <p>Gracias por utilizar nuestra plataforma educativa.</p>
                            <p>Estamos trabajando duro para mejorar tu experiencia. Lamentablemente, esta sección aún está en construcción para estudiantes.</p>
                            <p>Pronto estará disponible con nuevas características y recursos que te ayudarán en tu aprendizaje.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
