@extends('admin.layouts.master')
@section('css')
    <link rel="stylesheet" href="/assets/plugins/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                </div>
                <form role="form" id="store-form" enctype="multipart/form-data" method="POST"
                      action="/admin/users-groups/groups" data-redirect="/admin/users-groups/groups">
                    <div class="box-body">
                        <div class="form-group" id="before-slug"
                             data-href="/admin/ajax/common/slug"
                             data-model="{{Crypt::encrypt($model)}}"
                             data-slug-default="Seo URL"
                             data-token="{{csrf_token()}}">
                            <label for="role-name">Grup Adı</label>
                            <input type="text" class="form-control" id="role-name" name="role_name"
                                   placeholder="Grup Adı">
                        </div>
                        <div class="form-group" id="permissions-div">
                            <table class="table table-striped table-bordered" data-toggle="table"
                                   data-height="400">
                                <thead>
                                <tr>
                                    <th class="col-xs-5">İzinler</th>
                                    <th>Görüntüle</th>
                                    <th>Oluştur</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $key=>$value)
                                    <tr id="">
                                        <td>
                                            {{$key}}
                                        </td>
                                        @foreach($value as $permissionKey => $permissionValue)
                                            @if($permissionValue != null)
                                                <td>
                                                    <input type="checkbox" name="permissions[]"
                                                           data-on-text="<i class='fa fa-check'></i>"
                                                           data-off-text="<i class='fa fa-times'></i>"
                                                           data-on-color="success"
                                                           data-size="small"
                                                           value="{{Crypt::encrypt($permissionValue)}}">
                                                </td>
                                            @else
                                                <td>
                                                    -
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        {{csrf_field()}}
                        <div class="pull-right">
                            <button type="button" id="cancel-btn" data-href="/admin/users-groups/groups"
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
    <script src="/assets/plugins/bootstrap-switch-master/dist/js/bootstrap-switch.min.js"></script>
    <script>
        $(document).ready(function () {
            //Checkbox
            $("[type='checkbox']").bootstrapSwitch();
        });
    </script>
@endsection