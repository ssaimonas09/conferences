@extends('layouts.app')
@section('title', __('messages.list_title'))
@section('content')
<section class="hero"><div class="container hero-inner">
    <p class="eyebrow">{{ __('messages.hero_eyebrow') }}</p>
    <h1>{{ __('messages.hero_title') }}</h1>
    <p class="hero-text">{{ __('messages.hero_text') }}</p>
</div></section>
<section class="container section-space">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div><h2 class="section-title mb-1">{{ __('messages.list_title') }}</h2><p class="text-secondary mb-0">{{ __('messages.list_count', ['count' => $conferences->total()]) }}</p></div>
        @auth<a class="btn btn-primary" href="{{ route('conferences.create') }}">+ {{ __('messages.new_conference') }}</a>@endauth
    </div>
    @if ($conferences->isEmpty())
        <div class="empty-state"><h3>{{ __('messages.empty_title') }}</h3><p class="mb-0">{{ __('messages.empty_text') }}</p></div>
    @else
        <div class="row g-4">
            @foreach ($conferences as $conference)
                <div class="col-md-6 col-lg-4"><article class="conference-card h-100">
                    <div class="card-top"><span class="date-chip">{{ $conference->date->format('d.m.Y') }}</span><span class="city-chip">{{ $conference->city }}</span></div>
                    <h3><a href="{{ route('conferences.show', $conference) }}">{{ $conference->title }}</a></h3>
                    <p class="card-description">{{ Str::limit($conference->description, 145) }}</p>
                    <p class="card-meta mb-0">{{ $conference->address }} · {{ __('messages.seats', ['count' => $conference->capacity]) }}</p>
                    <div class="card-actions"><a class="btn btn-outline-primary btn-sm" href="{{ route('conferences.show', $conference) }}">{{ __('messages.view') }}</a>
                        @auth<a class="btn btn-outline-secondary btn-sm" href="{{ route('conferences.edit', $conference) }}">{{ __('messages.edit') }}</a>
                        <form method="POST" action="{{ route('conferences.destroy', $conference) }}" data-confirm-delete data-confirm-title="{{ __('messages.confirm_title') }}" data-confirm-text="{{ __('messages.confirm_text') }}" data-confirm-yes="{{ __('messages.confirm_yes') }}" data-confirm-cancel="{{ __('messages.confirm_cancel') }}">@csrf @method('DELETE')<button class="btn btn-outline-danger btn-sm" type="submit">{{ __('messages.delete') }}</button></form>@endauth
                    </div>
                </article></div>
            @endforeach
        </div>
        <div class="mt-4">{{ $conferences->links() }}</div>
    @endif
</section>
@endsection
