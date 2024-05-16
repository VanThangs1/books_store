@extends('layouts.admin-layout')

@php
    $page_title = "Thêm danh mục";
@endphp

@section('main')
<form action="{{route('admin.category.handleCreate')}}" method="post" enctype = "multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="title">Category Title</label>
                                    <input id="title" name="title" type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name = "description" class="form-control" id="description" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name = "content" id="content" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                
                                <div class="form-group">
                                    <label>Product Image</label> <br/>
                                    <img src="assets/images/products/1.jpg" alt="product img" class="img-fluid" style="max-width: 200px;" />
                                    <br/>
                                    <input type="file" name = "upload_image" class="btn btn-purple m-t-10 waves-effect waves-light" required/>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Meta Data</h4>
                                <p class="text-muted m-b-30 font-14">Fill all information below</p>

                                <div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="meta_title">Meta title</label>
                                                <input id="meta_title" name="meta_title" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords</label>
                                                <input id="meta_keywords" name="metakeywords" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea class="form-control" id="meta_description" name = "meta_description" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light">Create</button>
                        <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
                    </div>

                </div>
            </div>

            
        </div>
    </div>
    @csrf
</form>
@endsection






