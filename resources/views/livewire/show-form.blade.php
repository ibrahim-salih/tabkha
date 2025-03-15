@extends('layouts.cooker.auth')

@section('title')
الطباخ
@endsection
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
        @livewire('cooker-registration-form')
        </div>
    </div>
</div>
@endsection
