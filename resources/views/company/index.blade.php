@extends('layouts.app') <!-- Use your layout file if different -->

@section('content')
<div class="container mt-3">
    <div class="text-right">
        <a href="company/create" class="btn btn-dark mb-2">Add new Company</a>
    </div>
    <h2>Company List</h2>
    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($company as $com)
            <tr>
                <td>{{ $loop->index+1}}</td>
                <td>{{$com->name}}</td>
                <td>{{$com->email}}</td>
                <td>
                <img src="{{ asset('storage/' . $com->logo) }}" class="rounded-circle" width="100" height="100">
                </td>
                <td>{{$com->website}}</td>
                <td>
                    <a href="company/{{$com->id}}/edit" class="btn btn-primary btn-samll" >Edit</a>

                    <form method="POST" class="d-inline" action="company/{{$com->id}}/delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection