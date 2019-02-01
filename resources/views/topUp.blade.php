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
        <!-- Search User Form -->
        <div class="col-md-8 col-md-offset-2">
            <!-- Horizontal Form -->

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="/balance/update">
                {{ csrf_field() }}
                @if (session('alert'))
                    <div class="alert alert-success">
                        {{ session('alert') }}
                    </div>
                @endif
                
                <div class="box-body">
                    <div class="form-group">
                        <div class="inner">
                            <h2>Avalaible Balance {{ !empty($balance->max()->balance) ? 'R' .number_format($balance->max()->balance, 2) : 0 }}</h2>
                        </div>
                        <br> </br>
                        <label for="person_name" class="col-sm-2 control-label">Amount:</label>

                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="amount" name="amount"
                                       value="{{ old('amount') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"> Top up</button>
                    <a href="{{ '/home' }}" class="btn btn-sm btn-info  pull-left"><i
                                class="fa fa-arrow-left"></i> Back</a>
                </div>
                <!-- /.box-footer -->

            </form>
        </div>
        <!-- /.box -->
    </div>
@endsection
