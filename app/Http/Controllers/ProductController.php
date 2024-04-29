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
    public function index(Request $request)
    {

        // 全ての会社を取得して$companies変数に格納
        $companies = Company::all();

        $searchField = $request->input('search_field');

        // $query = Product::with('company');
        $query = Product::query()->with('company');

        // 検索機能実装
        // 商品名の検索キーワードがある場合、そのキーワードを含む商品をクエリに追加
        if($keyword = $request->keyword){
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }
        
        // $search_fieldで選択したidと同じcompany_idをクエリに追加
        if($search_field = $request->search_field){
            $query->where('company_id', '=', $search_field);
        }
        
        // 最小価格が指定されている場合、その価格以上の商品をクエリに追加
        if($min_price = $request->min_price){
            $query->where('price', '>=', $min_price);
        }
        
        // 最大価格が指定されている場合、その価格以下の商品をクエリに追加
        if($max_price = $request->max_price){
            $query->where('price', '<=', $max_price);
        }
        
        // 最小在庫数が指定されている場合、その在庫数以上の商品をクエリに追加
        if($min_stock = $request->min_stock){
            $query->where('stock', '>=', $min_stock);
        }
        
        // 最大在庫数が指定されている場合、その在庫数以下の商品をクエリに追加
        if($max_stock = $request->max_stock){
            $query->where('stock', '<=', $max_stock);
        }
        // dd($query);

        $products = $query->paginate(5);
        
        // return response()->json(['products' => $products,
        //                             'companies' => $companies
        //                             ]);
        // }
        // dataType: 'html'指定にすると以下２行で動く
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
        // $product = Product::findOrFail($product->id);
        // 商品を削除
        // dd($product);
        $product->delete();
        return redirect()->route('index')
        ->with('success', $product->name.'を削除しました');
    }
}
