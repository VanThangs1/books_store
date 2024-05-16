@extends('layouts.user-onlyheader-layout')
@php

@endphp
@section('style')
    
@endsection

@section('main')
    <div class="product-detail">
        <div class="container">
            <!-- Thêm một phần tử div để hiển thị PDF -->
            @foreach ($images as $image)
                <img src="{{ asset('temp_images/' . $image) }}" alt="Page Image">
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
