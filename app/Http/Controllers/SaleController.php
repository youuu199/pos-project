<?php

namespace App\Http\Controllers;

use App\Models\PaymentHistory;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentHistory::with(['user', 'payment.order']);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sales = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dashboard.sale.saleList', compact('sales'));
    }

    public function view($id)
    {
        $sale = PaymentHistory::with(['user', 'payment.order', 'payment.paymentAccount'])->findOrFail($id);

        return view('admin.dashboard.sale.viewSale', compact('sale'));
    }
}
