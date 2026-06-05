@extends('admin.layouts.master')

@section('content')
    <div class="container">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-8 offset-2 card p-3 shadow-sm rounded">
                <div class="header">
                    <h3 class="text-center">Add New Product</h3>
                </div>

                <form action="{{ route('admin.products.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <img class="img-profile mb-1 w-25" id="output" src="">
                            <input type="file" name="image" id=""
                                class="form-control mt-1 @error('image') is-invalid @enderror" onchange="loadFile(event)">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="productName" value="{{ old('productName') }}"
                                        class="form-control @error('productName') is-invalid @enderror"
                                        placeholder="Enter Product Name">
                                    @error('productName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Category Name</label>
                                    <select name="categoryId" id=""
                                        class="form-control @error('categoryId') is-invalid @enderror">
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('categoryId') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('categoryId')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="price" value="{{ old('price') }}"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Enter Product Price">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="text" name="stock" value="{{ old('stock') }}"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        placeholder="Enter Product Stock">
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="10"
                                class="form-control @error('description') is-invalid @enderror" placeholder="Enter Product Description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Create Product" class=" btn btn-primary w-100 rounded shadow-sm">
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        function loadFile(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        }

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
