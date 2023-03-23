@extends('adminlte::page')

@section('title', 'Ver Rol')

@section('content_header')
    <link rel="stylesheet" type="text/css" href="{{ url('css/configs.css') }}">
    <h1>Ver Rol</h1>
@stop


@section('content')

    <x-adminlte-card>
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Rol:</strong>
                        {{ $role->name }}
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Permisos:</strong>
                        @if (!empty($rolePermissions))
                            @foreach ($rolePermissions as $key => $value)
                                <ul>
                                    <li>{{ $value->name }}</li>
                                </ul>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-adminlte-card>

    <footer class="main-footer">
        {{ Breadcrumbs::render('ver_rol') }}
    </footer>
@endsection

@section('css')

@stop

@section('js')
    <script></script>
@stop
