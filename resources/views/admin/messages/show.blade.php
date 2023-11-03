@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Show Message</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/messages') }}">Messages</a></li>
                            <li class="breadcrumb-item active">Show</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mt-2">Show</h3>
                            </div>

                            <div class="card-body  p-0 ">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $message->name }} </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $message->email }} </td>
                                        </tr>
                                        <tr>
                                            <th>Subject</th>
                                            <td>{{ $message->subject ?? "...." }} </td>
                                        </tr>
                                        <tr>
                                            <th>body</th>
                                            <td>{{ $message->body }} </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>
        <div class="content">
            <div class="container-fluid">
                @include('admin.inc.messages')
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mt-2">Send Response</h3>
                            </div>
                            <form action="{{url("dashboard/messages/response/$message->id")}}" method="get">
                                @csrf

                                <div class="card-body">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Body</label>
                                            <textarea class="form-control" name="body" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                                    </div>
                            </form>
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

