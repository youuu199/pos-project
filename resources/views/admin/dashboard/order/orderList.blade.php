@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Order Board</h1>

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

    <!-- Search and Filter -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.orders') }}" class="form-inline">
                <div class="form-group mb-2">
                    <input type="text" name="search" class="form-control" placeholder="အော်ဒါကုဒ် ရှာရန်..." value="{{ request('search') }}">
                </div>
                <div class="form-group mx-sm-2 mb-2">
                    <select name="status" class="form-control">
                        <option value="">အားလုံး</option>
                        <option value="preparing" {{ request('status') === 'preparing' ? 'selected' : '' }}>ပြင်ဆင်နေသည်</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>ပြီးဆုံးသည်</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>ပယ်ဖျက်သည်</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fas fa-search"></i> ရှာရန်
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.orders') }}" class="btn btn-secondary mb-2 ml-2">ဖျက်ရန်</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">အော်ဒါများ</h6>
        </div>
        <div class="card-body">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>အော်ဒါကုဒ်</th>
                                <th>သုံးစွဲသူ</th>
                                <th>ကုန်ပစ္စည်း</th>
                                <th>ပမာဏ</th>
                                <th>စုစုပေါင်း</th>
                                <th>အခြေအနေ</th>
                                <th>နေ့စွဲ</th>
                                <th>လုပ်ဆောင်ချက်</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                                    <td>{{ $order->product->name ?? 'N/A' }}</td>
                                    <td>{{ $order->count }}</td>
                                    <td>{{ number_format($order->total_price) }} MMK</td>
                                    <td>
                                        @if($order->status === 'preparing')
                                            <span class="badge badge-warning">ပြင်ဆင်နေသည်</span>
                                        @elseif($order->status === 'completed')
                                            <span class="badge badge-success">ပြီးဆုံးသည်</span>
                                        @else
                                            <span class="badge badge-danger">ပယ်ဖျက်သည်</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.view', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            @else
                <p class="text-center text-gray-500">အော်ဒါများ မတွေ့ပါ။</p>
            @endif
        </div>
    </div>
@endsection
