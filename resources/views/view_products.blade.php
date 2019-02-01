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
@section('page_dependencies')
    <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Transaction List For {{ Auth::user()->name }} </h3>
                    <a class="nav-link pull-right" href="/view/basket" aria-expanded="true">
                        <i class="fa fa-cart-plus fa-1x"></i>
                        <span class="badge badge-danger  ">{{$countproducts}}</span>
                        <h5>Cart</h5>
                    </a>
                </div>

                <div class="box-body">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            {{--<div style="overflow-y:hidden;">--}}
                            <div style="max-height: 274px; overflow-y: scroll;">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 5px; text-align: center;"></th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($products) > 0)
                                        @foreach ($products as $product)
                                            <tr id="categories-list">
                                                <td></td>
                                                <td>{{ !empty($product->name) ? $product->name : '' }}</td>
                                                <td>{{ !empty($product->description) ? $product->description : '' }}</td>
                                                <td>{{ !empty($product->price) ? 'R' .number_format($product->price, 2) : 0 }}</td>
                                                <td>{{ !empty($product->quantity) ? $product->quantity : 0 }}
                                                <td>
                                                    <button vehice="button" id="view_ribbons"
                                                            class="btn {{ (!empty($product->quantity) && $product->quantity >= 1) ? " btn-success " : "btn-danger " }}
                                                                    btn-xs"
                                                            onclick="postData({{$product->id}}, 'actdeac');"><i
                                                                class="fa {{ (!empty($product->status) && $product->quantity >= 1) }}"></i> {{(!empty($product->quantity) && $product->quantity >= 1) ? "Available" : "Out of stock"}}
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="product-img">
                                                        <img src="{{ (!empty($product->product_image)) ? Storage::disk('local')->url("product_image/$product->product_image") : 'http://placehold.it/60x50' }}"
                                                             alt="Product Image" style="width:75px;height:50px">
                                                    </div>
                                                </td>
                                                @if (isset($cart) && $cart === 0 && (isset($product) && $product->quantity >= 1))
                                                    <td>
                                                        <a href="{{ '/product/addcart/' . $product->id }}"
                                                           id="edit_compan" class="btn btn-warning  btn-xs"
                                                           data-id="{{ $product->id }}"><i
                                                                    class="fa==fa0cart-plus"> </i>
                                                            Add to cart</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <strong class="label label-danger">You can not add to
                                                            cart</strong>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th style="width: 5px; text-align: center;"></th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="box-footer">
                                    <div class="row no-print">

                                        <a href="{{ '/home' }}" class="btn btn-sm btn-info  pull-left"><i
                                                    class="fa fa-arrow-left"></i> Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Session('success_edit'))
            @include('partials.success_action', ['modal_title' => "User's Details Updated!", 'modal_content' => session('success_edit')])
        @endif
    </div>
@endsection

@section('page_script')
    <script>
        $(function () {
            //Cancel button click event

            //Date picker

            //Phone mask
            $("[data-mask]").inputmask();

            // [bootstrap file input] initialize with defaults
            $("#input-1").fileinput();
            // with plugin options
            //$("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});

            //Tooltip
            $('[data-toggle="tooltip"]').tooltip();

            //Vertically center modals on page
            function reposition() {
                var modal = $(this),
                    dialog = modal.find('.modal-dialog');
                modal.css('display', 'block');

                // Dividing by two centers the modal exactly, but dividing by three
                // or four works better for larger screens.
                dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
            }
            // Reposition when a modal is shown
            $('.modal').on('show.bs.modal', reposition);
            // Reposition when the window is resized
            $(window).on('resize', function() {
                $('.modal:visible').each(reposition);
            });

            //Show success action modal
            $('#success-action-modal').modal('show');

        });

    </script>
@endsection