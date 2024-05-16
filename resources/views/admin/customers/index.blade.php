@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý tác giả";

    $status_option = [
        "2" => "Tất cả",
        "1" => "Enabled",
        "0" => "Disabled"
    ];

    $sort_option = [
        "latest" => "Mới nhất",
        "oldest" => "Cũ nhất",
        "a_z" => "Từ A-Z",
        "z_a" => "Từ Z-A",
    ];

    $limit_option = [
        5, 10, 20, 30, 50    
    ];

    $pagination = $customers;
@endphp

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              
                <form class="row" method = "GET">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                
                                <select name="limit" id="limit" class = "form-control">
                                    @foreach($limit_option as $value)
                                        @if(isset($current_filters['limit']) && $value == $current_filters['limit'])
                                            <option selected value="{{$value}}">Hiển thị {{$value}}</option>
                                        @else
                                            <option value="{{$value}}">Hiển thị {{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="sort_filter" id="" class = "form-control">
                                    @foreach($sort_option as $key => $option)
                                        @if(isset($current_filters['sort_filter']) && $key == $current_filters['sort_filter'])
                                            <option selected value="{{$key}}">{{$option}}</option>
                                        @else
                                            <option  value="{{$key}}">{{$option}}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col">
                        <div class="row">
                            <input type="text" class = "form-control" placeholder = "Tìm kiếm..." value = "{{$current_filters['search'] ?? ''}}" name = "search">
                        </div>
                    </div>
                    <div class="col-2 ml-3">
                        <div class="row">
                            <button class="btn btn-info" type="submit">Lọc</button>
                            <a class="btn btn-secondary ml-2" href="{{route('admin.customers')}}">Hủy lọc</a>    
                        </div>
                    </div>
                </form>

                <hr>
                    
                
                <div class="row">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                              
                                <th>Ngày sinh</th>
                                <th>Đang mượn</th>
                                <th>Đã trả</th>
                                <th>Tổng mượn</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer -> name}}</td>
                                    <td>{{$customer -> gender}}</td>
                                    <td>{{$customer -> email}}</td>
                                    <td>{{$customer -> phone_number}}</td>
                                    
                                    <td>{{$customer -> date_of_birth ? date_format(date_create($customer -> date_of_birth), 'd/m/Y') : ''}}</td>
                                    <td>
                                        <a href="{{route('admin.borrow.filterbyuser', ['user_id' => $customer->id, 'type' => 'borrowing'])}}">{{$customer -> borrowing -> count()}}</a> 
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.borrow.filterbyuser', ['user_id' => $customer->id, 'type' => 'borrowed']) }}">{{$customer -> borrowed -> count()}}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.borrow.filterbyuser', ['user_id' => $customer->id, 'type' => 'all']) }}">{{ $customer->borrows()->count() }}</a>
                                    </td>
                                    <td>
                                        <a href="" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
                                        <a href="{{ route('admin.borrow.create').'?user_id='.$customer -> id }}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="Tạo đơn cho khách hàng này" data-original-title="Create-Borrow"><i class="mdi mdi-book-plus font-18"></i></a>
                                        <button class = "btn-danger" data-toggle="modal" data-target=".bs-delete-modal-sm" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></button>
                                    </td>
                                </tr> 
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                @include('partials.admin.pagination')
            </div>
        </div>
    </div>
</div>
@endsection 


@section('scripts')
        
@endsection