@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <div class>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Welcome {{ Auth::user()->name }}</li>
        </ol>


    </div>
@endsection
@section('content')
    <div class="row">
        <!-- User Form -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-user pull-right"></i>
                    <h3 class="box-title">User Details</h3>

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/users/{{$user->user_id}}/edit" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{--{{ method_field('PATCH') }}--}}
                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="first_name" class="col-sm-2 control-label">First Name </label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{$user->first_name}}" placeholder="First Name" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="col-sm-2 control-label">Surname</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control" id="surname" name="surname"
                                       value="{{ (!empty($user->surname)) ? $user->surname : ''  }}"
                                       placeholder="Surname" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Gender</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-venus-mars"></i>
                                </div>
                                <select name="gender" class="form-control">
                                    <option value="">*** Select Your gender ***</option>
                                    <option value="1" {{ ($user->gender === 1) ? ' selected' : '' }}>Male</option>
                                    <option value="0" {{ ($user->gender === 0) ? ' selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cell_number" class="col-sm-2 control-label">Cell Number</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" name="cell_number"
                                       value="{{ (!empty($user->cell_number)) ? $user->cell_number : ''  }}"
                                       data-inputmask='"mask": "(999) 999-9999"' placeholder="Cell Number" data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{$user->email}}" placeholder="Email" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="res_address" class="col-sm-2 control-label">Address</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <textarea name="res_address" class="form-control" placeholder="Address">{{ (!empty($user->res_address)) ? $user->res_address : ''  }}
                                    </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-sm-2 control-label">City</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <input type="text" class="form-control" id="city" name="city"
                                       value="{{ (!empty($user->city)) ? $user->city : ''  }}" placeholder="City">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="res_postal_code" class="col-sm-2 control-label">Postal Code</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <input type="number" class="form-control" id="res_postal_code" name="res_postal_code"
                                       value="{{ (!empty($user->res_postal_code)) ? $user->res_postal_code : ''  }}"
                                       placeholder="Postal Code">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_number" class="col-sm-2 control-label">ID Number</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <input type="number" class="form-control" id="id_number" name="id_number"
                                       value="{{ (!empty($user->id_number)) ? $user->id_number : ''  }}"
                                       placeholder="ID Number">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer" style="text-align: center;">
                        <button type="button" id="cancel" class="btn btn-default pull-left">Cancel</button>
                        <button type="submit" name="command" id="update" class="btn btn-primary pull-right">Update
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
