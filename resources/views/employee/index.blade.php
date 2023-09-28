@extends('layouts.app') <!-- Use your layout file if different -->

@section('content')
<div class="container mt-3">
    <div class="text-right">
        <a href="employees/create" class="btn btn-dark mb-2">Add new Employee</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee List</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="m-3">
                                <th>S.No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Profile Picture</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $emp)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $emp->first_name }}</td>
                                <td>{{ $emp->last_name }}</td>
                                <td>{{ $emp->company->name }}</td> <!-- Access company name -->
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->phone }}</td>
                                <td><img src=" employees/{{ $emp->profile_picture}}/getProfilePicture" class="rounded-circle" width="50" height="50"></td>
                                <td>
                                    <a href="employees/{{ $emp->id }}/edit" class="btn btn-primary btn-small">Edit</a>

                                    <form method="POST" class="d-inline" action="employees/{{ $emp->id }}/delete">
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
            </div>
        </div>
    </div>
</div>
@endsection
