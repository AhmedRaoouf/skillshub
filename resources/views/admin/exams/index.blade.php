@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Exams</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Exams</li>
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
                            <div class="card-header">
                                <h3 class="card-title mt-2">All Exams</h3>

                                <div class="card-tools">
                                    <a href="{{url('dashboard/exams/create')}}" class="btn btn-primary">
                                        Add new
                                    </a>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0 ">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name (en)</th>
                                            <th>Name(ar)</th>
                                            <th>Skill</th>
                                            <th>Image</th>
                                            <th>Question no.</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $exam->name('en') }} </td>
                                                <td>{{ $exam->name('ar') }} </td>
                                                <td>{{ $exam->skill->name('en') }} </td>
                                                <td>
                                                    <img src="{{ asset("uploads/$exam->image") }}" height="50px">
                                                </td>
                                                <td>{{ $exam->questions_no }}
                                                </td>
                                                <td>
                                                    @if ($exam->active == 1)
                                                        <span class="badge bg-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-danger">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{url("dashboard/exams/show/$exam->id")}}" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{url("dashboard/exams/show-questions/$exam->id")}}" class="btn btn-success">
                                                        <i class="fas fa-question"></i>
                                                    </a>
                                                    <a href="{{url("dashboard/exams/edit/$exam->id")}}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger"
                                                        href="{{ url("dashboard/exams/delete/{$exam->id}") }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a class="btn btn-secondary"
                                                        href="{{ url("dashboard/exams/toggle/{$exam->id}") }}">
                                                        @if ($exam->active)
                                                            <i class="fas fa-toggle-on fa-lg"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off fa-lg"></i>
                                                        @endif
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="ml-3 pt-2">
                                    {{ $exams->links() }}
                                </div>
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

