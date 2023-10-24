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

    @if (session('success'))
        <div class="flash_message">
            {{ session('success') }}
        </div>
    @else
        <div class="flash_message">
            {{ session('error') }}
        </div>
    @endif

    <div>
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_name" class="required">商品名</label>
                <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}">
                @if($errors->has('product_name'))
                    <p class="text-danger">{{ $errors->first('product_name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="company_name" class="required">メーカー名</label>
                <select name="company_name" id="company_name" class="form-select" value="{{ old('company_name') }}">
                    <option hidden>選択してください</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('company_name'))
                <p class="text-danger">{{ $errors->first('company_name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="price" class="required">価格</label>
                <input type="text" name="price" id="price" class="form-control"  value="{{ old('price') }}">
                @if($errors->has('price'))
                    <p class="text-danger">{{ $errors->first('price') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="stock" class="required">在庫数</label>
                <input type="text" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
                @if($errors->has('stock'))
                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea name="comment" id="comment" class="form-control" value="{{ old('comment') }}"></textarea>
                @if($errors->has('comment'))
                    <p class="text-danger">{{ $errors->first('comment') }}</p>
                @endif
            </div>

            <div class="img form-group">
                <label for="img_path">商品画像</label>
                <input type="file" name="img_path" id="img_path" class="form-control" value="{{ old('img_path') }}">
                @if($errors->has('img_path'))
                    <p class="text-danger">{{ $errors->first('img_path') }}</p>
                @endif
            </div>

            <div>
                <button type="submit" class="btn btn-primary">登録</button>
                <a class="btn btn-success" href="{{ url('products') }}">戻る</a>
            </div>

        </form>
    </div>

@endsection