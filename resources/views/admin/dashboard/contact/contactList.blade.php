@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ဆက်သွယ်မှုများ</h1>

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

    <!-- Search -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.contacts') }}" class="form-inline">
                <div class="form-group mb-2">
                    <input type="text" name="search" class="form-control" placeholder="အမည်၊ အီးမေးလ်၊ ခေါင်းစဉ် ရှာရန်..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-2">
                    <i class="fas fa-search"></i> ရှာရန်
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.contacts') }}" class="btn btn-secondary mb-2 ml-2">ဖျက်ရန်</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Contacts Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ဆက်သွယ်မှုများ</h6>
        </div>
        <div class="card-body">
            @if($contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>အမည်</th>
                                <th>အီးမေးလ်</th>
                                <th>ခေါင်းစဉ်</th>
                                <th>မက်ဆေ့</th>
                                <th>နေ့စွဲ</th>
                                <th>လုပ်ဆောင်ချက်</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ Str::limit($contact->message, 50) }}</td>
                                    <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.contacts.view', $contact->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $contacts->links() }}
            @else
                <p class="text-center text-gray-500">ဆက်သွယ်မှုများ မတွေ့ပါ။</p>
            @endif
        </div>
    </div>
@endsection
