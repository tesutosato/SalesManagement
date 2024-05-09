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

    // productテーブルとのリレーション
    public function products()
    {
        return $this->belongTo(Product::class);
    }


    // Salesテーブルに購入商品IDと購入日時を記録する
    public function registSale($product)
    {
        $this->product_id = $product->id; // 主キーであるIDと、created_at , updated_atは自動入力されるため不要
        $this->save();
    }
}
