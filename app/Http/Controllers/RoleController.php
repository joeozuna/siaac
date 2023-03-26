<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\Role;

const traduccion_descripcion_permisos = [
    "role-list" => "Listar Roles",
    "role-create" => "Crear Rol",
    "role-edit" => "Editar Rol",
    "role-delete" => "Eliminar Rol",
    "role-view" => "Ver Rol",
    "person-list" => "Listar Personas",
    "person-create" => "Crear Persona",
    "person-edit" => " Editar Persona",
    "person-delete" => "Eliminar Persona",
    "person-view" => "Ver Rol",
];

const traduccion_nombre_permisos = [
    "role" => "Roles",
    "person" => "Personas",
];

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->middleware('permission:role-view', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {




        $sql = 'SELECT description, COUNT(*) AS cant from permissions GROUP BY description; ';
        $description = DB::select($sql);

        $cant = count($description);
        $arr = [];
        for ($i = 0; $i < $cant; $i++) {

            $name_permission = $description[$i]->description;
            $perm = DB::select("SELECT id, name from permissions where description = ?", [$name_permission]);

            $nombre_permiso = traduccion_nombre_permisos[$name_permission];

            for ($j = 0; $j < $description[$i]->cant; $j++) {
                $arr[$nombre_permiso] = $perm;
                $arr[$nombre_permiso][$j]->name = traduccion_descripcion_permisos[$perm[$j]->name];
            }
        }
        return view('roles.create', ['permission' => $arr]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ], [
            'name.required' => 'El campo nombre no puede ser vacío',
            'permission.required' => 'Debe seleccionar al menos un permiso',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        $notification = array(
            'message' => 'Rol creado',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        $cant = count($rolePermissions);
        for ($i = 0; $i < $cant; $i++) {
            $rolePermissions[$i]->name = traduccion_descripcion_permisos[$rolePermissions[$i]->name];
        }

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $sql = 'SELECT description, COUNT(*) AS cant from permissions GROUP BY description; ';
        $description = DB::select($sql);

        $cant = count($description);
        $arr = [];
        for ($i = 0; $i < $cant; $i++) {
            $name_permission = $description[$i]->description;
            $perm = DB::select("SELECT id, name from permissions where description = ?", [$name_permission]);

            $nombre_permiso = traduccion_nombre_permisos[$name_permission];

            for ($j = 0; $j < $description[$i]->cant; $j++) {
                $arr[$nombre_permiso] = $perm;
                $arr[$nombre_permiso][$j]->name = traduccion_descripcion_permisos[$perm[$j]->name];
            }
        }


        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        //dd($permission);

        return view('roles.edit', ['role' => $role, 'permission' => $arr, 'rolePermissions' => $rolePermissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ], [
            'name.required' => 'El campo nombre no puede ser vacío',
            'permission.required' => 'Debe seleccionar al menos un permiso',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        $notification = array(
            'message' => 'Rol actualizado',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();

        $notification = array(
            'message' => 'Rol eliminado',
            'alert-type' => 'success'
        );
        return redirect()->route('roles.index')->with($notification);
    }
}
