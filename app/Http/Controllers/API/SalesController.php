<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Product; // Productモデルを使用
use App\Models\Sale; // Saleモデルを使用
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function buy(Request $request)
    {
        $product_model = new product();
        $sale_model = new sale();
        // リクエストから必要なデータを取得する
        $pId = $request->input('product_id'); // "product_id":7が送られた場合は7が代入される
        // dd($pId);
    // $stock = $request->input('stock', 1); // 購入する数を代入する もしも”quantity”というデータが送られていない場合は1を代入する

    // データベースから対象の商品を検索・取得
    $product = Product::find($pId); // "product_id":7 送られてきた場合 Product::find(7)の情報が代入される


    // 商品が存在しない、または在庫が不足している場合のバリデーションを行う
    if (!$product) {
        return response()->json(['message' => '商品が存在しません']);
    }
    if ($product->stock <= 0) {
        return response()->json(['message' => '商品が在庫不足です']);
    }

    // トランザクション開始
    DB::beginTransaction();

    try {
        // 登録処理呼び出し
        // 上でインスタンス化しているから下記の１行不要
        // $model = new Sale();
        // インスタンス化したモデルから呼び出す
        // $model->decStock($product);
        $product_model->decStock($product);
        $sale_model->registSale($product);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        // return back();
    }

    // 処理が完了したらregistにリダイレクト
    // return redirect(route('regist'));
    // 在庫を減少させる
    // $product->stock -= 1; 
    // $product->save();


    // Salesテーブルに商品IDと購入日時を記録する
    // $sale = new Sale([
    //     'product_id' => $productId,
        // 主キーであるIDと、created_at , updated_atは自動入力されるため不要
    // ]);

    // $sale->save();

    // レスポンスを返す
    return response()->json(['message' => '購入成功']);
    }
}
