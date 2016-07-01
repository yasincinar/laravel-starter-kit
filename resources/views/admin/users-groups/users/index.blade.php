@extends('admin.layouts.master')
@section('css')
    <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="/admin/users-groups/users/create" class="btn btn-primary pull-right"><i
                                        class="fa fa-plus"></i> Yeni
                                Kullanıcı</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! $html->table() !!}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    {!! $html->scripts() !!}

@endsection