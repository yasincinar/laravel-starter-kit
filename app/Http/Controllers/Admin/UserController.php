<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\City;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use Yajra\Datatables\Datatables;

class UserController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Datatables $datatables)
    {

        if ($datatables->getRequest()->ajax()) {

            $users = User::with('city')->get(['id', DB::raw("CONCAT(users.first_name,' ',users.last_name) as full_name"), 'cell_phone', 'slug', 'email', 'created_at', 'updated_at']);

            return Datatables::of($users)
                ->filterColumn('full_name', 'whereRaw', "CONCAT(users.first_name,' ',users.last_name) like ?", ["$1"])
                ->addColumn('action', function ($user) {
                    if (Sentinel::hasAccess('users.edit')) {
                        $edit = $this->createEditButton('/admin/users-groups/users' . $user->slug . '/edit');
                    } else {
                        $edit = '';
                    }
                    if (Sentinel::hasAccess('users.delete')) {
                        $delete = $this->createDeleteButton($user->id, 'admin.users-groups.users.destroy');
                    } else {
                        $delete = '';
                    }
                    if (Sentinel::hasAccess('users.show')) {
                        $use = '<a href="' . url("admin/users-groups/users") . "/" . $user->slug . '/use"
                                class="btn btn-warning" data-tooltip="true" title="Oturumu Kullan" ><i class="fa fa-user"></i></a>&nbsp;';
                    } else {
                        $use = '';
                    }
                    return $use . ' ' . $edit . ' ' . $delete;
                })
                ->removeColumn('password')
                ->make(true);

        }
        $html = $datatables->getHtmlBuilder()
            ->addColumn(['data' => 'full_name', 'name' => 'full_name', 'title' => 'Ad Soyad'])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
            ->addColumn(['data' => 'cell_phone', 'name' => 'cell_phone', 'title' => 'Telefon'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'İşlemler', 'orderable' => false, 'searchable' => false])
            ->parameters(array('order' => [3, 'desc']));
        $data = [
            'selectedMenu' => 'users',
            'pageTitle' => 'Kullanıcılar',
            'pageDescription' => 'Sistem Kullanıcılara Ait Özellikler Bu Sayfada Yer Almaktadır',
        ];
        return view('admin.users-groups.users.index', $data)->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();

        $data = [
            'cities' => $cities,
            'pageTitle' => 'Kullanıcılar',
            'pageDescription' => 'Sisteme yeni kullanıcı ekleme sayfasıdır',
            'selectedMenu' => 'users',
            'model' => 'users'
        ];
        return view('admin.users-groups.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        dd($request->all());
        $output = DB::transaction(function () use ($request) {
            User::create($request->toArray());
        });
        echo $output;
        return response()->json($this->storeResponseMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
