@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";
    
@endphp

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <form action = "{{route('admin.borrow.handleEdit', $foundBorrow -> id)}}" method = "POST" enctype = "multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                
                                <label for="id">ID: </label>
                                <input type="text" disabled class = "form-control" value = "{{$foundBorrow -> id}}">
                            </div>
                            <div class="form-group">
                                
                                <label for="user_id">Khách hàng</label>
                                <input type="text" class = "form-control" disabled value = "{{$foundBorrow -> customer -> id}} - {{$foundBorrow -> customer -> name}} - {{$foundBorrow -> customer -> email}}">
                                
                            </div>
                            <div class="form-group">
                                <label for="product_id">Sách</label>
                                <input type="text" class = "form-control" disabled value = "{{$foundBorrow -> product -> id}} - {{$foundBorrow -> product -> title}}">
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
                                <input id="borrow_date" name="borrow_date" value="{{ date('Y-m-d\TH:i', strtotime($foundBorrow->borrow_date)) }}" type="datetime-local" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="return_date">Ngày trả dự kiến</label>
                                <input id="return_date" name="return_date" value="{{ date('Y-m-d\TH:i', strtotime($foundBorrow->return_date)) }}" type="datetime-local" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="return_date">Ngày trả thực tế</label>
                                <input id="return_date" name="actual_return_date" value="{{ $foundBorrow->actual_return_date ? date('Y-m-d\TH:i', strtotime($foundBorrow->actual_return_date)) : '' }}" type="datetime-local" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Save Changes</button>
                    <a href = "{{route('admin.borrows')}}" class="btn btn-secondary waves-effect" style = "color: #fff">
                        Cancel
                    </a>
                    @csrf
                    @method('PUT')
                </form>

            </div>
        </div>
    </div>
</div>
@endsection






