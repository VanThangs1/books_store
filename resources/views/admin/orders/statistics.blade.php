@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";

    
@endphp

@section('main')
<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="mini-stat clearfix bg-white">
            <span class="mini-stat-icon bg-primary"><i class="mdi mdi-cart-outline"></i></span>
            <div class="mini-stat-info text-right">
                <span class="counter text-primary">{{$countCustomer}}</span>
                Tổng số khách hàng
            </div>
            <div class="clearfix"></div>
            <p class=" mb-0 m-t-20 text-muted">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="mini-stat clearfix bg-white">
            <span class="mini-stat-icon bg-success"><i class="mdi mdi-currency-usd"></i></span>
            <div class="mini-stat-info text-right">
                <span class="counter text-success">{{$countBorrow}}</span>
                Số lượng đơn cho mượn
            </div>
            <div class="clearfix"></div>
            <p class="text-muted mb-0 m-t-20">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="mini-stat clearfix bg-white">
            <span class="mini-stat-icon bg-warning"><i class="mdi mdi-cube-outline"></i></span>
            <div class="mini-stat-info text-right">
                <span class="counter text-warning">{{$countOrder}}</span>
                Số lượng đơn bán
            </div>
            <div class="clearfix"></div>
            <p class="text-muted mb-0 m-t-20">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xl-6">
    
        <div class="card m-b-10">
            <h4 class="mt-3 mb-30 ml-3 header-title">Top 5 Sách được mượn nhiều nhất</h4>   
            <div id="product">
                {{$chartProduct -> container()}}

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card m-b-20">
            <h4 class="mt-3 mb-30 ml-3 header-title">Top 5 khách hàng mượn sách nhiều nhất</h4> 
            <div id="customer">
                {!!$chartCustomer -> container()!!}
            </div>
        </div>
    </div> <!-- end col -->
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
        <h4 class="mt-3 mb-30 ml-3 header-title">Top 5 khách hàng trả muộn nhiều nhất</h4> 
            <div id="customer-late">
                {!!$chartCustomerLate -> container()!!}
            </div>
        </div>
    </div> <!-- end col -->

    
    
</div>
@endsection

@section('scripts')
        <!--C3 Chart-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://unpkg.com/vue"></>
        <script>
        var app = new Vue({
            el: '#customer',
        });
        var app1 = new Vue({
            el: '#product',
        });
        var app2 = new Vue({
            el: '#customer-late'
        })
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.7/c3.min.js"></script>
        {!! $chartCustomer->script() !!}
        {!! $chartCustomerLate->script() !!}
        {!! $chartProduct->script() !!}
        
@endsection
