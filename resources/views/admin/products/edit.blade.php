@extends('layouts.app')

@section('content')

<h2>Edit Product</h2>

<div class="card">
    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.products.update', $product) }}"
              enctype="multipart/form-data"
              class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input name="name" value="{{ $product->name }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Price</label>
                <input name="price" value="{{ $product->price }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Category</label>
                <input name="category" value="{{ $product->category }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Stock</label>
                <input name="stock" value="{{ $product->stock }}" class="form-control">
            </div>

            <div class="col-md-12">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="col-md-12">
                <button class="btn btn-warning">Update</button>
                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
