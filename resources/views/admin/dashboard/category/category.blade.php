@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        </div>

        <div class="">

            <div class="row px-2 mb-3">
                <div class="col-6 offset-6 col-md-6 ms-auto d-flex justify-content-end gap-2">
                    <form action="{{ route('admin.categories') }}" method="get" class="d-flex w-100">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="searchCategory"
                                aria-describedby="basic-addon2" name="searchCategory" value="{{ request('searchCategory') }}">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                    </form>

                    <form action="{{ route('admin.categories') }}" method="get">
                        <input type="text" hidden name="searchCategory" value="">
                        <button class="btn btn-danger" type="submit">Reset</button>
                    </form>
                </div>
            </div>

            <div class="row">

                <div class="col-12 col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('admin.categories.create') }}" method="post" class="p-2 rounded">
                                @csrf
                                <input type="text" name="categoryName" value="{{ old('categoryName') }}"
                                    class="form-control @error('categoryName') is-invalid @enderror"
                                    placeholder="Category Name...">
                                @error('categoryName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn btn-outline-primary mt-3 w-100">Create</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8">
                    <div class="table-responsive">
                        <table class="table table-hover shadow-sm text-nowrap">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($categories->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No Category Found</td>
                                    </tr>
                                @endif
                                @foreach ($categories as $count => $category)
                                    <tr>
                                        <td>{{ $count + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-outline-secondary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.delete', $category->id) }}"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $categories->links() }}
                    </div>

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
