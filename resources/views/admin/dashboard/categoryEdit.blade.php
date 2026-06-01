@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category Edit</h1>
        </div>

        <div class="">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body shadow">
                            <form action="{{ route('admin.categories.update') }}" method="post" class="p-3 rounded">
                                @csrf
                                <input type="hidden" name="categoryId" value="{{ $category->id }}">
                                <input type="text" name="categoryName" value="{{ $category->name, old('categoryName') }}"
                                    class=" form-control @error('categoryName') is-invalid @enderror"
                                    placeholder="Category Name...">
                                @error('categoryName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="text-right">
                                    <input type="submit" value="Update" class="btn btn-outline-primary mt-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>

    </div>
@endsection

@section('script')
@endsection
