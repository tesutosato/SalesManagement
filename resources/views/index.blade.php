@extends('app')

@section('title', '商品情報一覧')

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
            <th>商品名</th>
            <th>商品画像</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <!-- <td><img src="{{ $product->img_path }}"></td> -->
            <td><img src="{{ asset('storage/'.$product->img_path) }}" width="100px"></td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company->company_name }}</td>
            <td><a class="btn btn-primary" href="{{ route('show', [$product->id]) }}">詳細</a>
            <td>
            <form action="{{route('destroy', $product->id)}}" method="POST">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>

{!! $products->links('pagination::bootstrap-5') !!}
@endsection
