@extends('layouts.app')

@section('content')
@if($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Update Employee</div>

                <div class="card-body">
                    <form method="POST" action="/employees/{{ $employee->id }}/update" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="first_name">First name (required)</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name',$employee->first_name) }}">
                            @if($errors->has('first_name'))
                            <span class="text-danger">{{ $errors->first('first_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last name (required)</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name',$employee->last_name) }}">
                            @if($errors->has('last_name'))
                            <span class="text-danger">{{ $errors->first('last_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select class="form-control" id="company_id" name="company_id" >
                                <!-- Populate options dynamically from the companies table -->
                                @foreach($companies as $com)
                                <option value="{{ $com->id }}">{{ $com->name }}</option> <!-- Use $com->name -->
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email',$employee->email) }}">
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone',$employee->phone) }}">
                            @if($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="profile_picture">Profile Picture (minimum size: 100x100)</label>
                            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                            @if($errors->has('profile_picture'))
                            <span class="text-danger">{{ $errors->first('profile_picture')}}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection