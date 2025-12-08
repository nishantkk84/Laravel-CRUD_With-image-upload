@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Product List</h2>

    <div>
        <a href="{{ route('products.export.excel') }}" class="btn btn-success me-2">Export Excel</a>
        <a href="{{ route('products.export.pdf') }}" class="btn btn-danger me-2">Export PDF</a>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
</div>

{{-- Search Form --}}
<form action="{{ route('products.index') }}" method="GET" class="mb-3 d-flex">
    <input type="text" name="search" class="form-control me-2" placeholder="Search products..."
           value="{{ request()->search }}">
    <button class="btn btn-dark" type="submit">Search</button>
</form>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price (¥)</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>
                @if($product->image)
                    <img src="{{ asset('uploads/'.$product->image) }}"
                         width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </td>

            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->description }}</td>

            <td>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection

{{-- SweetAlert Delete Script --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            let form = this.closest('form');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to undo this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
