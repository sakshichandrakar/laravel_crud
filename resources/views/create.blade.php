@extends('master')

@section('content')

@if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif
<?php //print_r($emp_manager); die;?>

<div class="card">
	<div class="card-header">Add Employee</div>
	<div class="card-body">
		<form method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Employee Name</label>
				<div class="col-sm-10">
					<input type="text" name="emp_name" onkeypress="alphaOnly(event)" class="form-control" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Employee Email</label>
				<div class="col-sm-10">
					<input type="text" name="emp_email" class="form-control" />
				</div>
			</div>
            <div class="row mb-3">
				<label class="col-sm-2 col-label-form">Employee Mobile No</label>
				<div class="col-sm-10">
					<input type="text" name="emp_mob" class="form-control " onkeypress="numberonly(event)" maxlength="10"/>
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Employee Gender</label>
				<div class="col-sm-10">
					<select name="emp_gender" class="form-control">
                        <option value="">Select Gender</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Employee Profile</label>
				<div class="col-sm-10">
					<input type="file" name="emp_profile" />
				</div>
			</div>
            <div class="row mb-4">
				<label class="col-sm-2 col-label-form">Basic Salary</label>
				<div class="col-sm-10">
                <input type="text" name="emp_basic_pay" class="form-control " onkeypress="numberonly(event)"/>
				</div>
			</div>
            <div class="row mb-4">
				<label class="col-sm-2 col-label-form">Employee Role</label>
				<div class="col-sm-10">
					<select name="emp_role_type" class="form-control" onchange="assignmanager(this.value)">
                        <option value="">Select Employee Role</option>
						<option value="1">Manager</option>
						<option value="0">Developer</option>
					</select>
				</div>
			</div>
			<div class="row mb-4" id="emp_role_type" style="display:none">
				<label class="col-sm-2 col-label-form">Assign Manager</label>
				<div class="col-sm-10">
					<select name="emp_role" class="form-control">
                        <option value="">Select Manager</option>
						@foreach($emp_manager as $emp)
						<option value="{{ $emp }}">{{ $emp }}</option>
						@endforeach
					</select>
				</div>
			</div>
            <div class="row mb-4">
				<label class="col-sm-2 col-label-form">Address</label>
				<div class="col-sm-10">
                <input type="text" name="emp_address" class="form-control" />
				</div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Add" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')
<script>
	function assignmanager(id)
	{
		if(id ==0)
		{
			document.getElementById("emp_role_type").style.display = "";
		}else{
			document.getElementById("emp_role_type").style.display = "none";

		}
	}
</script>
<script>
	function numberonly(evt) 
	{
		var keycode = event.which;
		if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
		   event.preventDefault();
		}
	}
	function alphaOnly(evt) 
	{
		var keyCode = (evt.which) ? evt.which : evt.keyCode
		if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
		event.preventDefault();
		else
		return true;
	}
	</script>

