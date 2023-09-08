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
                 <label for="product_name">商品名</label>
                <!-- <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}"> -->
                <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}">
                @if($errors->has('product_name'))
                    <p>{{ $errors->first('product_name') }}</p>
                @endif
            </div>

            <div>
                <label for="company_name">メーカー名</label>
                <!-- <select name="company_name" id="company_name" class="form-select" value="{{ $product->company->company_name }}"> -->
                <select name="company_name" id="company_name" class="form-select">
                    <!-- <option hidden>選択してください</option> -->
                    @foreach ($companies as $company)
                    <!-- <option value="{{ $company->id }}">{{ $company->company_name }}</option> -->
                        <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('company_id'))
                <!-- <p>{{ $errors->first('company_name') }}</p> -->
                <p>{{ $errors->first('company_name') }}</p>
                @endif
            </div>

            <div>
                <label for="price">価格</label>
                <input type="text" name="price" id="price" class="form-control"  value="{{ $product->price }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
            </div>

            <div>
                <label for="stock">在庫数</label>
                <input type="text" name="stock" id="stock" class="form-control" value="{{ $product->stock }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
            </div>

            <div>
                <label for="comment">コメント</label>
                <!-- <textarea name="comment" id="comment" class="form-control" value="{{ $product->comment }}"></textarea> -->
                <textarea name="comment" id="comment" class="form-control">{{ $product->comment }}</textarea>
                @if($errors->has('comment'))
                    <p>{{ $errors->first('comment') }}</p>
                @endif
            </div>

            <div>
                <label for="img_path">商品画像</label>
                <!-- <input type="file" name="image_path" id="img_path" class="form-control" value="{{ asset('storage/'.$product->img_path) }}"> -->
                <input type="file" name="img_path" id="img_path" class="form-control">
                @if($product->img_path)
                    <!-- <p>{{ $errors->first('img_path') }}</p> -->
                    <img src="{{ asset('storage/'.$product->img_path) }}" width="100" alt="商品画像">
                @endif
            </div>
            <div>
                <button type="submit" class="btn btn-primary">更新</button>
                <a class="btn btn-success" href="{{ route('show', ['product' => $product->id]) }}">戻る</a>
            </div>
        </form>    
    </div>
@endsection
        