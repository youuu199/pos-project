@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">သုံးစွဲသူများ</h1>

    @if(session('updateSuccess'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'အောင်မြင်ပါသည်',
                text: '{{ session('updateSuccess') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if(session('deleteSuccess'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'အောင်မြင်ပါသည်',
                text: '{{ session('deleteSuccess') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'မအောင်မြင်ပါ',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <!-- Search and Filter -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.users') }}" class="form-inline">
                <div class="form-group mb-2">
                    <input type="text" name="search" class="form-control" placeholder="အမည် သို့မဟုတ် အီးမေးလ် ရှာရန်..." value="{{ request('search') }}">
                </div>
                <div class="form-group mx-sm-2 mb-2">
                    <select name="role" class="form-control">
                        <option value="">အားလုံး</option>
                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fas fa-search"></i> ရှာရန်
                </button>
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.users') }}" class="btn btn-secondary mb-2 ml-2">ဖျက်ရန်</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">သုံးစွဲသူများ</h6>
        </div>
        <div class="card-body">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>အမည်</th>
                                <th>အီးမေးလ်</th>
                                <th>ဖုန်း</th>
                                <th>အခန်းကဏ္ဍ</th>
                                <th>စာရင်းသွင်းသည့်နေ့</th>
                                <th>လုပ်ဆောင်ချက်</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                    <td>
                                        @if($user->role === 'superadmin')
                                            <span class="badge badge-danger">Super Admin</span>
                                        @elseif($user->role === 'admin')
                                            <span class="badge badge-primary">Admin</span>
                                        @else
                                            <span class="badge badge-secondary">User</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.view', $user->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            @else
                <p class="text-center text-gray-500">သုံးစွဲသူများ မတွေ့ပါ။</p>
            @endif
        </div>
    </div>
@endsection
