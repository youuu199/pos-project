<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin.dashboard.profile.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ], [
            'name.required' => 'အမည် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'name.string' => 'အမည်သည် စာကြောင်းတစ်ကြောင်းဖြစ်ရမည်။',
            'name.max' => 'အမည်သည် 255 လုံးထက် မပိုရပါ။',
            'email.required' => 'အီးမေးလ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'email.email' => 'အီးမေးလ် ပုံစံ မှန်ကန်ရပါမည်။',
            'email.unique' => 'ထည့်သွင်းပြီးသော အီးမေးလ်နှင့် တူနေပါသည်။',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('updateSuccess', 'ပရိုဖိုင်ကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'လက်ရှိစကားဝှက် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.required' => 'စကားဝှက်အသစ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.string' => 'စကားဝှက်သည် စာကြောင်းတစ်ကြောင်းဖြစ်ရမည်။',
            'password.min' => 'စကားဝှက်သည် 8 လုံးထက် မနည်းရပါ။',
            'password.confirmed' => 'စကားဝှက်နှစ်ခု မတူညီပါ။',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'လက်ရှိစကားဝှက် မှားနေပါသည်။');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('passwordSuccess', 'စကားဝှက်ကို အောင်မြင်စွာ ပြောင်းလဲပြီးပါပြီ။');
    }
}
