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
            'product_name' => 'required|max20',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'company_name' => 'required|integer',
            'comment' => 'max:1000',
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
            'price' => '値段',
            'stock' => '在庫数',
            'company_id' => '会社名',
            'comment' => 'コメント',
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
            'company_id.required' => ':attributeは必須項目です。',
            'company_id.integer' => ':attributeは数値で入力してください。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }
}
