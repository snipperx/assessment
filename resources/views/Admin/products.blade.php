@extends('adminlte::page')
@section('title', 'Dashboard')
@section('page_dependencies')
    <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css">
@endsection
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
        <div class="col-md-12 ">
            <!-- Horizontal Form -->
            <form class="form-horizontal">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Products</h3>
                    </div>
                    <div class="box-body">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body" style="max-height: 300
                            x; overflow-y: scroll;">
                                <table id="example2" class="table table-striped table-hover">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        <th style="width: 10px; text-align: center;"></th>
                                        <th style="width: 5px; text-align: center;"></th>
                                    </tr>
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
                                                <td>
                                                    <a href="{{ '/products/' . $product->id . '/edit' }}"
                                                       class="btn btn-sm btn-info btn-flat pull-left"><i
                                                                class="fa fa-edit"></i>Edit</a>
                                                </td>
                                                <td type="button" class="btn btn-sm btn-info btn-flat pull-left"
                                                    id="delete_button"
                                                    name="command"
                                                    onclick="if(confirm('Are you sure you want to delete this Product ?')){ deleteRecord()} else {return false;}"
                                                    value="Delete"><i class="fa fa-trash"></i> Delete User
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </form>
            <div class="box-footer">
                <a href="/manage/add_products" id="edit_compan" class="btn btn-primary pull-right">Add Product</a>
                <a href="{{ '/home' }}" class="btn btn-sm btn-info  pull-left"><i
                            class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <!-- End new User Form-->
    </div>
@endsection

@section('page_script')
    <!-- DataTables -->
    <script src="/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- End Bootstrap File input -->

    <script type="text/javascript">
        //Cancel button click event
        document.getElementById("cancel").onclick = function () {
            location.href = "/contacts/general_search";
        };
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });

    </script>
@endsection

