@extends('app')

@section('title', '商品編集画面')

@section('content')
    
    <div class="row">
        <div class="col-lg-12">
            <div>
                <h1>商品編集画面</h1>
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
        <form action="{{ route('update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="product_name" class="required">商品名</label>
                <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}">
                @if($errors->has('product_name'))
                    <p>{{ $errors->first('product_name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="company_name" class="required">メーカー名</label>
                <select name="company_name" id="company_name" class="form-select">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('company_id'))
                <p>{{ $errors->first('company_name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="price" class="required">価格</label>
                <input type="text" name="price" id="price" class="form-control"  value="{{ $product->price }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="stock" class="required">在庫数</label>
                <input type="text" name="stock" id="stock" class="form-control" value="{{ $product->stock }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea name="comment" id="comment" class="form-control">{{ $product->comment }}</textarea>
                @if($errors->has('comment'))
                    <p>{{ $errors->first('comment') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="img_path">商品画像</label>
                <input type="file" name="img_path" id="img_path" class="form-control">
                <div class="product_img">
                    @if($product->img_path)
                        <img src="{{ asset('storage/'.$product->img_path) }}" width="100" alt="商品画像">
                    @else
                        <img src="{{ asset('storage/no_picture.png') }}" width="100" alt="デフォルト画像">
                    @endif
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">更新</button>
                <a class="btn btn-success" href="{{ route('show', ['product' => $product->id]) }}">戻る</a>
            </div>
        </form>    
    </div>
@endsection
        