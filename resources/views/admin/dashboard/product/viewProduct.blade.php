@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-10 offset-1 card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 text-center">
                    <h3 class="fw-bold text-primary mb-0">Product Details</h3>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-5 text-center">
                            <div class="p-3 bg-light rounded-4 d-inline-block shadow-sm">
                                <img class="img-fluid rounded" style="max-height: 280px; object-fit: contain;"
                                    src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                            </div>
                        </div>

                        <div class="col-md-7 d-flex flex-column">
                            <div class="mb-3 border-bottom pb-3">
                                <h4 class="fw-bold mb-1 text-dark">{{ $product->name }}</h4>
                                <span class="badge bg-warning text-white rounded-pill">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </div>

                            <div class="row mb-3 g-3">
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <span class="d-block text-muted small fw-semibold text-uppercase mb-1">Price</span>
                                        <span class="fs-5 fw-bold text-dark">{{ number_format($product->price) }} <small class="text-muted fw-normal fs-6">mmk</small></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <span class="d-block text-muted small fw-semibold text-uppercase mb-1">Current Stock</span>
                                        @if ($product->stock < 10)
                                            <span class="fs-5 fw-bold text-danger">{{ $product->stock }} <small class="fw-normal fs-6 text-muted">(Low)</small></span>
                                        @else
                                            <span class="fs-5 fw-bold text-success">{{ $product->stock }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 flex-grow-1">
                                <span class="d-block text-muted small fw-semibold text-uppercase mb-2">Description</span>
                                <div class="text-secondary p-3 bg-light rounded-3 border"
                                     style="line-height: 1.6; max-height: 150px; overflow-y: auto;">
                                    {{ $product->description ?? 'No description provided for this product.' }}
                                </div>
                            </div>

                            <div class="d-flex mt-auto pt-3 border-top">
                                <a href="{{ route('admin.products') }}" style="margin-right: 10px;" class="btn btn-light px-4 border me-3">
                                    <i class="fa-solid fa-arrow-left me-2"></i> Back to List
                                </a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
