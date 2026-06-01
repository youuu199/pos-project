<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    // Admin Dashboard Category Page
    public function home()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.dashboard.category', compact('categories'));
    }

    // Create Category
    public function create(Request $request)
    {
        $this->validateCategoryName($request);

        Category::create([
            'name' => $request->categoryName,
        ]);

        return back()->with('createSuccess', 'အမျိုးအစား အသစ်ကို အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
    }

    // Edit Category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return back()->with('error', 'အမျိုးအစားကို မတွေ့ပါ။');
        }
        return view('admin.dashboard.categoryEdit', compact('category'));
    }

    // Update Category
    public function update(Request $request,)
    {
        $category = Category::findOrFail($request->categoryId);
        $this->validateCategoryName($request, $category->id);

        $category->update([
            'name' => $request->categoryName,
        ]);

        return to_route('admin.categories')->with('updateSuccess', 'အမျိုးအစားကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    // Delete Category
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('deleteSuccess', 'အမျိုးအစားကို အောင်မြင်စွာ ဖျက်ခဲ့ပါသည်။');
    }

    // Validation Category Name
    public function validateCategoryName(Request $request, $categoryId = null)
    {
        $request->validate([
            'categoryName' => [
                'required',
                'string',
                'min:2',
                'max:100',
                Rule::unique('categories', 'name')->ignore($categoryId),
            ],
        ], [
            'categoryName.required' => 'အမျိုးအစားအမည် လိုအပ်သည်။',
            'categoryName.string' => 'အမျိုးအစားအမည်သည် စာကြောင်းတစ်ကြောင်းဖြစ်ရမည်။',
            'categoryName.min' => 'အမျိုးအစားအမည်သည် 2 လုံးထက် မနည်းရပါ။',
            'categoryName.max' => 'အမျိုးအစားအမည်သည် 100 လုံးထက် မပိုရပါ။',
            'categoryName.unique' => 'ထည့်သွင်းပြီးသော အမျိုးအစားအမည်နှင့် တူနေပါသည်။',
        ]);
    }
}
