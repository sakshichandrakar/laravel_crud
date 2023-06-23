@extends('master')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
    {{ $message }}
</div>

@endif

<div class="card">
    <div class="card-header">
        <div class="row text-center">
            <div class="col col-md-12"><b> You Are Logged In! {{ Auth::user()->name }}</b>
                <span class="float-end">
                    <form method="POST" action="/logout">
                    @csrf
                    <button type="submit">Logout</button>
                    </form>
                </span>
            </div>
            <div class="col col-md-12">
                <h6>Manager Name Is
                    @foreach($data as $row)
                    {{ $row->emp_role }}
                    @endforeach
                </h6>

            </div>
        </div>
    </div>
    <div class="card-body">

        {!! $data->links() !!}
    </div>
</div>

@endsection