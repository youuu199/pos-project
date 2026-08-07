<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dashboard.user.userList', compact('users'));
    }

    public function view($id)
    {
        $user = User::with(['orders', 'contacts'])->findOrFail($id);

        return view('admin.dashboard.user.viewUser', compact('user'));
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:user,admin',
        ], [
            'user_id.required' => 'သုံးစွဲသူ ID ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'user_id.exists' => 'ထည့်သွင်းထားသော သုံးစွဲသူကို ရှာမတွေ့ပါ။',
            'role.required' => 'အခန်းကဏ္ဍ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'role.in' => 'အခန်းကဏ္ဍသည် user သို့မဟုတ် admin ဖြစ်ရပါမည်။',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update(['role' => $request->role]);

        return back()->with('updateSuccess', 'သုံးစွဲသူအခန်းကဏ္ဍကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'superadmin') {
            return back()->with('error', 'superadmin ကို ဖျက်မရပါ။');
        }

        $user->delete();

        return back()->with('deleteSuccess', 'သုံးစွဲသူကို အောင်မြင်စွာ ဖျက်ပြီးပါပြီ။');
    }
}
