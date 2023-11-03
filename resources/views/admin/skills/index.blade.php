@extends('admin.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Skills</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Skills</li>
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
                                <h3 class="card-title mt-2">All Skills</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#add-modal">
                                        Add new
                                    </button>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0 ">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name (en)</th>
                                            <th>Name(ar)</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($skills as $skill)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $skill->name('en') }} </td>
                                                <td>{{ $skill->name('ar') }} </td>
                                                <td>{{ $skill->category->name('en') }} </td>
                                                <td>
                                                    <img src="{{ asset("uploads/$skill->image") }}" height="50px">
                                                </td>
                                                <td>
                                                    @if ($skill->active == 1)
                                                        <span class="badge bg-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-danger">No</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info edit-btn" data-toggle="modal"
                                                        data-id="{{ $skill->id }}"
                                                        data-name-en="{{ $skill->name('en') }}"
                                                        data-name-ar="{{ $skill->name('ar') }}"
                                                        data-img="{{ $skill->image }}" data-cat="{{ $skill->category_id }}"
                                                        data-target="#edit-modal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a class="btn btn-danger"
                                                        href="{{ url("dashboard/skills/delete/{$skill->id}") }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a class="btn "
                                                        href="{{ url("dashboard/skills/toggle/{$skill->id}") }}">
                                                        @if ($skill->active)
                                                            <i class="fas fa-toggle-on fa-lg text-success"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off fa-lg text-secondary"></i>
                                                        @endif
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="ml-3 pt-2">
                                    {{ $skills->links() }}
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

    {{-- Add Modal --}}
    <div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('dashboard/skills/store') }}" id="add" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name-en">Name (en)</label>
                            <input type="text" name="name_en" class="form-control" id="name-en">
                        </div>
                        <div class="form-group">
                            <label for="name-ar">Name (ar)</label>
                            <input type="text" name="name_ar" class="form-control" id="name-ar">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="custom-select form-control" name="cat_id">
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name('en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" >
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('dashboard/skills/update') }}" id="edit" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="edit-form-id">
                        <div class="form-group">
                            <label for="name-en">Name (en)</label>
                            <input type="text" name="name_en" class="form-control" id="edit-name-en">
                        </div>
                        <div class="form-group">
                            <label for="name-ar">Name (ar)</label>
                            <input type="text" name="name_ar" class="form-control" id="edit-name-ar">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="custom-select form-control" name="cat_id" id="edit-form-cat-id">
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name('en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="edit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.edit-btn').click(function() {
            let id = $(this).attr('data-id');
            let nameEn = $(this).attr('data-name-en');
            let nameAr = $(this).attr('data-name-ar');
            let catId = $(this).attr('data-cat');
            console.log(catId);
            $('#edit-form-id').val(id);
            $('#edit-name-en').val(nameEn);
            $('#edit-name-ar').val(nameAr);
            $('#edit-form-cat-id').val(catId);
        });
    </script>
@endsection
