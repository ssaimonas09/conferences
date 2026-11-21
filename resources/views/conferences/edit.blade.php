@extends('layouts.app')
@section('title', __('messages.edit_title'))
@section('content')
<section class="container form-page"><a class="back-link" href="{{ route('conferences.index') }}">← {{ __('messages.back') }}</a><div class="form-panel"><h1>{{ __('messages.edit_title') }}</h1><p class="text-secondary">{{ __('messages.edit_intro') }}</p><p class="small text-secondary">{{ __('messages.required_note') }}</p>
<form method="POST" action="{{ route('conferences.update', $conference) }}" novalidate>@csrf @method('PUT') @include('conferences.fields')<div class="mt-4"><button class="btn btn-primary" type="submit">{{ __('messages.update') }}</button></div></form></div></section>
@endsection
