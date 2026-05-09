<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class RolController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create','store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $permission = Permission::get();
        return view('roles.crear', compact('permission'));
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
            'permission' => 'required|array|min:1',
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        // Recupera modelos de permisos de los IDs proporcionados
        $permissions = Permission::whereIn('id', $request->input('permission'))->get();

        // Sincroniza los permisos con el rol
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('create','Registro agregado correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.editar',compact('role','permission','rolePermissions'));

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
            'permission' => 'required|array|min:1', // Asegúrate de que 'permission' sea un array con al menos un elemento
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        // Recupera modelos de permisos de los IDs proporcionados
        $permissions = Permission::whereIn('id', $request->input('permission'))->get();

        // Sincroniza los permisos con el rol
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('update', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{

    $role = Role::findOrFail($id); // Encuentra el rol por su ID
    dd($role);
    // Verifica si el usuario tiene permiso para eliminar el rol
    if (Gate::allows('borrar-rol', $role)) {
        $role->delete(); // Elimina el rol

        return redirect()->route('roles.index')->with('delete', 'Registro eliminado correctamente');
    } else {
        // En caso de que el usuario no tenga permiso, puedes redirigirlo a alguna página o mostrar un mensaje de error
        return redirect()->back()->with('error', 'No tienes permisos para eliminar este rol.');
    }
}
}



