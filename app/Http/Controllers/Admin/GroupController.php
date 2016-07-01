<?php

namespace App\Http\Controllers\Admin;

use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Http\Request;

use App\Http\Requests;
use Sentinel;
use Yajra\Datatables\Datatables;

class GroupController extends AdminController
{
    public function index(Datatables $datatables)
    {
        if (Sentinel::hasAccess('user.show')) {

            if ($datatables->getRequest()->ajax()) {

                $roles = EloquentRole::all();

                return Datatables::of($roles)
                    ->addColumn('action', function ($user) {
                        if (Sentinel::hasAccess('group.edit')) {
                            $edit = $this->createEditButton('/admin/users-groups/groups' . $user->slug . '/edit');
                        } else {
                            $edit = '';
                        }
                        if (Sentinel::hasAccess('group.delete')) {
                            $delete = $this->createDeleteButton($user->id, 'admin.users-groups.groups.destroy');
                        } else {
                            $delete = '';
                        }
                        if (Sentinel::hasAccess('group.show')) {
                            $use = '<a href="' . url("admin/users-groups/groups") . "/" . $user->slug . '/use"
                                class="btn btn-warning" data-tooltip="true" title="Oturumu Kullan" ><i class="fa fa-user"></i></a>&nbsp;';
                        } else {
                            $use = '';
                        }
                        return $use . ' ' . $edit . ' ' . $delete;
                    })
                    ->make(true);

            }
            $html = $datatables->getHtmlBuilder()
                ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Grup Adı'])
                ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'])
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'İşlemler', 'orderable' => false, 'searchable' => false])
                ->parameters(array('order' => [3, 'desc']));
            $data = [
                'selectedMenu' => 'groups',
                'page_title' => 'Gruplar',
                'page_description' => 'Sistem Gruplarına Ait Özellikler Bu Sayfada Yer Almaktadır',
            ];
            return view('admin.users-groups.groups.index', $data)->with(compact('html'));
        } else {
            abort(403, $this->accessForbidden);
        }
    }
}
