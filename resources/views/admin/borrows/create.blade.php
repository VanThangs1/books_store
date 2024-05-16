@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";
    
@endphp

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <form action = "{{route('admin.borrow.handleCreate')}}" method = "POST" enctype = "multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                
                                <label for="user_id">Khách hàng</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer -> id}}">{{$customer -> id}} - {{$customer -> name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label for="product_id">Sách</label>
                                <select name="product_id" id="product_id" class="form-control" required>
                                    @foreach($products as $product)
                                        <option value="{{$product -> id}}">{{$product -> id}} - {{$product -> title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="borrow_note">Ghi chú</label>
                                <textarea class="form-control" id="borrow_note" name ="borrow_note" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="borrow_date">Ngày mượn</label>
                                <input id="borrow_date" name="borrow_date" value="{{ date('Y-m-d\TH:i') }}" type="datetime-local" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="return_date">Ngày trả dự kiến</label>
                                <input id="return_date" name="return_date" value="{{ date('Y-m-d\TH:i', strtotime('+3 days')) }}" type="datetime-local" class="form-control">
                            </div>                        
                        </div>

                        
                    </div>

                    <button type="submit" class="btn btn-success waves-effect waves-light">Create</button>
                    <button type="submit" class="btn btn-secondary waves-effect">
                        <a href="">Cancel</a>
                    </button>
                    @csrf
                </form>

            </div>
        </div>
    </div>
</div>
@endsection






