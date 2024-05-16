@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý danh mục";
    $sub_page_title = "Sửa thông tin danh mục";
@endphp

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <form action = "{{route('admin.category.handleEdit', $foundCategory -> id)}}" method = "POST" enctype = "multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="meta_title">Category ID</label>
                                    <input id="meta_title" disabled  name="meta_title" value = "{{$foundCategory -> id}}" type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="title">Category Title</label>
                                    <input id="title" name="title" value = "{{$foundCategory -> title}}" type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name = "description" class="form-control" id="description" rows="5">{{$foundCategory -> description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name = "content" id="content" rows="5">{{$foundCategory -> content}}</textarea>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                
                                <div class="form-group">
                                    <label>Product Image</label> <br/>
                                    <img src="{{$foundCategory -> image}}" alt="product img" class="img-fluid" style="max-width: 200px;" />
                                    <br/>
                                    <input type="file" name = "upload_image" class="btn btn-purple m-t-10 waves-effect waves-light" />
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Meta Data</h4>
                                <p class="text-muted m-b-30 font-14">Fill all information below</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta title</label>
                                            <input id="meta_title" name="meta_title" value = "{{$foundCategory -> meta_title}}" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <input id="meta_keywords" name="metakeywords" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea class="form-control" id="meta_description" name = "meta_description"  rows="5">{{$foundCategory -> meta_description}}</textarea>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                        </div>

                        @csrf
                        @method('PUT')

                        <button type="submit" class="btn btn-success waves-effect waves-light">Save Changes</button>
                        <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
   
@endsection





