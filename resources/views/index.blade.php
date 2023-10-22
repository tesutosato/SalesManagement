@extends('app')

@section('title', '商品情報一覧')

@section('content')
    
    <div class="title">
        <h1>商品情報一覧</h1>
    </div>

    <!-- 検索機能 -->
    <section class="search">
        <form action="{{ route('index') }}" method="GET">
            @csrf
            <input type="text" name="keyword" placeholder="検索キーワード">
            <select name="search_field">
                <option value='company_id'>メーカー名</option>
                @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
            <input type="submit" value="検索">
        </form>
    </section>

    <section>

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>商品画像</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th colspan="2">
                    <div>
                        <a class="btn btn-success" href="{{ route('create') }}">新規登録</a>
                    </div>
                </th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>
                @if($product->img_path)
                    <img src="{{ asset('storage/'.$product->img_path) }}" width="100px">
                @else
                    <img src="{{ asset('storage/no_picture.png') }}" width="100" alt="デフォルト画像">
                @endif
                </td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->company->company_name }}</td>
                <td><a class="btn btn-primary" href="{{ route('show', ['product' => $product->id, 'page_id' => request()->page]) }}">詳細</a>
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
    </section>

{!! $products->links('pagination::bootstrap-5') !!}
@endsection
