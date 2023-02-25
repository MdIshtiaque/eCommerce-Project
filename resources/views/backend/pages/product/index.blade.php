@extends('backend.layouts.master')



@section('title')
    Product Index
@endsection



@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


    <style>
        .datatable_length {
            padding: 20px 0;
        }
    </style>
@endpush




@section('admin_content')
    <div class="row">
        <h1>Product List Table</h1>
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Add New Product
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive my-2">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">product Image</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">product Name</th>
                            <th scope="col">product Price</th>
                            <th scope="col">Stock/Alert</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Options</th>

                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>
                                <img src="{{ asset('uploads/products') }}/{{ $product->product_image }}" alt=""
                                    class="img-fluid rounded h-20 w-20">
                            </td>
                            <td>{{ $product->updated_at->format('d/M/Y') }}</td>
                            <td>{{ $product->category->title }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td><span class="badge bg-success">{{ $product->product_stock }}</span>/
                                <span class="badge bg-danger">{{ $product->alert_quantity }}</span>
                            </td>


                            <td>
                                @for ($i = 0; $i < $product->product_rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </td>




                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">setting</button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('product.edit', $product->slug) }}">
                                                <i class="fas fa-edit"></i> Edit</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('product.destroy', $product->slug) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item del_warn"><i
                                                        class="fas fa-trash"></i>
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
            }).then(async result => {
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
