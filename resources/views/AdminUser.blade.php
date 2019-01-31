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
    <!-- ./col -->


    <div class="box box-info">
        <div class="box-header with-border">

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$discount}}</h3>
                        <p>Manage Product Discounts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-calculator"></i>
                    </div>
                    <a href="/manage/discounts" class="small-box-footer">product discounts <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$countproduct }}</h3>
                        <p>Manage Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-archive"></i>
                    </div>
                    <a href="/manage/products" class="small-box-footer">products <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>


            <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <h3 class="box-title">Available Products</h3>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($products) > 0)
                        @foreach($products as $product)
                            <tr>
                                <td>{{ !empty($product->name) ? $product->name : '' }}</td>
                                <td>{{ !empty($product->description) ? $product->description : '' }}</td>
                                <td>{{ !empty($product->price) ? $product->price : '' }}</td>
                                <td>{{ !empty($product->date) ? date('d M Y', $product->date) : '' }}
                                <td>
                                    <div class="product-img">
                                        <img src="{{ (!empty($product->product_image)) ? Storage::disk('local')->url("product_image/$product->product_image") : 'http://placehold.it/60x50' }}"
                                             alt="Product Image" style="width:75px;height:50px">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{ '/manage/add_products' }}" class="btn btn-sm btn-info btn-flat pull-left">Add new Product</a>

            <a href="{{ '/manage/products' }}" class="btn btn-sm btn-danger btn-flat pull-right">View All
                Orders</a>
        </div>
        <!-- /.box-footer -->
    </div>
    <!-- ./col -->
    </div>
@endsection
