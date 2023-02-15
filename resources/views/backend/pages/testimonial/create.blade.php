@extends('backend.layouts.master')

@section('title')
    Create Testimonial
@endsection

@push('admin_style')
@endpush


@section('admin_content')
    <div class="row">
        <h1>Create New Testimonial</h1>
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('testimonial.index') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Back To Testimonial Lists
                </a>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('testimonial.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="client-name" class="form-label">
                                Client Name
                            </label>

                            <input type="text" name="client_name" id=""
                                class="form-control @error('client_name')
                            is-invalid
                            @enderror"
                                placeholder="Enter Client Name">

                            @error('client_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="client-designation" class="form-label">
                                Client Designation
                            </label>

                            <input type="text" name="client_designation" id=""
                                class="form-control @error('client_designation')
                            is-invalid
                            @enderror"
                                placeholder="Enter Client Designation">

                            @error('client_designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="client-message" class="form-label">
                                Client Message
                            </label>

                            <input type="text" name="client_message" id=""
                                class="form-control @error('client_message')
                            is-invalid
                            @enderror"
                                placeholder="Enter Client message">

                            @error('client_message')
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
