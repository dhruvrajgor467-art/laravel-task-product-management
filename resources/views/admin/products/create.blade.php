@extends('layouts.app')

@section('content')

<h2>Add Product</h2>

<div class="card">
    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data"
              class="row g-3">
            @csrf

            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input name="name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Price</label>
                <input name="price" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Category</label>
                <input name="category" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Stock</label>
                <input name="stock" class="form-control" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary">Create</button>
                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
