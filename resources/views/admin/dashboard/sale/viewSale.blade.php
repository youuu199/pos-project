@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ငွေပေးချေမှု အသေးစိတ်</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">ငွေပေးချေမှု အချက်အလက်များ</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">ID</th>
                                <td>{{ $sale->id }}</td>
                            </tr>
                            <tr>
                                <th>သုံးစွဲသူ</th>
                                <td>{{ $sale->user->name ?? 'N/A' }} ({{ $sale->user->email ?? 'N/A' }})</td>
                            </tr>
                            <tr>
                                <th>ပမာဏ</th>
                                <td><strong>{{ number_format($sale->amount) }} MMK</strong></td>
                            </tr>
                            <tr>
                                <th>အခြေအနေ</th>
                                <td>
                                    @if($sale->status === 'pending')
                                        <span class="badge badge-warning">စောင့်ဆိုင်းနေသည်</span>
                                    @elseif($sale->status === 'completed')
                                        <span class="badge badge-success">ပြီးဆုံးသည်</span>
                                    @else
                                        <span class="badge badge-danger">ပယ်ဖျက်သည်</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>နေ့စွဲ</th>
                                <td>{{ $sale->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            @if($sale->payment)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">ငွေပေးချေမှု နည်းလမ်း</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">ငွေပေးချေမှု နည်းလမ်း</th>
                                    <td>{{ $sale->payment->paymentAccount->account_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>အော်ဒါကုဒ်</th>
                                    <td>{{ $sale->payment->order->order_code ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>ငွေပေးချေမှု အခြေအနေ</th>
                                    <td>
                                        @if($sale->payment->status === 'pending')
                                            <span class="badge badge-warning">စောင့်ဆိုင်းနေသည်</span>
                                        @elseif($sale->payment->status === 'completed')
                                            <span class="badge badge-success">ပြီးဆုံးသည်</span>
                                        @else
                                            <span class="badge badge-danger">ပယ်ဖျက်သည်</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <a href="{{ route('admin.sales') }}" class="btn btn-secondary btn-block">
                <i class="fas fa-arrow-left"></i> ပြန်သွားရန်
            </a>
        </div>
    </div>
@endsection
