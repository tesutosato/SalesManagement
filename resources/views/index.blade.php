@extends('app')

@section('title', '商品情報一覧')

@section('content')
<div class="container test">
    
    <div class="title">
        <h1>商品情報一覧</h1>
    </div>

    <!-- 検索機能 -->
    <section class="search">
        <h2>検索条件で絞り込み</h2>
        <form id="productsForm" action="{{ route('index') }}" method="GET" class="row g-3">
            @csrf

            <div class="btn-group mr-2" role="group" aria-label="First group">
                <!-- 検索キーワードの入力欄 -->
                <div class="col-sm-12 col-md-2">
                    <input type="text" name="keyword" class="form-control" placeholder="検索キーワード">
                </div>
            <!-- 12/30 ↓id="product_search"追記 -->
            <!-- メーカーのプルダウン選択欄 -->
                <div class="col-sm-12 col-md-2">
                    <select name="search_field" id="product_search" class="form-control">
                        <!-- <option value='company_id'>メーカー名</option> -->
                        <option value=''>メーカー名</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>

            <!-- 最小価格の入力欄 -->
            <div class="col-sm-12 col-md-2">
                <input type="number" name="min_price" id="min_price" class="form-control" placeholder="最小価格" value="{{ request('min_price') }}">
            </div>

            <!-- 最大価格の入力欄 -->
            <div class="col-sm-12 col-md-2">
                <input type="number" name="max_price" id="max_price" class="form-control" placeholder="最大価格" value="{{ request('max_price') }}">
            </div>

            <!-- 最小在庫数の入力欄 -->
            <div class="col-sm-12 col-md-2">
                <input type="number" name="min_stock" id="min_stock" class="form-control" placeholder="最小在庫" value="{{ request('min_stock') }}">
            </div>

            <!-- 最大在庫数の入力欄 -->
            <div class="col-sm-12 col-md-2">
                <input type="number" name="max_stock" id=max_stock class="form-control" placeholder="最大在庫" value="{{ request('max_stock') }}">
            </div>

            <!-- 絞り込みボタン -->
            <div class="col-sm-12 col-md-1">
                <button class="btn btn-outline-secondary search-btn" id="search-btn" type="submit">絞り込み</button>
            </div>

            </form>
        <!-- 検索条件をリセットするためのリンクボタン -->
        <a href="{{ route('index') }}" class="btn btn-success mt-3">検索条件をリセット</a>
        </div>
        <!-- ↑ボタンまでformで加工必要はあるのか -->

        <!-- </form> -->
    </section>

    <section>
        <div id="productTable">
            <table class="table table-striped tablesorter" id="productsTable">
                <thead>
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
                </thead>
                <tbody id="productsTbody">
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
                                <button data-product_id="{{$product->id}}" type="submit" class="btn btn-danger delete-btn">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

<!-- 絞り込んだ条件を維持しつつページネーションする -->
{!! $products->appends(request()->query())->links('pagination::bootstrap-5') !!}
</div>
@endsection
