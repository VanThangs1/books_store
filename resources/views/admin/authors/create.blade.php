@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý tác giả";
    $sub_page_title = "Tạo mới tác giả";
@endphp

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <form action = "{{route('admin.author.handleCreate')}}" method = "POST" enctype = "multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Author Name</label>
                                <input id="name" name="name" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" parsley-type="email">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="biography">Biography</label>
                                <textarea class="form-control" id="biography" name ="biography" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" name="phone_number" type="text" class="form-control" data-parsley-pattern="^(0|\+84)(\d{9}|\d{10})$">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="address" name="address" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <select class="form-control select2" name = "gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input id="date_of_birth" name="date_of_birth" type="date" class="form-control">
                            </div>
                            
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Product Image</label> <br/>
                                <img src="assets/images/products/1.jpg" alt="product img" class="img-fluid" style="max-width: 200px;" />
                                <br/>
                                <input type="file" name = "upload_image" class="btn btn-purple m-t-10 waves-effect waves-light " required>
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






