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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Producuct Discounts </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i>
                        </button>
                    </div>
                </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>

                                <th>Minimum Price</th>
                                <th>Maximum Price </th>
                                <th>Discount %</th>
                                <th style="width: 10px; text-align: center;"></th>
                                <th style="width: 5px; text-align: center;"></th>
                            </tr>
                            @foreach ($discounts as $productdiscounts)
                                <tr>
                                    <td>{{ !empty($productdiscounts->min_price) ? 'R' .number_format($productdiscounts->min_price, 2) : 0 }}</td>
                                    <td>{{ !empty($productdiscounts->max_price) ? 'R' .number_format($productdiscounts->max_price, 2) : 0 }}</td>
                                    <td>{{ (!empty($productdiscounts->discount)) ?  $productdiscounts->discount : 0}}%</td>
                                    <td style=" text-align: center;" nowrap>
                                        <a href="{{ '/discounts/' . $productdiscounts->id . '/edit' }}" id="edit_compan" class="btn btn-primary  btn-xs
                                        "><i class="fa fa-edit"></i> Edit</a>

                                </tr>
                            @endforeach
                        </table>
                        <div class="box-footer">
                            <div class="row no-print">

                                <a href="{{ '/home' }}" class="btn btn-sm btn-info  pull-left"><i
                                            class="fa fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
            </div>
        </div>
    </div>
    <a href="/manage/add_discounts" id="edit_compan" class="btn btn-primary pull-right">Add Discount</a>

    </div>
@endsection
@section('page_script')
    <script type="text/javascript">
        function deleteRecord() {
            location.href = "/discounts/delete/";
        }
    </script>
@endsection
