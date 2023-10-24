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

        $companies = Company::all();

        $keyword = $request->input('keyword');
        $searchField = $request->input('search_field');

        $query = Product::with('company');

        // 検索機能実装
        if (!empty($keyword) || (!empty($searchField) && $searchField != 'company_id')) {
            $query->where(function ($query) use ($keyword, $searchField) {
                if (!empty($keyword)) {
                    $query->where('id', 'LIKE', "%{$keyword}%")
                    ->orWhere('product_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('price', 'LIKE', "%{$keyword}%")
                    ->orWhere('stock', 'LIKE', "%{$keyword}%");
                }

                if (!empty($searchField) && $searchField != 'company_id') {
                    $query->orWhereHas('company', function ($query) use ($searchField) {
                        $query->where('id', $searchField);
                    });
                }
            });
        }
        
        $products = $query->paginate(5);

        return view('index', compact('products', 'companies'))
            ->with('page_id', request()->page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param \Illuminate\Http\Response
     */
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
    {
        // トランザクション開始
        DB::beginTransaction();

        try {
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            // エラーが発生した場合はトランザクションロールバック
            DB::rollback();
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
        return view('show', compact('product'))
            ->with('page_id', request()->page_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
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
    public function update(ProductRequest $request, Product $product)
    {
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
