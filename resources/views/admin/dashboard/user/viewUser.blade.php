@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">သုံးစွဲသူ အသေးစိတ်</h1>

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

    <div class="row">
        <!-- User Details -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">သုံးစွဲသူ အချက်အလက်များ</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">အမည်</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>အီးမေးလ်</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>ဖုန်း</th>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>လိပ်စာ</th>
                                <td>{{ $user->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>အခန်းကဏ္ဍ</th>
                                <td>
                                    @if($user->role === 'superadmin')
                                        <span class="badge badge-danger">Super Admin</span>
                                    @elseif($user->role === 'admin')
                                        <span class="badge badge-primary">Admin</span>
                                    @else
                                        <span class="badge badge-secondary">User</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>အော်ဒါအရေအတွက်</th>
                                <td>{{ $user->orders->count() }}</td>
                            </tr>
                            <tr>
                                <th>စာရင်းသွင်းသည့်နေ့</th>
                                <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="col-lg-4">
            <!-- Update Role -->
            @if($user->role !== 'superadmin')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning">အခန်းကဏ္ဍ ပြင်ဆင်ရန်</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.updateRole') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label>အခန်းကဏ္ဍ</label>
                                <select name="role" class="form-control">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block">
                                <i class="fas fa-save"></i> သိမ်းဆည်းရန်
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Delete User -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-danger">သုံးစွဲသူ ဖျက်ရန်</h6>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.users.delete', $user->id) }}" id="deleteForm">
                            <button type="button" class="btn btn-danger btn-block" onclick="confirmDelete()">
                                <i class="fas fa-trash"></i> ဖျက်ရန်
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <a href="{{ route('admin.users') }}" class="btn btn-secondary btn-block">
                <i class="fas fa-arrow-left"></i> ပြန်သွားရန်
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'ဖျက်မှာလား?',
                text: "ဒီသုံးစွဲသူကို ဖျက်ပါမလား?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ဖျက်ရန်',
                cancelButtonText: 'ပယ်ဖျက်ရန်'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>
@endsection
