@extends('master')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
    {{ $message }}
</div>

@endif

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>{{ Auth::user()->name }}</b></div>
            <div class="col col-md-6">

                <a href="{{ route('employee.create') }}" class="btn float-end btn-success btn-sm ">Add</a>
                <form method="POST" action="/logout1">
                    @csrf
                    <span> <button type="submit">Logout</button></span>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Basic Salary</th>
                <th>Employee Role</th>
                <th>Manager Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            @if(count($data) > 0)

            @foreach($data as $row)
            <?php if($row->emp_role_type == 1)					  
						$emp_role_type = "Manager";
					  else
						$emp_role_type = "Developer";
						?>

            <tr>
                <td><img src="{{ asset('images/' . $row->emp_profile) }}" width="75" /></td>
                <td>{{ $row->emp_name }}</td>
                <td>{{ $row->emp_email }}</td>
                <td>{{ $row->emp_mob }}</td>
                <td>{{ $row->emp_gender }}</td>
                <td>{{ $row->emp_basic_pay }}</td>
                <td>{{ $emp_role_type}}</td>
                <td> @if($row->emp_role > 0){{ $row->emp_role }}@endif</td>
                <td>{{ $row->emp_address }}</td>

                <td>
                    <form method="post" action="{{ route('employee.destroy', $row->id) }}">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('employee.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                    </form>

                </td>
            </tr>

            @endforeach

            @else
            <tr>
                <td colspan="5" class="text-center">No Data Found</td>
            </tr>
            @endif
        </table>
        {!! $data->links() !!}
    </div>
</div>

@endsection