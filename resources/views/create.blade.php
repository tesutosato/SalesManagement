@extends('app')

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
        <div>
            <div>
                <label>商品名</label>
            </div>
            <div>
                <input type="text" name="product_name" class="form-control">
                @error('product_name')
                <span>商品名を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div>
            <div>
                <label>メーカー名</label>
            </div>
            <div>
                <select name="company_name" class="form-select">
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
        </div>
        <div>
            <div>
                <label>価格</label>
            </div>
            <div>
                <input type="text" name="price" class="form-control">
                @error('price')
                <span>価格を数字で入力してください</span>
                @enderror
            </div>
        </div>
        <div>
            <div>
                <label>在庫数</label>
            </div>
            <div>
                <input type="text" name="stock" class="form-control">
                @error('stock')
                <span>在庫数を数字で入力してください</span>
                @enderror
            </div>
        </div>
        <div>
            <div>
                <label>コメント</label>
            </div>
            <div>
                <textarea name="comment" class="form-control"></textarea>
            </div>
        </div>
        <div>
            <div>
                <label>商品画像</label>
            </div>
            <div>
                <input type="text" name="img_path" class="form-control">
            </div>
        </div>
        <div>
            <div>
                <button type="submit" class="btn btn-primary">登録</button>
            </div>
            <div>
                <a class="btn btn-success" href="{{ url('products') }}">戻る</a>
            </div>
        </div>

    </form>
    </div>

@endsection