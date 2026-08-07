<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'product']);

        if ($request->filled('search')) {
            $query->where('order_code', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dashboard.order.orderList', compact('orders'));
    }

    public function view($id)
    {
        $order = Order::with(['user', 'product', 'payments.paymentAccount'])->findOrFail($id);

        return view('admin.dashboard.order.viewOrder', compact('order'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:preparing,completed,cancelled',
        ], [
            'order_id.required' => 'အော်ဒါ ID ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'order_id.exists' => 'ထည့်သွင်းထားသော အော်ဒါကို ရှာမတွေ့ပါ။',
            'status.required' => 'အခြေအနေ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'status.in' => 'အခြေအနေသည် preparing, completed, cancelled ဖြစ်ရပါမည်။',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->update(['status' => $request->status]);

        return back()->with('updateSuccess', 'အော်ဒါအခြေအနေကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }
}
