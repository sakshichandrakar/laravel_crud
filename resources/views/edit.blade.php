@extends('master')

@section('content')

<div class="card">
	<div class="card-header">Edit Student</div>
	<div class="card-body">

		<form method="post" action="{{ route('employee.update', $emp->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Employee Name</label>
				<div class="col-sm-10">
					<input type="text" name="emp_name" onkeypress="alphaOnly(event)" class="form-control" value="{{ $emp->emp_name }}" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Employee Email</label>
				<div class="col-sm-10">
					<input type="text" name="emp_email" class="form-control" value="{{ $emp->emp_email }}" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Employee Mobile</label>
				<div class="col-sm-10">
					<input type="text" name="emp_mob" maxlength="10" onkeypress="numberonly(event)" class="form-control" value="{{ $emp->emp_mob }}" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Employee Gender</label>
				<div class="col-sm-10">
					<select name="emp_gender" class="form-control">
					<option value="">select Gender</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Student Image</label>
				<div class="col-sm-10">
					<input type="file" name="emp_profile" />
					<br />
					<img src="{{ asset('images/' . $emp->emp_profile) }}" width="100" class="img-thumbnail" />
					<input type="hidden" name="hidden_student_image" value="{{ $emp->emp_profile }}" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Basic Salary</label>
				<div class="col-sm-10">
                <input type="text" onkeypress="numberonly(event)" value="{{ $emp->emp_basic_pay }}" name="emp_basic_pay" class="form-control" />
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
					<script>

					</script>
				</div>
			</div>
	
			<div class="row mb-4" id="emp_role_type" <?php if($emp->emp_role_type ==1) { ?>style="display:none" <?php } ?>>
				<label class="col-sm-2 col-label-form">Assign Manager</label>
				<div class="col-sm-10">
					<select name="emp_role" class="form-control">
                        <option value="">Select Manager</option>
						@foreach($emp_manager as $emp1)
						<option value="{{ $emp1 }}">{{ $emp1 }}</option>
						@endforeach
					</select>
				</div>
			</div>
            <div class="row mb-4">
				<label class="col-sm-2 col-label-form">Address</label>
				<div class="col-sm-10">
                <input type="text" value="{{ $emp->emp_address }}" name="emp_address" class="form-control" />
				</div>
			</div>
			<div class="text-center">
			<input type="hidden" name="userid" value="{{ $emp->userid }}" />
				<input type="hidden" name="hidden_id" value="{{ $emp->id }}" />
				<input type="submit" class="btn btn-primary" value="Edit" />
			</div>	
		</form>
	</div>
</div>
<script>
document.getElementsByName('emp_gender')[0].value = "{{ $emp->emp_gender }}";
document.getElementsByName('emp_role_type')[0].value = "{{ $emp->emp_role_type }}";
document.getElementsByName('emp_role')[0].value = "{{ $emp->emp_role }}";

</script>


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