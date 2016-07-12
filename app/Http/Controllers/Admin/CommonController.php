<?php

namespace App\Http\Controllers\Admin;

use Crypt;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    public function postSlug()
    {
        $slug = str_slug(Input::get('slug'));
        $modelName = Crypt::decrypt(Input::get('model'));
        $slugCount = count(DB::table($modelName)->whereRaw("slug REGEXP '^{$slug}(-*)?$'")->get());
        $slugFinal = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
        return json_encode($slugFinal);
    }

}
