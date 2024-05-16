@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý tác giả";
    $sub_page_title = "Sửa thông tin tác giả";

    $genders = [
        'male' => "Male",
        'female' => "Female",
    ]
@endphp

@section('main')

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <form action = "{{route('admin.author.handleEdit', $foundAuthor -> id)}}" method = "POST" enctype = "multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Author ID</label>
                                <input id="name" disabled value = "{{$foundAuthor -> id}}" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Author Name</label>
                                <input id="name" name="name" value = "{{$foundAuthor -> name}}" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" value = "{{$foundAuthor -> email}}" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="biography">Biography</label>
                                <textarea class="form-control" id="biography" name ="biography" rows="5">{{$foundAuthor -> biography}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" name="phone_number" value = "{{$foundAuthor -> phone_number}}" type="text" class="form-control" data-parsley-pattern="^(0|\+84)(\d{9}|\d{10})$">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="address" name="address" value = "{{$foundAuthor -> address}}"  type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <select class="form-control select2" name = "gender" required>
                                    @foreach($genders as $key => $gender)
                                        @if($key == $foundAuthor -> gender)
                                            <option selected  value="{{$key}}">{{$gender}}</option>
                                        @else
                                            <option value="{{$key}}">{{$gender}}</option>
                                        @endif
                                    @endforeach
                                        
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input id="date_of_birth" name="date_of_birth" value = "{{$foundAuthor -> date_of_birth}}" type="date" class="form-control">
                            </div>
                            
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Product Image</label> <br/>
                                <img src="{{$foundAuthor -> image}}" alt="product img" class="img-fluid" style="max-width: 200px;" />
                                <br/>
                                <input type="file" name = "upload_image" class="btn btn-purple m-t-10 waves-effect waves-light ">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success waves-effect waves-light">Save Changes</button>
                    <button type="submit" class="btn btn-secondary waves-effect">
                        <a href="">Cancel</a>
                    </button>
                    @method('PUT')
                    @csrf
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
    

@section('scripts')
@endsection





