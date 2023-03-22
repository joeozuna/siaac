@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Role Management</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
                                            <button class='btn btn-xs btn-default text-danger mx-1 shadow' type="submit"
                                                onclick="return confirm('Estas seguro de borrarlo?')">
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
@stop
