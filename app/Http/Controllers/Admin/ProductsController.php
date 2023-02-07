<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * List of products
     *
     * @param Request $request
     * 
     */
    public function index(Request $request)
    {

        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        $products = Product::orderBy('name', 'ASC');

        if(!empty($request->name)) {
            $products = $products->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if(!empty($request->code)) {
            $products = $products->where('code', 'LIKE', '%'.$request->code.'%');
        }

        if(!empty($request->type)) {
            $products = $products->where('type', $request->type);
        }

        $products = $products->paginate(10);

        return view('admin.products.index', [
            'products' => $products
        ]);
    }
    
    /**
     * go to create product page
     *
     * @return void
     */
    public function create()
    {
        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        return view('admin.products.create');
    }
    
    /**
     * Save Product
     *
     * @param Request $request
     * 
     */
    public function store(Request $request)
    {
        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        $validationRules = [
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'price' => 'required',
            'image' => 'required'
        ];

        $this->validate($request, $validationRules);

        $imageFilePath = '';
        $fileName = '';
        if($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $filePath = public_path('product-image/'.$fileName);

            file_put_contents($filePath, $request->file('image')->getContent());

            $imageFilePath = 'product-image/'.$fileName;
        }

        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->type = $request->type;
        $product->price = $request->price;
        $product->image_file_path = $imageFilePath;
        $product->save();

        return redirect()->route('admin.products.index')->with('success_message', 'Successfully created new product');
    }

    /**
     * details of product
     * 
     * @param Request $request
     * 
     */
    public function show($id)
    {
        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        $product = Product::where('id', $id)->first();
        
        if(empty($product)) {
            return redirect()->back()->with('error_message', 'Product is no longer exists!');
        }

        return view('admin.products.show', [
            'product' => $product
        ]);
    }

    /**
     * go to product edit page
     *
     * @param [type] $id
     * 
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * update Product
     *
     * @param Request $request
     * @param [type] $id
     * 
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        $product = Product::where('id', $id)->first();
        
        if(empty($product)) {
            return redirect()->back()->with('error_message', 'Product is no longer exists!');
        }

        $validationRules = [
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'price' => 'required'
        ];

        $this->validate($request, $validationRules);

        $imageFilePath = $product->image_file_path;
        if($request->hasFile('image')) {
            $oldImageFilePath = public_path($product->image_file_path);
            unlink($oldImageFilePath);

            $fileName = $request->file('image')->getClientOriginalName();
            $filePath = public_path('product-image/'.$fileName);

            file_put_contents($filePath, $request->file('image')->getContent());

            $imageFilePath = 'product-image/'.$fileName;
        }

        $product->name = $request->name;
        $product->code = $request->code;
        $product->type = $request->type;
        $product->price = $request->price;
        $product->image_file_path = $imageFilePath;
        $product->save();

        return redirect()->route('admin.products.show', [
            'id' => $product->id
        ])->with('success_message', 'Successfully updated product');
    }

    /**
     * delete product
     *
     * @param [type] $id
     * 
     */
    public function destroy(Request $request)
    {
        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        $product = Product::where('id', $request->id)->first();
        
        if(empty($product)) {
            return redirect()->back()->with('error_message', 'Product is no longer exists!');
        }

        $imageFilePath = public_path($product->image_file_path);
        unlink($imageFilePath);

        $product->delete();

        return redirect()->route('admin.products.index')->with('success_message', 'Successfully deleted product!');
    }
}
