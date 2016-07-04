<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Crypt;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $currentUser;
    protected $accessForbidden = 'Bu Sayfayı Görüntüleme Yetkiniz Yok!';
    protected $deleteResponseMessage = ['success' => true, 'messages' => 'Silme Başarılı'];
    protected $storeResponseMessage = ['success' => true, 'messages' => 'Kayıt İşlemi Başarılı'];
    protected $editResponseMessage = ['success' => true, 'messages' => 'Güncelleme İşlemi Başarılı'];

    public function __construct()
    {
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
            if (!is_null($user)) {
                $data = array(
                    'currentUser' => $user,
                    'userRole' => $user->roles()->get()
                );
                $this->currentUser = $user;
                view()->share($data);
            }
        }
    }

    /**
     * @param  integer $id = Data id which is use for delete method
     * @param string $routeName = is Laravel route::resource destroy method name
     * @param array $formText [done,cancel,confirm,title,tooltip] set null for default language Turkish (Model messages)
     * @return string button
     */
    protected function createDeleteButton($id, $routeName, $formText = null)
    {
        $delete = '<a data-method="delete"
                    data-done="' . ($formText['done'] == null ? "Silme İşlemi Başarılı" : $formText['done']) . '"
                    data-cancel="' . ($formText['cancel'] == null ? "İptal" : $formText['cancel']) . '"
                    data-confirm="' . ($formText['confirm'] == null ? "Onayla" : $formText['confirm']) . '"
                    data-title= "' . ($formText['title'] == null ? "Silmek istediğinize emin misiniz ?" : $formText['title']) . '"
                    data-link="' . route($routeName, array(Crypt::encrypt($id))) . '"
                    data-token="' . csrf_token() . '"  class="deleteRows btn btn-danger"
                    data-toggle="tooltip"
                    title="' . ($formText['tooltip'] == null ? "Sil" : $formText['tooltip']) . '"><i class="fa fa-remove"></i></a>';

        return $delete;
    }

    protected function createEditButton($editUrl, $tooltip = null)
    {
        $edit = '<a href="' . $editUrl . '" class="btn btn-primary" data-toggle="tooltip" title="' . ($tooltip == null ? 'Düzenle' : $tooltip) . '"><i class="fa fa-edit"></i></a>';
        return $edit;
    }

    protected function permissionSection(\Closure $closure, $permission)
    {
        if ($this->currentUser->hasAccess($permission)) {
            $func = $closure($this);
            return $func;
        } else {
            abort(403, $this->accessForbidden);
        }
    }
}
