@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <link rel="stylesheet" type="text/css" href="{{ url('css/configs.css') }}">
    <h1>Roles</h1>
@stop

@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div align="left">
                @can('role-create')
                    <a class="btn btn-success" label="Crear Rol" href="{{ route('roles.create') }}" />
                    <i class="fas fa-solid fa-plus"></i> Crear Rol
                    </a>
                @endcan
            </div>

        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-sm">

                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th style="width:5%" dt-no-export>Accion(es)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <nobr>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                        name="form<?php echo $role->id; ?>" id="form<?php echo $role->id; ?>">
                                        <a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Ver"
                                            href="{{ route('roles.show', $role->id) }}">
                                            <i class="fa fa-lg fa-fw fa-eye"></i>
                                        </a>
                                        @can('role-edit')
                                            <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar"
                                                href="{{ route('roles.edit', $role->id) }}">
                                                <i class="fa fa-lg fa-fw fa-pen"></i>
                                            </a>
                                        @endcan

                                        @can('role-delete')
                                            @method('DELETE')
                                            @csrf
                                            <button class='btn btn-xs btn-default text-danger mx-1 shadow' type="button"
                                                onclick="confirmar(<?php echo $role->id; ?>)">
                                                <i class="fa fa-lg fa-fw fa-trash"></i>
                                            </button>
                                        @endcan
                                    </form>
                                </nobr>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>

    </div>

    <footer class="main-footer">
        {{ Breadcrumbs::render('roles') }}
    </footer>

@endsection

@section('css')

@stop

@section('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>


    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            toastr.options = {
                "positionClass": "toast-bottom-right"
            }

            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

    <script>
        function confirmar(numformulario) {
            event.preventDefault();
            form = '#form' + numformulario
            var form = document.querySelector(form);

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'No podrás deshacer esta acción',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@stop
