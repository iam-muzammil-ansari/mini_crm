@extends('layouts.app')  <!-- Use your layout file if different -->

@section('content')

@if($message = Session::get('success'))
    <div class="alert alert-success alert-block" >
        <strong>{{ $message }}</strong>
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header"><h3 class="text-muted">Edit Company ({{$company->name}})</h3></div>

                <div class="card-body">
                    <form method="POST" id="my-form" action="/company/{{ $company->id }}/update" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name (required)</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$company->name) }}">
                            @if($errors->has('name'))
                            <span class="text-danger" >{{ $errors->first('name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email',$company->email) }}">
                            @if($errors->has('email'))
                            <span class="text-danger" >{{ $errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo (minimum size: 100x100)</label>
                            <input type="file" class="form-control-file" id="logo" name="logo">
                            @if($errors->has('logo'))
                            <span class="text-danger" >{{ $errors->first('logo')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="{{ old('website',$company->website) }}">
                            @if($errors->has('logo'))
                            <span class="text-danger" >{{ $errors->first('website')}}</span>
                            @endif
                        </div>

                        <button type="submit" id="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
