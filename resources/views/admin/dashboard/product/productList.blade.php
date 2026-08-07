@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('admin.products.add') }}" class="btn btn-primary">
                    + Add Product
                </a>
            </div>
        </div>
        <div class=" d-flex justify-content-between my-2">
            <div class="">
                <button class=" btn btn-secondary rounded shadow-sm"> <i class="fa-solid fa-database"></i>
                    Product Count ( {{ $products->total() }} ) </button>
                <a href="{{ route('admin.products', ['searchProduct' => 'all']) }}"
                    class=" btn btn-outline-primary  rounded shadow-sm">All Products</a>
                <a href="{{ route('admin.products', ['searchProduct' => 'low']) }}"
                    class=" btn btn-outline-danger  rounded shadow-sm">Low Amount Product List</a>
            </div>
            <div class="d-flex">
                <form action="{{ route('admin.products') }}" method="get" class="form-inline mr-2">
                    <select name="category" class="form-control rounded shadow-sm mr-2" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <form action="{{ route('admin.products') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="searchProduct" value="{{ request('searchProduct') }}"
                            class=" form-control" placeholder="Enter Search Product Name">
                        <button type="submit" class=" btn bg-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover shadow-sm ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <td class="align-middle">
                                        <img src="{{ asset('images/products/' . $product->image) }}"
                                            class="img-thumbnail rounded shadow-sm" style="width:100px; height:100px; object-fit:cover;" alt="">
                                    </td>
                                    <td class="align-middle"> {{ $product->name }}</td>
                                    <td class="align-middle"> {{ $product->price }} mmk</td>
                                    <td class="col-2 align-middle">
                                        <button type="button" class="btn btn-secondary position-relative">
                                            {{ $product->stock }}
                                            @if ($product->stock <= 5)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    Low
                                                </span>
                                            @endif
                                        </button>
                                    </td>
                                    <td class="align-middle">{{ $product->category?->name ?? '-' }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.products.view', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('admin.products.delete', $product->id) }}" class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="align-middle text-center">
                                    <h5 class="text-muted mb-0">No Product Found</h5>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="">
                    {{ $products->links() }}
                </div>
            </div>
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
