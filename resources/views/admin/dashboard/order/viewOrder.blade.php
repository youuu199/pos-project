@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">အော်ဒါအသေးစိတ်</h1>

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

    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">အော်ဒါ အချက်အလက်များ</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">အော်ဒါကုဒ်</th>
                                <td>{{ $order->order_code }}</td>
                            </tr>
                            <tr>
                                <th>သုံးစွဲသူ</th>
                                <td>{{ $order->user->name ?? 'N/A' }} ({{ $order->user->email ?? 'N/A' }})</td>
                            </tr>
                            <tr>
                                <th>ကုန်ပစ္စည်း</th>
                                <td>{{ $order->product->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>ပမာဏ</th>
                                <td>{{ $order->count }}</td>
                            </tr>
                            <tr>
                                <th>တစ်ခုချင်းစျေးနှုန်း</th>
                                <td>{{ number_format($order->product->price ?? 0) }} MMK</td>
                            </tr>
                            <tr>
                                <th>စုစုပေါင်း</th>
                                <td><strong>{{ number_format($order->total_price) }} MMK</strong></td>
                            </tr>
                            <tr>
                                <th>အခြေအနေ</th>
                                <td>
                                    @if($order->status === 'preparing')
                                        <span class="badge badge-warning">ပြင်ဆင်နေသည်</span>
                                    @elseif($order->status === 'completed')
                                        <span class="badge badge-success">ပြီးဆုံးသည်</span>
                                    @else
                                        <span class="badge badge-danger">ပယ်ဖျက်သည်</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>အော်ဒါတင်သည့်နေ့</th>
                                <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            @if($order->payments->count() > 0)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">ငွေပေးချေမှု အချက်အလက်များ</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ငွေပေးချေမှု နည်းလမ်း</th>
                                        <th>ပမာဏ</th>
                                        <th>အခြေအနေ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->paymentAccount->account_name ?? 'N/A' }}</td>
                                            <td>{{ number_format($payment->amount) }} MMK</td>
                                            <td>
                                                @if($payment->status === 'pending')
                                                    <span class="badge badge-warning">စောင့်ဆိုင်းနေသည်</span>
                                                @elseif($payment->status === 'completed')
                                                    <span class="badge badge-success">ပြီးဆုံးသည်</span>
                                                @else
                                                    <span class="badge badge-danger">ပယ်ဖျက်သည်</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Update Status -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">အခြေအနေ ပြင်ဆင်ရန်</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.orders.updateStatus') }}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <div class="form-group">
                            <label>အခြေအနေ</label>
                            <select name="status" class="form-control">
                                <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>ပြင်ဆင်နေသည်</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>ပြီးဆုံးသည်</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>ပယ်ဖျက်သည်</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-save"></i> သိမ်းဆည်းရန်
                        </button>
                    </form>
                </div>
            </div>

            <a href="{{ route('admin.orders') }}" class="btn btn-secondary btn-block">
                <i class="fas fa-arrow-left"></i> ပြန်သွားရန်
            </a>
        </div>
    </div>
@endsection
