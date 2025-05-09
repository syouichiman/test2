@extends('layouts.app')

@section('content')

<br><br><br><br><br><br><br><br><br>
<div class="container mt-5 text-center">
    <h3 class="mb-4">お問い合わせありがとうございました</h3>
    <a href="{{ route('contact.create') }}" class="btn btn-primary mt-3 btn-lg">HOME</a>
</div>
@endsection