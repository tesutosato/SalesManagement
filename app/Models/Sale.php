<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $dates =  ['created_at', 'updated_at'];
    protected $fillable = ['id', 'product_id'];
    // ※一括代入の許可は要るのか
    // protected $table = 'sale';
    // protected $primaryKey = 'id';
    // protected $dates =  ['created_at', 'updated_at'];
    // protected $fillable = ['id', 'product_id'];

    // productテーブルとのリレーション
    public function products()
    {
        return $this->belongTo(Product::class);
    }

    // 在庫を減らす処理
    // public function decStock($id)
    // public function decStock($product)
    // {
        // $product = $this->find($product);
        // $product = $this->find($id);
    // 在庫を1つ減らす
    // $product->stock -= 1;
    // 変更を保存
    // $product->save();
    // return $product;
    // }

    // 購入商品情報をDBに登録する処理
    public function registSale($product)
    {
        $this->product_id = $product->id;
        $this->save();
    }
}
