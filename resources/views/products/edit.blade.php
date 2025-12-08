@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Edit Product</h2>
    </div>

    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Please fix the following issues:<br><br>
                <ul>
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Product Name:</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price (¥):</label>
                <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description:</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Image:</label><br>

                @if($product->image)
                    <img src="{{ asset('uploads/' . $product->image) }}" width="120" class="mb-2">
                @else
                    <p>No Image Uploaded</p>
                @endif

                <input type="file" name="image" class="form-control">
                <small class="text-muted">Leave empty if you don't want to change the image.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </form>

    </div>
</div>

@endsection
