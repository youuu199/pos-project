@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Sale Information</h1>

    <!-- Search and Filter -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.sales') }}" class="form-inline">
                <div class="form-group mb-2">
                    <input type="text" name="search" class="form-control" placeholder="သုံးစွဲသူအမည် ရှာရန်..." value="{{ request('search') }}">
                </div>
                <div class="form-group mx-sm-2 mb-2">
                    <select name="status" class="form-control">
                        <option value="">အားလုံး</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>စောင့်ဆိုင်းနေသည်</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>ပြီးဆုံးသည်</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>ပယ်ဖျက်သည်</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fas fa-search"></i> ရှာရန်
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.sales') }}" class="btn btn-secondary mb-2 ml-2">ဖျက်ရန်</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ငွေပေးချေမှု မှတ်တမ်းများ</h6>
        </div>
        <div class="card-body">
            @if($sales->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>သုံးစွဲသူ</th>
                                <th>ပမာဏ</th>
                                <th>အခြေအနေ</th>
                                <th>နေ့စွဲ</th>
                                <th>လုပ်ဆောင်ချက်</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->user->name ?? 'N/A' }}</td>
                                    <td>{{ number_format($sale->amount) }} MMK</td>
                                    <td>
                                        @if($sale->status === 'pending')
                                            <span class="badge badge-warning">စောင့်ဆိုင်းနေသည်</span>
                                        @elseif($sale->status === 'completed')
                                            <span class="badge badge-success">ပြီးဆုံးသည်</span>
                                        @else
                                            <span class="badge badge-danger">ပယ်ဖျက်သည်</span>
                                        @endif
                                    </td>
                                    <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.sales.view', $sale->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $sales->links() }}
            @else
                <p class="text-center text-gray-500">ငွေပေးချေမှု မှတ်တမ်းများ မတွေ့ပါ။</p>
            @endif
        </div>
    </div>
@endsection
