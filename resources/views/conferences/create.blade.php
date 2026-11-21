@extends('layouts.app')
@section('title', __('messages.create_title'))
@section('content')
<section class="container form-page"><a class="back-link" href="{{ route('conferences.index') }}">← {{ __('messages.back') }}</a><div class="form-panel"><h1>{{ __('messages.create_title') }}</h1><p class="text-secondary">{{ __('messages.create_intro') }}</p><p class="small text-secondary">{{ __('messages.required_note') }}</p>
<form method="POST" action="{{ route('conferences.store') }}">@csrf @include('conferences.fields')<div class="mt-4"><button class="btn btn-primary" type="submit">{{ __('messages.add') }}</button></div></form></div></section>
@endsection
