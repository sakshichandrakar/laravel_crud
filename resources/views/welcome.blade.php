<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <div class="container mt-5">
        @if($errors->any())

        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach
            </ul>
        </div>

        @endif
        @if (session('failed'))
        <div class="alert alert-danger">
        {{ session('failed') }}
        </div>
        @endif
        
        <div class="container mt-5">

            <h1 class="text-primary mt-3 mb-4 text-center"><b>Login Screen</b></h1>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/login1" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-label-form">User Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="user_name" class="form-control" />
                            </div>
							<label class="col-sm-3 col-label-form"></label>

                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-label-form">Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" class="form-control" />
                            </div>
							<label class="col-sm-3 col-label-form"></label>

                        </div>
                        
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Login" />
                        </div>
                    </form>
                </div>
            </div>
</div>

</body>

</html>