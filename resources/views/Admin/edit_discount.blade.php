@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <div class>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin Dashboard</li>
            <li class="active">Welcome {{ Auth::user()->name }}</li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="row">
        <!-- New User Form -->
        <div class="col-md-8 col-md-offset-2">
            <!-- Horizontal Form -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <p>Enter Discount</p>
                </div>
                <form class="form-horizontal" method="POST" action="/manage/{{$discount->id}}/update">
                    {{ csrf_field() }}
                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="box-body">
                        <div class="form-group">
                            <label for="min_price" class="col-sm-3 control-label">Minimum Price</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="min_price" name="min_price"
                                           value="{{ $discount->min_price }}" placeholder="Enter min value" required>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="max_price" class="col-sm-3 control-label">Maximum Price</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="max_price" name="max_price"
                                               value="{{ $discount->max_price }}" placeholder="Enter min value" required>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="discount" class="col-sm-3 control-label">Discount %</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="discount" name="discount"
                                                   value="{{ $discount->discount }}" placeholder="Enter Discount" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button id="cancel" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back
                                    </button>
                                    <button type="submit" class="btn btn-primary pull-right"><i
                                                class="fa fa-refresh"></i> Update
                                    </button>
                                </div>
                                <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- End new User Form-->
    </div>
@endsection
@section('page_script')
    <!-- InputMask -->
    <script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <script type="text/javascript">
        //Cancel button click event
        document.getElementById("cancel").onclick = function () {
            location.href = "/manage/discounts";
        };
        //Phone mask
        $("[data-mask]").inputmask();
    </script>
@endsection
