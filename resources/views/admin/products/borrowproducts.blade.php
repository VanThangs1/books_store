@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đầu sách";
    $hasFilter = true;

    $sort_option = [
        "latest" => "Mới nhất",
        "oldest" => "Cũ nhất",
        "price_asc" => "Giá tăng dần",
        "price_desc" => "Giá giảm dần",
        "a_z" => "Từ A-Z",
        "z_a" => "Từ Z-A",
    ];

    $limit_option = [
        5, 10, 20, 30, 50    
    ];


    $status_option = [
        "2" => "Tất cả",
        "1" => "Enabled",
        "0" => "Disabled"
    ];
    $pagination = $products;
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
                        <br>
                        <div class="row">
                            <div class="col">
                                <input type="text" name = "search" value = "{{$current_filters['search'] ?? ''}}" class = "form-control" placeholder = "Tìm kiếm...">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <select name="author_id" class = "form-control" id="">
                                    <option value="">
                                        Tác giả
                                    </option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="cate_id" class = "form-control" id="">
                                    <option value="">Danh mục</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-2 ml-2">
                        <div class="row">
                            <button class="btn btn-info" type="submit">Lọc</button>
                        </div>
                        <br>
                        <div class="row">
                            <a class="btn btn-secondary" href="{{route('admin.customers')}}">Hủy lọc</a>
                        </div>
                    </div>
                </form>

                <hr>
                <div class="row">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sách</th>
                                <th>Tác giả</th>
                                <th>Ngày xuất bản</th>
                                <th>Giá/ngày</th>
                                <th>Đang mượn</th>
                                <th>Sẵn có</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="product-list-img">
                                    <img src="{{$product -> thumbnail}}" class="img-fluid" alt="tbl">
                                </td>
                                <td>
                                    <h6 class="mt-0 m-b-5">{{$product -> title}}</h6>
                                    <p class="m-0 font-14">{{$product -> description}}</p>
                                </td>
                                <td>{{$product -> author -> name}}</td>
                                <td>{{date_format(date_create($product -> publication_date), 'd/m/Y')}}</td>
                                <td>{{number_format($product -> price)}}đ</td>
                                <td>
                                    <a href="{{route('admin.borrow.filterbyproduct', $product -> id)}}">{{$product -> borrowing -> count()}}</a>
                                    
                                </td>
                                <td>
                                    @if($product -> quantity > 0)
                                        {{$product -> quantity}}
                                    @else
                                        <span class = "badge badge-danger">Hết sách</span>
                                    @endif
                                </td>
                                
                            
                                <td>
                                    <a href="{{route('admin.product.edit', $product -> id)}}" class="m-r-15 text-muted" data-toggle="" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
                                    @if($product -> quantity > 0)
                                        <a href="{{ route('admin.borrow.create').'?product_id='.$product -> id }}" class="m-r-15 text-muted" data-toggle="" data-placement="top" title="Tạo đơn cho sản phẩm này" data-original-title="Create-Borrow"><i class="mdi mdi mdi-account-plus font-18"></i></a>
                                    @endif
                                    
                                    <button class = "btn-danger" data-toggle="modal" data-target=".bs-delete-modal-sm" onclick = "modalConfirmDelete('Xác nhận xóa sản phẩm', 'Sản phẩm này sẽ bị xóa và không thể khôi phục', '{{route('admin.product.delete', $product -> id)}})')" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></button>
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
