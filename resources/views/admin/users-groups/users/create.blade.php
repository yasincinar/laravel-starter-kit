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
                <form role="form" enctype="multipart/form-data" method="post" action="/admin/users-groups/users">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="first-name">Ad</label>
                            <input type="text" class="form-control" id="first-name" name="first_name"
                                   placeholder="Mahmut">
                        </div>
                        <div class="form-group" id="before-slug"
                             data-href="/admin/common/slug"
                             data-model="{{Crypt::encrypt("a")}}"
                             data-slug-default="Seo URL"
                             data-token="{{csrf_token()}}">
                            <label for="last-name">Soyad</label>
                            <input type="text" class="form-control" id="last-name" name="last_name"
                                   placeholder="Tuncer">
                        </div>
                        <div class="form-group">
                            <label for="cell-phone">Cep Telefonu</label>
                            <input type="text" class="form-control" id="cell-phone" name="cell_phone"
                                   placeholder="05123456789">
                        </div>
                        <div class="form-group">
                            <label for="address">Adres</label>
                            <textarea class="form-control" id="address" name="address"
                                      placeholder="Vişnelik mah. 22/5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">Şehir</label>
                            <select type="text" class="form-control select2" id="city" name="city">
                                @foreach($cities as $city)
                                    <option value="{{encrypt($city->id)}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password"
                                   placeholder="Password">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="/assets/plugins/select2/js/i18n/tr.js"></script>
    <script style="text/javascript">
        $(function () {
            $('.select2').select2();

        });
    </script>
@endsection