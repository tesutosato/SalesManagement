<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'company_id',
        'price',
        'stock',
        'comment',
        'img_path'
    ];

    // Companyテーブルとのリレーション
    public function company()
    {
    return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    // Saleテーブルとのリレーション
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function registProduct($data) {
        // 画像ファイルがアップロードされたかどうかをチェック
        if($data->hasFile('img_path')) {
            $file_name = $data->img_path->getClientOriginalName();
            $data->img_path->storeAs('public/', $file_name);
            $this->img_path = $file_name;
        }

        $this->product_name = $data->input('product_name');
        $this->company_id = $data->input('company_name');
        $this->price = $data->input('price');
        $this->stock = $data->input('stock');
        $this->comment = $data->input('comment');
        $this->save();
    }

}
