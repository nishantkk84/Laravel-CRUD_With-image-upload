@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Product Details</h2>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <strong>Name:</strong>
            <p>{{ $product->name }}</p>
        </div>

        <div class="mb-3">
            <strong>Price:</strong>
            <p>₹ {{ $product->price }}</p>
        </div>

        <div class="mb-3">
            <strong>Description:</strong>
            <p>{{ $product->description }}</p>
        </div>

        <div class="mb-3">
            <strong>Product Image:</strong><br>
            @if($product->image)
                <img src="{{ asset('uploads/' . $product->image) }}" width="200" class="img-thumbnail mt-2">
            @else
                <p>No image available</p>
            @endif
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>

    </div>
</div>

@endsection
