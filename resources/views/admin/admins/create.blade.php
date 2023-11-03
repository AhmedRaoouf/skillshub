@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/admins') }}">Admins</a></li>
                            <li class="breadcrumb-item active">New Admin</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @include('admin.inc.messages')
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="card">
                            <form action="{{url('dashboard/admins/store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>

                                            <div class="col-6">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>

                                            <div class="col-6">
                                                <label>Password Confirmation</label>
                                                <input type="password" class="form-control" name="password_confirmation">
                                            </div>
                                            <div class="col-6">
                                                <label>role</label>
                                                <select name="role_id" class="form-control">
                                                    @foreach ($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
