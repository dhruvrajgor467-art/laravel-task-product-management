@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        Add Product
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- IMPORT CARD -->
<div class="card mb-4">
    <div class="card-header">Bulk Import Products</div>
    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.products.import') }}"
              enctype="multipart/form-data"
              class="row g-3">
            @csrf

            <div class="col-md-6">
                <input type="file" name="file" class="form-control" required>
            </div>

            <div class="col-md-3">
                <button class="btn btn-success">Import</button>
            </div>
        </form>
    </div>
</div>

<!-- PRODUCTS TABLE -->
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Stock</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $product->image) }}"
                         width="60"
                         height="60"
                         class="rounded"
                         alt="Product Image">
                </td>
                <td>{{ $product->name }}</td>
                <td>₹{{ $product->price }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}"
                       class="btn btn-sm btn-warning">Edit</a>

                    <form method="POST"
                          action="{{ route('admin.products.destroy', $product) }}"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this product?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No products found</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links('pagination::bootstrap-5') }}

@endsection
