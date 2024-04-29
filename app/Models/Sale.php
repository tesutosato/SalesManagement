<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $dates =  ['created_at', 'updated_at'];
    protected $fillable = ['product_id'];
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
}
