@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $exam->name('en') }} </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item">{{ $exam->name('en') }} </li>
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
                    <div class="col-md-10 pb-5 offset-md-1">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Exam Details</h3>
                            </div>
                            <div class="card-body table-responsive p-0 ">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name (en)</th>
                                            <td>{{ $exam->name('en') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Name (ar)</th>
                                            <td>{{ $exam->name('ar') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Skill</th>
                                            <td>{{ $exam->skill->name('en') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Image</th>
                                            <td>
                                                <img src="{{asset("uploads/$exam->image")}}" height="100">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Question no.</th>
                                            <td>{{ $exam->questions_no }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Difficulty</th>
                                            <td>{{ $exam->difficulty }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Duration_mins</th>
                                            <td>{{ $exam->duration_mins }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Description (en)</th>
                                            <td>{{ $exam->description('en') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Description (ar)</th>
                                            <td>{{ $exam->description('ar') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Active</th>
                                            <td>
                                                @if ($exam->active == 1)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="{{url("dashboard/exams/show/$exam->id/questions")}}" class="btn btn-success">Show Questions</a>
                        <a href="{{url("dashboard/exams")}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
