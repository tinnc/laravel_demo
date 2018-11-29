<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Product;

class ProductController extends HelperController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index', [
            'products' => Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create',[
            'product' => new Product,
            'category_id' => self::show_type_products()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $product = new Product();
        $input['image'] = $product->handleFile($request);
        $input['alias'] = str_slug($input['name'], '-');
        $input['created_at'] = date('Y-m-d');
        $input['updated_at'] = date('Y-m-d');
        Product::create($input);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $id)
    {
        return view('admin.product.edit',[
            'product' => $product,
            'category_id' => self::show_type_products()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, UpdateRequest $request, $id)
    {
        if ($request->hasFile('image_product')) {

            if ($request->file('image_product')->isValid()) {
                \File::delete("images/san_pham/$product->image");
                $file = $request->file('image_product');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =time().'.'.$extension;
                $file->move('images/san_pham/', $filename);
            } else {
                echo 'File is invalid';
            }
        } else {
            $filename = $product->image;
        }

        if (isset($product) && isset($filename)) {
            $product->name = $request->get('name');
            $product->category_id = $request->get('category_id');
            $product->image = $filename;
            $product->detail = $request->get('detail');
            $product->summary = $request->get('summary');
            $product->price = $request->get('price');
            $product->created_at = date('Y-m-d');
            $product->is_new = 1;
            $product->status = 1;
            $product->alias = str_slug($request->get('name'), '-');
            $product->views = 0;
            $product->discount = $request->get('discount');
            $product->save();
        }

        return view('admin.product.show', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id, Request $request)
    {
        $product = Product::find($id);

        $filename = $product->image;

        if (isset( $filename)) {
            \File::delete("images/san_pham/$filename");
        }

        Product::destroy($id);

        return redirect()->route('product.index');
    }

    public function search(Product $product, Request $request)
    {
        $products = $product->where('name', 'like', '%'.$request->input('name').'%')->paginate(10);

        return view('admin.product.index', compact('products'));
    }

}
