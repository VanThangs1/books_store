@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";
    $sub_page_title = "Chi tiết đơn hàng";

    $order_status = [
        [
            "title" => "Đang xử lý",
            "color" => "bg-gradient-warning"
        ],
        [
            "title" => "Đã giao hàng",
            "color" => "bg-gradient-success"
        ],
        [
            "title" => "Hủy đơn",
            "color" => "bg-gradient-danger"
        ],
    ];
@endphp

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <h4 class="pull-right font-16"><strong>Order # {{$foundOrder -> id}}</strong></h4>
                            <h3 class="m-t-0">
                                <img src="{{asset('assets/images/logo.png')}}" alt="logo" height="26"/>
                            </h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <address>
                                    <strong>Billed To:</strong><br>
                                    John Smith<br>
                                    1234 Main<br>
                                    Apt. 4B<br>
                                    Springfield, ST 54321
                                </address>
                            </div>
                            <div class="col-6 text-right">
                                <address>
                                    <strong>Shipped To:</strong><br>
                                    {{$foundOrder -> shipping_address}}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 m-t-30">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    {{$foundOrder -> payment_method}}
                                </address>
                            </div>
                            <div class="col-6 m-t-30 text-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    {{date_format(date_create($foundOrder -> created_at), 'd/m/Y')}}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="panel panel-default">
                            <div class="p-2">
                                <h3 class="panel-title font-20"><strong>Order summary</strong></h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Title</strong></td>
                                            <td class="text-center"><strong>Price</strong></td>
                                            <td class="text-center"><strong>Quantity</strong>
                                            </td>
                                            <td class="text-right"><strong>Totals</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{$product -> id}}</td>
                                                <td>{{$product -> TITLE}}</td>
                                                <td class="text-center">{{$product -> item_price}}</td>
                                                <td class="text-center">{{$product -> quantity}}</td>
                                                <td class="text-right">{{($product -> item_price) * ($product -> quantity)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-print-none">
                                    <div class="pull-right">
                                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                        <a href="#" class="btn btn-primary waves-effect waves-light">Send</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection