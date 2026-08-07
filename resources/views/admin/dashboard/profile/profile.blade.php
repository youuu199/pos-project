@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ပရိုဖိုင်</h1>

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

    @if(session('passwordSuccess'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'အောင်မြင်ပါသည်',
                text: '{{ session('passwordSuccess') }}',
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
        <!-- Profile Info -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">ပရိုဖိုင် ပြင်ဆင်ရန်</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>အမည်</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>အီးမေးလ်</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>ဖုန်း</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>လိပ်စာ</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> သိမ်းဆည်းရန်
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="col-lg-4">
            <div class="card shadow mb-4" id="password">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">စကားဝှက် ပြောင်းရန်</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.changePassword') }}">
                        @csrf
                        <div class="form-group">
                            <label>လက်ရှိစကားဝှက်</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>စကားဝှက်အသစ်</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>စကားဝှက်အသစ် ထပ်မံထည့်သွင်းပါ</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-key"></i> စကားဝှက်ပြောင်းရန်
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
