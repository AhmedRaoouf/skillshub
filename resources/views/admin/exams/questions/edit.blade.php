@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Questions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ url("dashboard/exams/show/$exam->id") }}">{{ $exam->name('en') }}</a></li>
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
                            <form action="{{ url("dashboard/exams/update-questions/$exam->id/$ques->id") }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">

                                        <div class="row">
                                            <div class="col-6">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ $ques->title }}">
                                            </div>

                                            <div class="col-6">
                                                <label>Right Ans.</label>
                                                <input type="number" class="form-control" name="right_answer"
                                                    value="{{ $ques->right_answer }}">
                                            </div>
                                            <div class="col-6">
                                                <label>Option 1</label>
                                                <input type="text" class="form-control" name="option_1"
                                                    value="{{ $ques->option_1 }}">
                                            </div>

                                            <div class="col-6">
                                                <label>Option 2</label>
                                                <input type="text" class="form-control" name="option_2"
                                                    value="{{ $ques->option_2 }}">
                                            </div>

                                            <div class="col-6">
                                                <label>Option 3</label>
                                                <input type="text" class="form-control" name="option_3"
                                                    value="{{ $ques->option_3 }}">
                                            </div>

                                            <div class="col-6">
                                                <label>Option 4</label>
                                                <input type="text" class="form-control" name="option_4"
                                                    value="{{ $ques->option_4 }}">
                                            </div>

                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>

                            </form>
                            <a href="{{ url("dashboard/exams/show-questions/$exam->id") }}"
                                class="btn btn-primary">Back</a>
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
