<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:20',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'company_name' => 'required|integer',
            'comment' => 'max:1000',
            'img_path' => 'image',
        ];
    }

    /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'price' => '価格',
            'stock' => '在庫数',
            'company_name' => 'メーカー名',
            'comment' => 'コメント',
            'img_path' => '商品画像',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max' => ':attributeは:max字以内で入力してください。',
            'price.required' => ':attributeは必須項目です。',
            'price.integer' => ':attributeは数値で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.integer' => ':attributeは数値で入力してください。',
            'company_name.required' => ':attributeは必須項目です。',
            'company_name.integer' => ':attributeを選択してください。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
            'img_path.image' => ':attributeのファイル形式が異なります。',
        ];
    }
}