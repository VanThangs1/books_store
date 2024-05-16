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
        "oldest" => "Cũ nhất"
    ];

    $time_option = [
        'all' => "Thời gian đặt",
        'day' => "Trong ngày",
        'week' => "Trong tuần",
        'month' => "Trong tháng",
        'year' => "Trong năm"    
    ];

    $limit_option = [
        5, 10, 20, 30, 50    
    ];

    $pagination = $borrows;
    
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
                                    <input type="text" name = "id" class="form-control" value = "{{$current_filters['id'] ?? ''}}" placeholder = "Tìm theo mã">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name = "name" class = "form-control" value = "{{$current_filters['name'] ?? ''}}" placeholder = "Tìm theo tên người mượn">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
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
                            <br>
                            <div class="row">
                                <select name="time_filter" id="" class = "form-control">
                                    @foreach($time_option as $key => $option)
                                        @if(isset($current_filters['time_filter']) && $key == $current_filters['time_filter'])
                                            <option selected value="{{$key}}">{{$option}}</option>
                                        @else
                                            <option  value="{{$key}}">{{$option}}</option>
                                        @endif
                                    @endforeach
                                </select>
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
                                    <th>ID</th>
                                    <th>Người mượn</th>
                                    <th>Sách</th>
                                    <th>Ngày mượn</th>
                                    <th>Ngày trả</th>
                                    <th>Ngày trả thực tế</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($borrows as $borrow)
                                    <tr>
                                        <td>#{{$borrow -> id}}</td>
                                        <td>
                                            <a href="{{route('admin.borrow.filterbyuser', ['user_id' => $borrow -> user_id, 'type' => 'all'])}}">
                                                {{$borrow -> customer -> name}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.borrow.filterbyproduct', $borrow -> product_id)}}">
                                                {{$borrow -> product -> title}}
                                            </a>
                                        </td>
                                        <td>{{date_format(date_create($borrow -> borrow_date), 'H:m d/m/Y')}}</td>
                                        <td>
                                            {{ date_format(date_create($borrow->return_date), 'H:i d/m/Y') }}
                                        </td>
                                        <td>
                                            @if($borrow->actual_return_date)
                                                {{ date_format(date_create($borrow->actual_return_date), 'H:i d/m/Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(time() > strtotime($borrow->return_date) && !$borrow->actual_return_date)
                                                <span class="badge badge-danger">Chưa trả</span>
                                            @elseif($borrow->actual_return_date && date_create($borrow->actual_return_date) > date_create($borrow->return_date))
                                                <span class="badge badge-warning">Trả muộn</span>
                                            @elseif($borrow->actual_return_date && date_create($borrow->actual_return_date) < date_create($borrow->return_date))
                                                <span class="badge badge-success">Đã trả</span>
                                            @else
                                                <span class="badge badge-warning">Chưa trả</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.borrow.edit', $borrow -> id)}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
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