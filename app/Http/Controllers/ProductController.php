<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(ProductRequest $request)
    public function index()
    {
        return view('index', [
            'products' => DB::table('products')->paginate(5)
        ]);

        // $products = Product::paginate(6);
        // return view('index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param \Illuminate\Http\Response
     */
    // public function create(ProductRequest $request)
    public function create()
    {
        $companies = Company::all();
        return view('create')
            ->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    // public function store()
    {
        // dd($request->all());

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 登録処理呼び出し
            $product = new Product();
            // $model->registProduct($request);
            // DB::commit();
            $product->product_name = $request->input(["product_name"]);
            $product->company_id = $request->input(["company_name"]);
            $product->price = $request->input(["price"]);
            $product->stock = $request->input(["stock"]);
            $product->comment = $request->input(["comment"]);
            $product->img_path = $request->input(["img_path"]);
            $product->save();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したら入力画面にリダイレクト
        return redirect()->route('create')
        ->with('success', '商品を登録しました');
    
        // $product = new Product;
        // $product->product_name = $request->input(["product_name"]);
        // // $product->company_id = $request->input(["company_id"]);
        // $product->company_id = $request->input(["company_name"]);
        // $product->price = $request->input(["price"]);
        // $product->stock = $request->input(["stock"]);
        // $product->comment = $request->input(["comment"]);
        // $product->img_path = $request->input(["img_path"]);
        // $product->save();
        // return redirect()->route('create')
        // ->with('success', '商品を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
