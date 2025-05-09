@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>お問い合わせ詳細</h2>

    <div class="mb-3">
        <strong>名前：</strong> {{ $contact->last_name }} {{ $contact->first_name }}
    </div>
    <div class="mb-3">
        <strong>メールアドレス：</strong> {{ $contact->email }}
    </div>
    <div class="mb-3">
        <strong>性別：</strong>
        @if ($contact->gender == 1)
            男性
        @elseif ($contact->gender == 2)
            女性
        @else
            その他
        @endif
    </div>
    <div class="mb-3">
        <strong>お問い合わせ種類：</strong> {{ $contact->category->content ?? '不明' }}
    </div>
    <div class="mb-3">
        <strong>お問い合わせ内容：</strong><br>
        {{ $contact->detail }}
    </div>

    <a href="{{ route('admin.index') }}" class="btn btn-secondary">戻る</a>
</div>
@endsection