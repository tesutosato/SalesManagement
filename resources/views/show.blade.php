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

    <section class="show">
        <table>
            <tr>
                <th>ID</th>
                <td>{{ $product->id }}</td>
            </tr>
            
            <tr>
                <th>商品名</th>
                <td>{{ $product->product_name }}</td>
            </tr>
            
            <tr>
                <th>商品画像</th>
                <td>
                @if($product->img_path)
                    <img src="{{ asset('storage/'.$product->img_path) }}" width="150px">
                @else
                    <img src="{{ asset('storage/no_picture.png') }}" width="100" alt="デフォルト画像">
                @endif
                </td>
            </tr>
            
            <tr>
                <th>価格</th>
                <td>{{ $product->price }}</td>
            </tr>
            
            <tr>
                <th>在庫数</th>
                <td>{{ $product->stock }}</td>
            </tr>
            
            <tr>
                <th>メーカー名</th>
                <td>{{ $product->company->company_name }}</td>
            </tr>
            
        </table>
        <a class="btn btn-primary" href="{{ route('edit', ['product' => $product->id]) }}">編集</a>
        <a class="btn btn-secondary" href="{{ route('index', ['page' => $page_id]) }}">戻る</a>
    </section>

@endsection