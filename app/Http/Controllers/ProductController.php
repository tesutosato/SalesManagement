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
    public function index(Request $request)
    {
        // 外部結合を含むデータを取得
        $products = Product::with('company') 
        ->paginate(5);

        return view('index', compact('products'))
        ->with('page_id', request()->page);
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
        // トランザクション開始
        DB::beginTransaction();

        try {
            // ファイルをアップロードして保存
            // $file_name = $request->file('img_path')->getClientOriginalName();
            // $request->file('img_path')->storeAs('public/', $file_name);

            // 登録処理呼び出し
            // $product = Product::create([
            //     'product_name' => $request->input('product_name'),
            //     'company_id' => $request->input('company_name'),
            //     'price' => $request->input('price'),
            //     'stock' => $request->input('stock'),
            //     'comment' => $request->input('comment'),
            //     'img_path' => str_replace('public/', '', $file_name),
            // ]);
            $model = new Product();
            $model->registProduct($request);
            // $model->registProduct($data);
            DB::commit();
        } catch (\Exception $e) {
            // エラーが発生した場合はトランザクションロールバック
            DB::rollback();
            // return back()->withInput()->withErrors(['error' => '登録に失敗しました']);
            return back();
        }       
        // 処理が完了したら入力画面にリダイレクト
        return redirect()->route('create')->with('success', '商品を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function edit(Product $product)
    public function edit($product)
    {
        $product = Product::findOrFail($product);

        $companies = Company::all();
        return view('edit', compact('product'))
        ->with('companies', $companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Product $product)
    public function update(ProductRequest $request, Product $product)
    {
        // dd($product);
        // トランザクション開始
        DB::beginTransaction();

        try {
            $product->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            // エラーが発生した場合はトランザクションロールバック
            DB::rollback();
            return back();
        }       
        // 処理が完了したら入力画面にリダイレクト
        return redirect()->route('edit', $product->id)->with('success', '商品を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('index')
        ->with('success', $product->name.'を削除しました');
    }
}
