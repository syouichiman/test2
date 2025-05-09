@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Confirm</h3>
    <br>

    <table class="table table-bordered table-striped w-50 mx-auto">
    <tbody>
        <tr>
            <td class="text-center ps-3 fw-bold" style="width: 30%;">お名前</td>
            <td>{{ $data['last_name'] }} {{ $data['first_name'] }}</td>
        </tr>
        <tr>
            <td class="text-center fw-bold">性別</td>
            <td>
                {{ $data['gender'] == 1 ? '男性' : ($data['gender'] == 2 ? '女性' : 'その他') }}
            </td>
        </tr>
        <tr>
            <td class="text-center fw-bold">メールアドレス</td>
            <td>{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td class="text-center fw-bold">電話番号</td>
            <td>{{ $data['tel'] }}</td>
        </tr>
        <tr>
            <td class="text-center fw-bold">住所</td>
            <td>{{ $data['address'] }}</td>
        </tr>
        <tr>
            <td class="text-center fw-bold">建物名</td>
            <td>{{ $data['building'] ?: 'なし' }}</td>
        </tr>
        <tr>
            <td class="text-center fw-bold">お問い合わせの種類</td>
            <td>{{ \App\Models\Category::find($data['category_id'])->content ?? '未選択' }}</td>
        </tr>
        <tr>
            <td class="text-center fw-bold">お問い合わせ内容</td>
            <td>{!! nl2br(e($data['detail'])) !!}</td>
        </tr>
    </tbody>
</table>

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        @foreach ($data as $key => $value)
            @if ($key === 'tel')
                <input type="hidden" name="tel" value="{{ $value }}">
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach
        
        <br>
        <div class="d-flex justify-content-between mt-4">

            <!-- 送信ボタン（保存処理へ） -->
             <div class="text-center mt-4">
                <button type="submit" name="action" value="submit"
                    class="btn btn-primary btn-lg" style="position: relative; left: 550px;">
                    送信
                </button>
             </div>
            
            <!-- 修正ボタン（入力画面へ） -->
             <div class="text-center mt-4">
                <a href="{{ route('contact.create') }}"
                    class="btn btn-secondary btn-lg" style="position: relative; left: -550px;">
                    修正
                </a>
             </div>
        </div>
    </form>
</div>
@endsection