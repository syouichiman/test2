@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h3 class="mb-4 text-center">Contact</h3>

    <form method="POST" action="{{ route('contact.confirm') }}" novalidate>
        @csrf

        <br>
        {{-- お名前 --}}
        <div class="mb-3 row">
            <label for="last_name" class="col-sm-2 col-form-label text-end">
                お名前 <span class="text-danger">※</span>
            </label>
            <div class="col-sm-3">
                <input type="text" name="last_name" id="last_name" class="form-control" style="margin-left: 110px;" value="{{ old('last_name') }}">
                @error('last_name')
                    <div class="text-danger" style="margin-left: 110px;">{{ $message }}</div>
                @enderror
            </div>
            <label for="first_name" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-3">
                <input type="text" name="first_name" id="first_name" class="form-control" style="margin-left: -110px;" value="{{ old('first_name') }}">
                @error('first_name')
                    <div class="text-danger" style="margin-left: 30px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- 性別 --}}
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label text-end">
                性別 <span class="text-danger">※</span>
            </label>
            <div class="col-sm-10 d-flex align-items-center">
                <div class="form-check me-5" style="margin-left: 110px;">
                    <input class="form-check-input" type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label">男性</label>
                </div>
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                    <label class="form-check-label">女性</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                    <label class="form-check-label">その他</label>
                </div>
            </div>
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- メールアドレス --}}
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label text-end">
                メールアドレス <span class="text-danger">※</span>
            </label>
            <div class="col-sm-5" style="margin-left: 110px;">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="mb-3 row">
            <label for="tel" class="col-sm-3 col-form-label ps-2" style="margin-left: 120px;">
                電話番号 <span class="text-danger">※</span>
            </label>
            <div class="col-sm-6 offset-sm-1" style="margin-left: -120px;">
                <div class="d-flex">
                   <input type="text" name="tel1" class="form-control me-2" maxlength="4" style="max-width: 150px;" value="{{ old('tel1') }}">
                   <span class="mx-1 align-self-center">-</span>
                   <input type="text" name="tel2" class="form-control me-2" maxlength="4" style="max-width: 150px;" value="{{ old('tel2') }}">
                   <span class="mx-1 align-self-center">-</span>
                   <input type="text" name="tel3" class="form-control" maxlength="4" style="max-width: 150px;" value="{{ old('tel3') }}">
                </div>

                @error('tel1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                @error('tel2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                @error('tel3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
        </div>

        {{-- 住所 --}}
        <div class="mb-3 row">
            <label for="address" class="col-sm-2 col-form-label text-end">
                住所 <span class="text-danger">※</span>
            </label>
            <div class="col-sm-5" style="margin-left: 110px;">
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
            
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            </div>
        </div>

        {{-- 建物名 --}}
        <div class="mb-3 row">
            <label for="building" class="col-sm-2 col-form-label text-end">
                建物名
            </label>
            <div class="col-sm-5" style="margin-left: 110px;">
                <input type="text" name="building" id="building" class="form-control" value="{{ old('building') }}">
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="mb-3 row">
            <label for="category_id" class="col-sm-2 col-form-label text-end">
                お問い合わせの種類 <span class="text-danger">※</span>
            </label>
            <div class="col-sm-3" style="margin-left: 110px;">
                <select name="category_id" id="category_id" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="mb-3 row">
            <label for="detail" class="col-sm-2 col-form-label text-end">
                お問い合わせ内容 <span class="text-danger">※</span>
            </label>
            <div class="col-sm-5" style="margin-left: 110px;">
                <textarea name="detail" id="detail" class="form-control" rows="5">{{ old('detail') }}</textarea>
                
                @error('detail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
        </div>

        <br>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">確認画面</button>
        </div>
        
    </form>
</div>
@endsection