@extends('layouts.user-onlyheader-layout')

@section('style')
    <style>
        .product-detail {
            display: flex;
            justify-content: center;
        }

        .product-detail .container {
            position: relative;
           background-color: #fff;
           min-height: 100px;
           border-radius: 5px;
           margin: 7px 0;
           padding: 20px 50px;
        }
        
        .bio {
            font-size: 1.6rem;
            line-height: 2.5rem!important;
            letter-spacing: 0.1rem; 
        }

        .bio > div {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bio > div p {
            width: 100%;
            
            margin-top: 7px;
        }

        .bio > div p sub {
            display: block;
        }

        .bio > div p strong {
            display: block;
            width: 100%!important;
            text-align: left;
            margin-top: 5px;
        }

        .bio sub {
            text-align: center;
        }

        .bio > div img {
            
            width: 100%;
            object-fit: contain;
        }

        .product-detail .img {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-detail .img img {
            object-fit: cover;
            max-height: 250px;
            margin-bottom: 10px;
        }

        .title {
            position: absolute;
            left: 10px;
            top: 20px;
            font-size: 2.3rem;
            font-weight: 500;
            color: #8FAAFF;
        }

    </style>
@endsection

        
@section('main')
    <div class="product-detail">
        <div class="container">
            <div class="title">Tiểu sử</div>
            <div class="img">
                <img src="{{$foundAuthor -> image}}" alt="$foundAuthor -> name">
                <h2>{{$foundAuthor -> name}}</h2>
            </div>
            <div class="bio">
                <p>&nbsp;</p>
                {!!$foundAuthor -> biography ?? ''!!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
