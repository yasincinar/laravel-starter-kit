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
                <div class="box-body">
                    <form method="POST"
                          data-redirect="/admin/users-groups/groups" role="form"
                          action="/admin/users-groups/groups">
                        <div class="form-group" id="role-name-div">
                            <label for="role-name">Grup Adı</label>
                            <input type="text" class="form-control" id="role-name" name="role_name" placeholder="">
                        </div>
                        <div class="form-group" id="permissions-div">
                            <table class="table table-striped table-bordered" data-toggle="table"
                                   data-height="400">
                                <thead>
                                <tr>
                                    <th class="col-xs-5">İzin Adı</th>
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
                        {{csrf_field()}}
                        <div class="text-right" style="margin-top: 30px">
                            <button type="submit" id="store-btn"
                                    class="btn btn-primary">Kaydet
                            </button>
                            &nbsp;
                            <a type="button"
                               href="/admin/users-groups/groups"
                               class="btn btn-danger">İptal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/assets/plugins/bootstrap-switch-master/dist/js/bootstrap-switch.min.js"></script>
    <script src="/assets/admin/js/main.js"></script>
    <script>
        $(document).ready(function () {
            $("[type='checkbox']").bootstrapSwitch();

            //Email error array
            var roleNameErrors = '{{ json_encode($errors->get('role_name')) }}';
            roleNameErrors = roleNameErrors.replace(/&quot;/g, "\"");
            roleNameErrors = JSON.parse(roleNameErrors);
            //Permission error array
            var permissionErrors = '{{ json_encode($errors->get('permissions')) }}';
            permissionErrors = permissionErrors.replace(/&quot;/g, "\"");
            permissionErrors = JSON.parse(permissionErrors);

            //Email and password divs
            var $roleNameDiv = $('#role-name-div');

            //Add has-error class if email error exists
            if (roleNameErrors.length > 0) {
                $roleNameDiv.addClass('has-error');
            }

            //Remove errors on focus
            $('#role-name').on('focus', function () {
                $('#role-name-div > .error-label').remove();
                $roleNameDiv.removeClass('has-error');
            });
        });
    </script>
@endsection