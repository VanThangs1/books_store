@extends('layouts.user-onlyheader-layout')

@section('style')
    <style>
        .borrow {
            display: flex;
            justify-content: center;
        }     

        .borrow .container {
            background-color: #fff;
            margin: 7px;
            min-height: 100px;
            border-radius: 10px;
            padding: 20px;
        }
   
    </style>
@endsection

@section('main')
    <div class="borrow">
        <div class="container">
            <h1>Borrow-Detail</h1>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
