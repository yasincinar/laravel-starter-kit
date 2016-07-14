<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\GroupRequest;
use App\Models\Permission;
use App\Models\Role;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use Sentinel;
use Yajra\Datatables\Datatables;

class GroupController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Datatables $datatables)
    {
        if ($datatables->getRequest()->ajax()) {
            $roles = Role::all();

            return Datatables::of($roles)
                ->addColumn('action', function ($role) {
                    if (Sentinel::hasAccess('groups.edit')) {
                        $edit = $this->createEditButton('/admin/users-groups/groups/' . $role->slug . '/edit');
                    } else {
                        $edit = '';
                    }
                    if (Sentinel::hasAccess('groups.delete')) {
                        $delete = $this->createDeleteButton($role->id, 'admin.users-groups.groups.destroy');
                    } else {
                        $delete = '';
                    }
                    return $edit . ' ' . $delete;
                })
                ->removeColumn('permissions')
                ->make(true);

        }
        $html = $datatables->getHtmlBuilder()
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Grup Adı'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Oluşturulma Tarihi'])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Güncellenme Tarihi'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'İşlemler', 'orderable' => false, 'searchable' => false])
            ->parameters(array('order' => [1, 'desc']));
        $data = [
            'selectedMenu' => 'groups',
            'pageTitle' => 'Gruplar',
            'pageDescription' => 'Sistem gruplarına ait özellikler bu sayfada yer almaktadır',
        ];
        return view('admin.users-groups.groups.index', $data)->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = DB::table('permissions')->get();

        $permissionArray = [];
        foreach ($permissions as $permission) {
            $display_name = explode(" ", $permission->display_name);
            array_pop($display_name);
            $permissionName = implode(" ", $display_name);
            $permissionType = explode(".", $permission->name);
            $permissionType = end($permissionType);

            //Change special show permissions with show
            if (!in_array($permissionType, ['create', 'edit', 'delete'])) {
                $permissionType = 'show';
            }
            $permissionArray[$permissionName][$permissionType] = $permission->name;

            //Define all permissions
            $permisssionTypeArray = ['show', 'create', 'edit', 'delete'];
            foreach ($permisssionTypeArray as $p) {
                if (!array_key_exists($p, $permissionArray[$permissionName]))
                    $permissionArray[$permissionName][$p] = null;

            }
        }
        $data = [
            'permissions' => $permissionArray,
            'selectedMenu' => 'groups',
            'pageTitle' => 'Yeni Grup',
            'pageDescription' => 'Kullanıcıları yetkilendirmek için grup oluşturun',
            'model' => 'roles'
        ];
        return view('admin.users-groups.groups.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        try {
            $permissions = [];
            foreach ($request->permissions as $permission) {
                $permissions[\Crypt::decrypt($permission)] = true;
            }

            Role::create([
                'slug' => $request->slug,
                'name' => $request->role_name,
                'permissions' => $permissions,
            ]);

        } catch (\Exception $e) {

            return response()->json($this->storeErrorMessage, 500);
        }

        return response()->json($this->storeSuccessMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $role = Role::where('slug', $slug)->first();
        //All permissions
        $permissions = Permission::all();
        $permissionArray = [];
        foreach ($permissions as $permission) {
            $display_name = explode(" ", $permission->display_name);
            array_pop($display_name);
            $permissionName = implode(" ", $display_name);
            $permissionType = explode(".", $permission->name);
            $permissionType = end($permissionType);

            //Change special show permissions with show
            if (!in_array($permissionType, ['create', 'edit', 'delete'])) {
                $permissionType = 'show';
            }
            $permissionArray[$permissionName][$permissionType] = $permission->name;

            //Define all permissions
            $permisssionTypeArray = ['show', 'create', 'edit', 'delete'];
            foreach ($permisssionTypeArray as $p) {
                if (!array_key_exists($p, $permissionArray[$permissionName]))
                    $permissionArray[$permissionName][$p] = null;
            }
        }
        $data = [
            'role' => $role,
            'permissions' => $permissionArray,
            'selectedMenu' => 'groups',
            'pageTitle' => $role->name,
            'pageDescription' => 'Grup ayarlarını düzenleyin',
            'model' => 'roles'
        ];
        return view('admin.users-groups.groups.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(GroupRequest $request, $slug)
    {
        try {
            $permissions = [];
            foreach ($request->permissions as $permission) {
                $permissions[\Crypt::decrypt($permission)] = true;
            }

            Role::where('slug', $slug)->update([
                'slug' => $request->slug,
                'name' => $request->role_name,
                'permissions' => $permissions,
            ]);

        } catch (\Exception $e) {

//            echo response()->json($this->storeErrorMessage, 500);
            echo 3;
        }
        echo 2;
//        echo response()->json($this->storeSuccessMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
