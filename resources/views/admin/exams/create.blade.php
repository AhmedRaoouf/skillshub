@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Exam</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item active">Add New</li>
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
                            <form action="{{url('dashboard/exams/store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Name (en)</label>
                                                <input type="text" class="form-control" name="name_en">
                                            </div>

                                            <div class="col-6">
                                                <label>Name (ar)</label>
                                                <input type="text" class="form-control" name="name_ar">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Description (en)</label>
                                            <textarea class="form-control" name="desc_en" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Description (ar)</label>
                                            <textarea class="form-control" name="desc_ar" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Skill</label>
                                            <select class="form-control" name="skill_id">
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->id }}">{{ $skill->name('en') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Questions no.</label>
                                                    <input type="number" class="form-control" name="questions_no">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label >Difficulty</label>
                                                    <input type="number" class="form-control" name="difficulty">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label >Duration
                                                        mins.</label>
                                                    <input type="number" class="form-control" name="duration_mins">
                                                </div>
                                            </div>
                                        </div>
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
