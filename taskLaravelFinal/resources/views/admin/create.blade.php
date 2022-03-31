<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">

        <h1>Register Admins </h1>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
         <form action="{{url('Admin/store')}} " method="post">
                @csrf
             <div class="form-group">
                 <label for="exampleInputName">Name</label>
                 <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="name" value="{{ old('name')}}" placeholder="Enter Name">
             </div>


             <div class="form-group">
                 <label for="exampleInputEmail">Email </label>
                 <input type="text" class="form-control" id="exampleInputEmail1"
                  aria-describedby="emailHelp" name="email" value="{{ old('email')}}" placeholder="Enter email">
             </div>

             <div class="form-group">
                 <label for="exampleInputPassword"> Password</label>
                 <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
             </div>


             <button type="submit" class="btn btn-primary">Submit</button>
         </form>
     </div>


</body>
</html>
