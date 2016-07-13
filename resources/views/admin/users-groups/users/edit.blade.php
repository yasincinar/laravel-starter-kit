@extends('admin.layouts.master')
@section('css')
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Kullanıcı Oluşturma</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="store-form" enctype="multipart/form-data" method="post"
                      action="/admin/users-groups/users/{{$user->slug}}" data-redirect="/admin/users-groups/users">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="first-name">Ad</label>
                            <input type="text" class="form-control" id="first-name" name="first_name"
                                   placeholder="Mahmut" value="{{$user->first_name}}">
                        </div>
                        <div class="form-group" id="before-slug"
                             data-href="/admin/ajax/common/slug"
                             data-model="{{Crypt::encrypt($model)}}"
                             data-slug-default="Seo URL"
                             data-slug="{{$user->slug}}"
                             data-token="{{csrf_token()}}">
                            <label for="last-name">Soyad</label>
                            <input type="text" class="form-control" id="last-name" name="last_name"
                                   placeholder="Tuncer" value="{{$user->last_name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">E mail</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="admin@admin.com" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="cell-phone">Cep Telefonu</label>
                            <input type="text" class="form-control" id="cell-phone" name="cell_phone"
                                   placeholder="05123456789" value="{{$user->cell_phone}}">
                        </div>
                        <div class="form-group">
                            <label for="identity-number">TC Kimlik No</label>
                            <input type="text" class="form-control" id="identity-number" name="identity_number"
                                   placeholder="30445678912" value="{{$user->identity_number}}">
                        </div>
                        <div class="form-group">
                            <label for="address">Adres</label>
                            <textarea class="form-control" id="address" name="address"
                                      placeholder="Vişnelik mah. 22/5">{{$user->address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">Şehir</label>
                            <select type="text" class="form-control select2" id="city" name="city">
                                @foreach($cities as $city)
                                    <option value="{{encrypt($city->id)}}"
                                            @if($user->city_id==$city->id) selected @endif>{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Kullanıcı Rolü</label>
                            <select type="text" class="form-control select2" id="role" name="role">
                                @foreach($roles as $role)
                                    <option value="{{encrypt($role->id)}}"
                                            @if($user->roles[0]->id==$role->id) selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Şifre</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirmation">Şifre Tekrar</label>
                            <input type="password" class="form-control" id="password-confirmation"
                                   name="password_confirmation"
                                   placeholder="Password">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="user_id" value="{{encrypt($user->id)}}">
                        <div class="pull-right">
                            <button type="button" id="cancel-btn" data-href="/admin/users-groups/users"
                                    class="btn btn-danger"><i class="fa fa-times"></i> İptal
                            </button>
                            <button type="submit" id="store-btn" class="btn btn-primary"><i class="fa fa-save"></i>
                                Kaydet
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="/assets/plugins/select2/js/i18n/tr.js"></script>
    <script src="/assets/plugins/jquery-mask-plugin/jquery.mask.min.js"></script>
    <script style="text/javascript">
        $(function () {
            $('#cell-phone').mask("0(500)-000-0000", {placeholder: "0(___)-___-____"});
            $('#identity-number').mask("00000000000");

            $('.select2').select2();
        });
    </script>
@endsection