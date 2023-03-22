@extends('adminlte::page')

@section('title', 'Ver Rol')

@section('content_header')
    <h1>Ver Rol</h1>
@stop


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div>

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


@endsection

@section('css')

@stop

@section('js')
    <script></script>
@stop
