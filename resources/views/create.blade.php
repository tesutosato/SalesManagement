@extends('app')

@section('title', '商品登録画面')

@section('content')
    
    <div class="row">
        <div class="col-lg-12">
            <div>
                <h1>商品登録画面</h1>
            </div>
        </div>
    </div>

    <div>
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="product_name">商品名</label>
            <input type="text" name="product_name" id="product_name" class="form-control">
            @error('product_name')
            <span>商品名を20文字以内で入力してください</span>
            @enderror
        </div>

        <div>
            <label for="company_name">メーカー名</label>
            <select name="company_name" id="company_name" class="form-select">
                <option hidden>選択してください</option>
                @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                <!-- <option value="{{ $company->id }}">{{ $company->id }}</option> -->
                @endforeach
            </select>
            @error('company_id')
            <span>メーカーを選択してください</span>
            @enderror
        </div>

        <div>
            <label for="price">価格</label>
            <input type="text" name="price" id="price" class="form-control">
            @error('price')
            <span>価格を数字で入力してください</span>
            @enderror
        </div>

        <div>
            <label for="stock">在庫数</label>
            <input type="text" name="stock" id="stock" class="form-control">
            @error('stock')
            <span>在庫数を数字で入力してください</span>
            @enderror
        </div>

        <div>
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>

        <div>
            <label for="img_path">商品画像</label>
            <input type="text" name="img_path" id="img_path" class="form-control">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">登録</button>
            <a class="btn btn-success" href="{{ url('products') }}">戻る</a>
        </div>

    </form>
    </div>

@endsection