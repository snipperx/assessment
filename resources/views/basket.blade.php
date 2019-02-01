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
        <div class="col-md-12">
            <div class="box box-warning">

                <form class="form-horizontal" method="POST" action="/cart/checkout">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <h4><i class="icon fa fa-ban"></i> Invalid Input Data!</h4>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="totaldisc" value="{{!empty($totalDiscount) ? $totalDiscount : ''}}">
                        <input type="hidden" name="productId" value="{{!empty($productID) ? $productID : ''}}">
                        <div class="col-md-12 ">
                            <div>
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title">SHOPPING CART-  User Balance {{ !empty($balance->max()->balance) ? 'R' .number_format($balance->max()->balance, 2) : 0 }}</h3>
                                    <h4 class="box-title"></h4>
                                </div>
                                <div class="box-body" id="vehicle_details">
                                    <div class="box-body" style="max-height: 274px; overflow-y: scroll;">
                                        <table id="example2" class="table table-striped table-hover">
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Price before Discount</th>
                                                <th>Price after Discount</th>
                                                <th>Image</th>
                                                <th style="width: 10px; text-align: center;"></th>
                                                <th style="width: 5px; text-align: center;"></th>
                                            </tr>
                                            <tbody>
                                            @if (count($shoppingCart) > 0)
                                                @foreach($shoppingCart as $product)
                                                    <tr>
                                                        <td>{{ !empty($product->name) ? $product->name : '' }}</td>
                                                        <td>{{ !empty($product->description) ? $product->description : '' }}</td>
                                                        <td>{{ !empty($product->price) ? 'R' .number_format($product->price, 2) : 0 }}</td>
                                                        <td>{{ !empty($totalDiscount) ? 'R' .number_format($totalDiscount, 2) : 0 }}</td>
                                                        <td>
                                                            <div class="product-img">
                                                                <img src="{{ (!empty($product->product_image)) ? Storage::disk('local')->url("product_image/$product->product_image") : 'http://placehold.it/60x50' }}"
                                                                     alt="Product Image" style="width:75px;height:50px">
                                                            </div>
                                                        </td>
                                                        {{--<td>--}}
                                                            {{--<a href="{{'/cart/' . $product->id . '/remove'}}"--}}
                                                               {{--class="btn btn-sm btn-info pull-left"><i--}}
                                                                        {{--class="fa fa-trash"></i> remove</a>--}}
                                                        {{--</td>--}}

                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Price before Discount</th>
                                                <th>Price after Discount</th>
                                                <th>Image</th>
                                                <th style="width: 10px; text-align: center;"></th>
                                                <th style="width: 5px; text-align: center;"></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="/view/products" id="edit_compan" class="btn btn-primary pull-left"><i
                                            class="fa fa-arrow-left"></i> Continue Shopping</a>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-sign-out"></i>
                                    Check
                                    Out
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        <!-- /.box -->
    </div>

@endsection

@section('page_script')
    <!-- Select2 -->
    <script src="/bower_components/AdminLTE/plugins/select2/select2.full.min.js"></script>
    <!-- Bootstrap date picker -->
    <script src="/bower_components/AdminLTE/plugins/daterangepicker/moment.min.js"></script>
    <script src="/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/custom_components/js/modal_ajax_submit.js"></script>
    <!-- Select2 -->
    <script src="/bower_components/AdminLTE/plugins/select2/select2.full.min.js"></script>
    <script type="text/javascript">

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

