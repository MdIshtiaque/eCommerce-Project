@extends('backend.layouts.master')

@section('title')
    Create Category
@endsection

@push('admin_style')
@endpush


@section('admin_content')
    <div class="row">
        <h1>Create New Category</h1>
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Back To Category Lists
                </a>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="category-title" class="form-label">
                                Category Title
                            </label>

                            <input type="text" name="title" id=""
                                class="form-control @error('title')
                            is-invalid
                            @enderror"
                                placeholder="Enter Category Title">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" name="is_active" type="checkbox" role="switch"
                                id="activeStatus" checked>
                            <label class="form-check-label" for="activeStatus">Active or
                                Inactive</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</ strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-success">
                                Store
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('admin_script')
@endpush
