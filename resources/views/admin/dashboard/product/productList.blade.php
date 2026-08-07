@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Header Row -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0 text-gray-800">Products</h1>
            <a href="{{ route('admin.products.add') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add Product
            </a>
        </div>

        <!-- Filter Bar -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <!-- Product Count -->
                    <div class="col-auto">
                        <span class="btn btn-secondary rounded shadow-sm mb-0">
                            <i class="fa-solid fa-database"></i>
                            {{ $products->total() }}
                        </span>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="col-auto">
                        <a href="{{ route('admin.products', ['searchProduct' => 'all']) }}"
                            class="btn btn-outline-primary rounded shadow-sm {{ request('searchProduct') === 'all' || !request('searchProduct') ? 'active' : '' }}">
                            All
                        </a>
                        <a href="{{ route('admin.products', ['searchProduct' => 'low']) }}"
                            class="btn btn-outline-danger rounded shadow-sm {{ request('searchProduct') === 'low' ? 'active' : '' }}">
                            Low Stock
                        </a>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="col-auto">
                        <form action="{{ route('admin.products') }}" method="get" class="d-inline">
                            <select name="category" class="form-control form-control-sm rounded shadow-sm" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Spacer -->
                    <div class="col"></div>

                    <!-- Search -->
                    <div class="col-auto">
                        <form action="{{ route('admin.products') }}" method="get">
                            <div class="input-group input-group-sm">
                                <input type="text" name="searchProduct" value="{{ request('searchProduct') }}"
                                    class="form-control rounded-left shadow-sm" placeholder="Search product...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="width: 80px">Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count() > 0)
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="align-middle">
                                            <img src="{{ asset('images/products/' . $product->image) }}"
                                                class="rounded shadow-sm" style="width:60px; height:60px; object-fit:cover;" alt="">
                                        </td>
                                        <td class="align-middle fw-bold">{{ $product->name }}</td>
                                        <td class="align-middle">{{ number_format($product->price) }} MMK</td>
                                        <td class="align-middle">
                                            <span class="badge {{ $product->stock <= 5 ? 'badge-danger' : 'badge-success' }} p-2">
                                                {{ $product->stock }}
                                                @if ($product->stock <= 5)
                                                    Low
                                                @endif
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-info p-2">{{ $product->category?->name ?? '-' }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin.products.view', $product->id) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('admin.products.delete', $product->id) }}" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="align-middle text-center py-4">
                                        <i class="fa-solid fa-box-open fa-3x text-gray-300 mb-3"></i>
                                        <h5 class="text-muted mb-0">No Product Found</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if($products->hasPages())
                <div class="card-footer bg-white">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: "{{ session('error') }}",
                draggable: true,
                timer: 1500,
            });
        @endif

        @if (session('createSuccess'))
            Swal.fire({
                icon: 'success',
                title: "{{ session('createSuccess') }}",
                draggable: true,
                timer: 1500,
            });
        @endif

        @if (session('updateSuccess'))
            Swal.fire({
                icon: 'success',
                title: "{{ session('updateSuccess') }}",
                draggable: true,
                timer: 1500,
            });
        @endif

        @if (session('deleteSuccess'))
            Swal.fire({
                icon: 'success',
                title: "{{ session('deleteSuccess') }}",
                draggable: true,
                timer: 1500,
            });
        @endif
    </script>
@endsection
