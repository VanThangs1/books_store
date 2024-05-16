@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý danh mục";

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

    $pagination = $categories;
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
                                <a class="btn btn-secondary ml-2" href="{{route('admin.categories')}}">Hủy lọc</a>    
                            </div>
                        </div>
                    </form>
                    
                    <hr>
                    <div class="row">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên danh mục</th>
                                    <th>Ngày thêm</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>#{{$category -> id}}</td>
                                        <td class="product-list-img">
                                            <img src="{{$category -> thumbnail}}" class="img-fluid" alt="tbl">
                                        </td>
                                        <td>
                                            <h6 class="mt-0 m-b-5">{{$category -> title}}</h6>
                                            <p class="m-0 font-14">{{$category -> description}}</p>
                                        </td>
                                        <td>{{date_format(date_create($category -> created_at), 'd/m/Y H:m:s')}}</td>
                                        
                                    
                                        <td>
                                            <a href="{{route('admin.category.edit', $category -> id)}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
                                            <button class = "btn-danger" data-toggle="modal" data-target=".bs-delete-modal-sm" onclick = "modalConfirmDelete('Xác nhận xóa danh mục', 'Danh mục này sẽ bị xóa và không thể khôi phục', '{{route('admin.category.delete', $category -> id)}})')" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></button>
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