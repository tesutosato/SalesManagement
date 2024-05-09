<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
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
            // 購入商品の在庫減算処理
            $product_model->decStock($product);
            // 登録処理呼び出し
            $sale_model->registSale($product);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

    // レスポンスを返す
    return response()->json(['message' => '購入成功']);
    }
}
