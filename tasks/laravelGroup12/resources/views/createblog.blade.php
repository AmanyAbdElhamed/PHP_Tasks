<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
<h1>Artical</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="<?php echo url('blog/Access');?>" method='post' enctype="multipart/form-data" >

    <div class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <label for="title"><b>Title</b></label>
    <input type="text" class="form-control" placeholder="Enter title" name="title"  value="<?php echo old('title');?>" >
    </div>

    <div class="form-group">
    <label for="content"><b>Content</b></label>

    <textarea placeholder="Enter content" class="form-control" name="content"  > <?php echo old('content');?></textarea>
    </div>
   <div class="form-group">

    <label for="image"><b>Upload Image</b></label>
    <input type="file" class="form-control"  name="image" value="<?php echo old('image');?>"  >
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>

</form>
</div>

</body>
</html>
