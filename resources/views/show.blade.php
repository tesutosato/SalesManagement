@extends('app')

@section('title', '商品情報詳細画面')

@section('content')
    
    <div class="row">
        <div class="col-lg-12">
            <div>
                <h1>商品情報詳細画面</h1>
            </div>
        </div>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>商品名</th>
            <th>商品画像</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
        </tr>
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <td><img src="{{ asset('storage/'.$product->img_path) }}" width="150px"></td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company->company_name }}</td>
        </tr>
    </table>
            <a class="btn btn-primary" href="{{ route('edit', ['product' => $product->id]) }}">編集</a>
            <a class="btn btn-secondary" href="{{ route('index') }}">戻る</a>

@endsection