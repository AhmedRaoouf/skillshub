@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">"{{$exam->name('en')}}" Questions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item"><a href="{{ url("dashboard/exams/show/$exam->id") }}">{{$exam->name('en')}}</a></li>
                            <li class="breadcrumb-item active">Questions</li>
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
                                <h3 class="card-title mt-2"> QuestionsExam </h3>

                                <div class="card-tools">

                                </div>
                            </div>

                            <div class="card-body table-responsive p-0 ">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Exam name</th>
                                            <th>Title</th>
                                            <th>Options</th>
                                            <th>Right answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exam->questions as $ques)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $exam->name('en') }} </td>
                                                <td>{{ $ques->title }} </td>
                                                <td>
                                                    {{ $ques->option_1 }}| <br>
                                                    {{ $ques->option_2 }}| <br>
                                                    {{ $ques->option_3 }}| <br>
                                                    {{ $ques->option_4 }} <br>
                                                </td>

                                                <td>{{ $ques->right_answer }}
                                                </td>
                                                <td>
                                                    <a href="{{url("dashboard/exams/edit-questions/$exam->id/$ques->id")}}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="ml-3 pt-2">
                                </div>
                            </div>
                        </div>
                        <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>

                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

