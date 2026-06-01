@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        </div>

        <div class="">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body shadow">
                            <form action="{{ route('admin.categories.create') }}" method="post" class="p-3 rounded">
                                @csrf
                                <input type="text" name="categoryName" value="{{ old('categoryName') }}"
                                    class=" form-control @error('categoryName') is-invalid @enderror"
                                    placeholder="Category Name...">
                                @error('categoryName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="submit" value="Create" class="btn btn-outline-primary mt-3">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <table class="table table-hover shadow-sm ">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th></th>
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
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary"> <i
                                                class="fa-solid fa-pen-to-square"></i> </a>
                                        <a href="{{ route('admin.categories.delete', $category->id) }}" class="btn btn-sm btn-outline-danger"> <i
                                                class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <span class=" d-flex justify-content-end"></span>

                    {{ $categories->links() }}
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
