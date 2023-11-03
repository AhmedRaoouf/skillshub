@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Questions (Step2) </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item active">Add New (Step2)</li>
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
                            <form action="{{ url("dashboard/exams/store-questions/$exam_id") }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">

                                        @for ($i = 1; $i <= $questions_no; $i++)
                                            <h5>Questions {{ $i }}</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title[]">
                                                </div>

                                                <div class="col-6">
                                                    <label>Right Ans.</label>
                                                    <input type="number" class="form-control" name="right_anss[]">
                                                </div>
                                                <div class="col-6">
                                                    <label>Option 1</label>
                                                    <input type="text" class="form-control" name="option_1s[]">
                                                </div>

                                                <div class="col-6">
                                                    <label>Option 2</label>
                                                    <input type="text" class="form-control" name="option_2s[]">
                                                </div>

                                                <div class="col-6">
                                                    <label>Option 3</label>
                                                    <input type="text" class="form-control" name="option_3s[]">
                                                </div>

                                                <div class="col-6">
                                                    <label>Option 4</label>
                                                    <input type="text" class="form-control" name="option_4s[]">
                                                </div>

                                            </div>
                                            <hr>
                                        @endfor



                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
