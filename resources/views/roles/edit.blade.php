@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <link rel="stylesheet" type="text/css" href="{{ url('css/configs.css') }}">
    <h1>Editar Rol</h1>
@stop


@section('content')

    <x-adminlte-card>
        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <x-adminlte-input name="name" label="Nombre" type="text" class="form-control"
                            value="{!! $role->name !!}">

                            <x-slot name="prependSlot">
                                <div class="input-group-text text-purple">
                                    <i class="fas fa-address-card"></i>
                                </div>
                            </x-slot>
                            <x-slot name="bottomSlot">
                                <span class="text-sm text-gray">
                                    [A continuación seleccione los permisos para el nuevo rol]
                                </span>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-start">
                    @foreach ($permission as $clave => $valor)
                        <div class="col-md-3" name="{!! $clave !!}">
                            <x-adminlte-card title="{!! $clave !!}" theme="teal">
                                <?php
                        $cant = count($valor);
                        for($i=0; $i<$cant; $i++){
                        ?>
                                <label>{{ Form::checkbox('permission[]', $valor[$i]->id, in_array($valor[$i]->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                    {{ ' ' . $valor[$i]->name }}</label>
                                <br>
                                <?php
                }
                ?>
                            </x-adminlte-card>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
    </x-adminlte-card>

    <footer class="main-footer">
        {{ Breadcrumbs::render('actualizar_rol') }}
    </footer>

@endsection

@section('css')

@stop

@section('js')
    <script>
        $(window).on("load", function() {
            var mi_variable = '<?php echo $errors->any(); ?>';
            var errorsall = '<?php echo json_encode($errors->all()); ?>';
            var obj = JSON.parse(errorsall);
            if (mi_variable > 0) {
                for (let i = 0; i < obj.length; i++) {
                    toastr.error(obj[i]);
                }

            }
        });
    </script>
@stop
