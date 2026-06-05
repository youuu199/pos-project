<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Admin Dashboard Product Page
    public function home(Request $request)
    {
        if($request['searchProduct'] === 'all' || $request['searchProduct'] === null) {
            $products = Product::orderBy('created_at', 'desc')->paginate(5);
            return view('admin.dashboard.product.productList', compact('products'));
        } elseif($request['searchProduct'] === 'low') {
            $products = Product::where('stock', '<=', 5)->orderBy('created_at', 'desc')->paginate(5);
            return view('admin.dashboard.product.productList', compact('products'));
        } else {
            $products = Product::where('name', 'like', '%' . $request['searchProduct'] . '%')->orderBy('created_at', 'desc')->paginate(5);
            return view('admin.dashboard.product.productList', compact('products'));
        }
    }

    // Admin Dashboard Add Product Page
    public function add()
    {
        $categories = Category::orderBy('created_at', 'desc')->select('id', 'name')->get();
        return view('admin.dashboard.product.addProduct', compact('categories'));
    }

    // Create Product
    public function create(Request $request)
    {
        $this->validation($request);
        $file = $request->file('image');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/products'), $fileName);

        Product::create([
            'name' => $request->productName,
            'category_id' => $request->categoryId,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $fileName
        ]);

        return back()->with('createSuccess', 'ကုန်ပစ္စည်းအသစ်ကို အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
    }

    // Admin Dashboard View Product Page
    public function view($id) {
        $product = Product::findOrFail($id);
        return view('admin.dashboard.product.viewProduct', compact('product'));
    }

    // Admin Dashboard Edit Product Page
    public function edit($id) {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('created_at', 'desc')->select('id', 'name')->get();
        return view('admin.dashboard.product.editProduct', compact('product', 'categories'));
    }

    // Update Product
    public function update(Request $request){
        $this->validation($request, 'update');
        $product = Product::findOrFail($request->id);
        $file = $request->file('image');

        if ($file) {
            $oldImagePath = public_path('images/products/' . $product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $fileName);
            $product->image = $fileName;
        }

        $product->update([
            'name' => $request->productName,
            'category_id' => $request->categoryId,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description
        ]);

        return back()->with('updateSuccess', 'ကုန်ပစ္စည်းကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    // Delete Product
    public function delete($id) {
        $product = Product::findOrFail($id);
        $imagePath = public_path('images/products/' . $product->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $product->delete();
        return back()->with('deleteSuccess', 'ကုန်ပစ္စည်းကို အောင်မြင်စွာ ဖျက်ပြီးပါပြီ။');
    }


    // Validation
    public function validation(Request $request, $action = 'null')
    {
        $request->validate([
            'productName' => 'required| unique:products,name,' . $request->id,
            'categoryId' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => $action === 'update' ? 'nullable|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048' : 'required|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048',
        ], [
            'productName.required' => 'ကုန်ပစ္စည်းအမည် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'productName.unique' => 'ကုန်ပစ္စည်းအမည် ထပ်နေ၍မရပါ။',
            'categoryId.required' => 'အမျိုးအစား ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'price.required' => 'စျေးနှုန်း ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'stock.required' => 'ပစ္စည်းလက်ကျန် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'description.required' => 'အသေးစိတ်ဖော်ပြချက် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'image.required' => 'ပုံ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'image.image' => 'ဖိုင်သည် ပုံဖိုင်အမျိုးအစား ဖြစ်ရပါမည်။',
            'image.mimes' => 'ပုံသည် jpeg, png, jpg, gif, svg, avif, webp ဖိုင်အမျိုးအစားများသာ ဖြစ်ရပါမည်။',
            'image.max' => 'ပုံအရွယ်အစားသည် 2MB ထက် မကျော်ရပါ။'
        ]);
    }
}
