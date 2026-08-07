<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('user');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        $contacts = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dashboard.contact.contactList', compact('contacts'));
    }

    public function view($id)
    {
        $contact = Contact::with('user')->findOrFail($id);

        return view('admin.dashboard.contact.viewContact', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('deleteSuccess', 'ဆက်သွယ်မှုကို အောင်မြင်စွာ ဖျက်ပြီးပါပြီ။');
    }
}
