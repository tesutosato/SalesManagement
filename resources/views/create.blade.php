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
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <div>
            <div>
                <p>商品名</p>
            </div>
            <div>
                <input type="text" name="name" class="form-control">
            </div>
        </div>
        <div>
            <div>
                <p>メーカー名</p>
            </div>
            <div>
                <select name="company" class="form-select">
                    <option>選択してください</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <div>
                <p>価格</p>
            </div>
            <div>
                <input type="text" name="name" class="form-control">
            </div>
        </div>
        <div>
            <div>
                <p>在庫数</p>
            </div>
            <div>
                <input type="text" name="name" class="form-control">
            </div>
        </div>
        <div>
            <div>
                <p>コメント</p>
            </div>
            <div>
                <textarea class="form-control"></textarea>
            </div>
        </div>
        <div>
            <div>
                <p>商品画像</p>
            </div>
            <div>
                <input type="text" name="name" class="form-control">
            </div>
        </div>
        <div>
            <div>
                <button type="submit" class="btn btn-primary">登録</textarea>
            </div>
            <div>
                <a class="btn btn-success" href="{{ url('products') }}">戻る</a>
            </div>
        </div>

    </form>
    </div>

@endsection