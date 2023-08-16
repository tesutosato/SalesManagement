@extends('app')

@section('content')
    
    <div class="row">
        <div class="col-lg-12">
            <div>
                <h1>商品情報一覧</h1>
            </div>
            <div>
                <a class="btn btn-success" href="{{ route('create') }}">新規登録</a>
            </div>
        </div>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->img_path }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company_id }}</td>
            <td><button type="button" class="btn">詳細</td>
            <td><button type="button" class="btn">削除</td>
        </tr>
        @endforeach
    </table>

{!! $products->links('pagination::bootstrap-5') !!}
<!-- {!! $products->render() !!} -->
    @endsection
