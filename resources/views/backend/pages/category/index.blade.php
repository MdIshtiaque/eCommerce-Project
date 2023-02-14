@extends('backend.layouts.master')



@section('title')
    Category Index
@endsection



@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <style>
        .datatable_length {
            padding: 20px 0;
        }
    </style>
@endpush




@section('admin_content')
    <div class="row">
        <h1>Category List Table</h1>
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Add New Category
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive my-2">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Slug</th>
                            <th scope="col">Options</th>

                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $category->updated_at->format('d/M/Y') }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->slug }}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">setting</button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('category.edit', $category->slug) }}">
                                                <i class="fas fa-edit"></i> Edit</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('category.destroy', $category->slug) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item del_warn"><i class="fas fa-trash"></i>
                                                    Delete</button>

                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection




@push('admin_script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                pagingType: 'first_last_numbers',
            });
        });

        $('.del_warn').click(function(event) {
            let form = $(this).closest('form');
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then( async result => {
                if (result.isConfirmed) {
                    await form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
