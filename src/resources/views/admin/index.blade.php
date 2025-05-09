@extends('layouts.app')

@section('content')
<class="container mt-4">
    <h3 class="text-center mb-4">Admin</h3>

    <form method="GET" action="{{ route('admin.index') }}" class="d-flex flex-wrap justify-content-center align-items-center gap-2 mb-4">

    <div class="d-flex flex-wrap align-items-center gap-2">
        <!-- キーワード（名前・メール） -->
        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="名前やメールアドレスを入力してください" style="width: 340px;">

        <!-- 性別 -->
        <select name="gender" class="form-select" style="width: 100px;">
            <option value="" disabled {{ request('gender') === null || request('gender') === '' ? 'selected' : '' }}>性別</option>
            <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
            <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
             <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
        </select>

        <!-- お問い合わせの種類 -->
        <select name="category_id" class="form-select" style="width: 200px;">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <!-- 登録日 -->
        <input type="date" name="created_at" value="{{ request('created_at') }}" class="form-control" style="width: 120px;">

        <!-- 検索・リセットボタン -->
        <button type="submit" class="btn btn-primary me-0" style="width: 100px;">検索</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary me-2" style="width: 100px;">リセット</a>
    </div>
</form>

<a href="{{ route('admin.export', request()->query()) }}" class="btn btn-success mb-3" style="margin-left: 140px;">エクスポート</a>

@if ($contacts->hasPages())
    <div class="d-flex justify-content-center mb-3" style="margin-top: -55px; margin-left: 850px;">
        <nav>
            <ul class="pagination">
                {{-- 前へボタン --}}
                @if ($contacts->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">« </span></li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $contacts->previousPageUrl() }}" rel="prev">« </a>
                    </li>
                @endif

                {{-- ページ番号 --}}
                @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                    <li class="page-item {{ $contacts->currentPage() === $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                {{-- 次へボタン --}}
                @if ($contacts->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $contacts->nextPageUrl() }}" rel="next"> »</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link"> »</span></li>
                @endif
            </ul>
        </nav>
    </div>
@endif

<br>
    @if($contacts->count())
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ種類</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
               <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if($contact->gender === 1) 男性
                    @elseif($contact->gender === 2) 女性
                    @else その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content ?? '未分類' }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $contact->id }}">
                        詳細
                    </button>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($contacts as $contact)
<div class="modal fade" id="detailModal{{ $contact->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $contact->id }}">お問い合わせ詳細</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body">
                <p><strong>お名前：</strong>{{ $contact->last_name }} {{ $contact->first_name }}</p>
                <p><strong>性別：</strong>
                    @if($contact->gender === 1) 男性
                    @elseif($contact->gender === 2) 女性
                    @else その他
                    @endif
                </p>
                <p><strong>メールアドレス：</strong>{{ $contact->email }}</p>
                <p><strong>電話番号：</strong>{{ $contact->tel }}</p>
                <p><strong>住所：</strong>{{ $contact->address }}</p>
                <p><strong>建物名：</strong>{{ $contact->building }}</p>
                <p><strong>お問い合わせの種類：</strong>{{ $contact->category->content ?? '未分類' }}</p>
                <p><strong>お問い合わせ内容：</strong><br>{{ $contact->detail }}</p> {{-- 修正点 --}}
            </div>

            <div class="modal-footer justify-content-center">
                <form method="POST" action="{{ route('admin.destroy', $contact->id) }}" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')

                        <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

    <!-- <div class="d-flex justify-content-center">
        {{ $contacts->appends(request()->query())->links() }}
    </div> -->
    @else
        <p>該当するデータが見つかりませんでした。</p>
    @endif

</div>
@endsection