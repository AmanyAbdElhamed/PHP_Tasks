<?php

function clean($input){
   $input=trim($input);
   $input=strip_tags($input);
   $input=stripslashes($input);
   return $input;
}
function validaitName($name){
    if(empty($name)){
        $nameError='Name is required';
        echo $nameError.'<br>';
      }
      else{
          
          if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
          $nameError='Name is must letters ';
          echo $nameError.'<br>';
          }
      }
}
function validaitEmail($email){
    if(empty($email)){
        $emailError='Email is required';
        echo $emailError.'<br>';
    }
    else{
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $emailError='Invalid Email';
        echo $emailError.'<br>';
        }
        
    }
}
function validaitPassword($pass){
    if(empty($pass)){
        $passError='Password is required';
        echo $passError.'<br>';
    }
    else{
        if(strlen($pass)<6){
        $passError='Password minumim length is 6 ';
        echo $passError.'<br>';
        }
    }
}
function validaitGender($gender){

    if (isset($gender) && $gender=="female"){
        echo "Gender checked"."<br>";
    } 
    elseif (isset($gender) && $gender=="male"){
        echo "Gender checked"."<br>";
    } 
    else{
        echo 'gender is required'."<br>";
    }
   
}
function validaitAddress($address){
    if (empty($address)) {
        $addressError='Adress is require';
        echo $addressError.'<br>';
     }
     else{
        if(strlen($address)!=10){
        $addressError='Adress length must be 10 chars';
        echo $addressError.'<br>';
        }
    }

}
function validaitUrl($url){
    if(empty($url)){
        $urlError='URL is required';
        echo $urlError.'<br>';
    }
    else{
        if (!filter_var($url,FILTER_VALIDATE_URL)) {
        $urlError='Invalid URL';
        echo $urlError.'<br>';
        }
        elseif (!str_contains($url,'linkedin')) {
            $urlError='This is not url of linkedin';
            echo $urlError.'<br>';  
        }
    }
}
function uploadFile(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(!empty($_FILES['CvFile']['type'])){

            $fileName=$_FILES['CvFile']['name'];
            $fileTemName=$_FILES['CvFile']['tmp_name'];
            $fileType =$_FILES['CvFile']['type'];
            $fileSize=$_FILES['CvFile']['size'];

            $allowedExtention='pdf';
            $fileArray=explode('/',$fileType);
            $fileExtention=end($fileArray);
            if($fileExtention==$allowedExtention){
                
                $newFileName=time().rand().'.'.$fileExtention;
                $disPath='uploads/'. $newFileName;
                if(move_uploaded_file($fileTemName,$disPath)){

                    echo 'File Uploaded succssefly';
                }
                else{
                    echo 'Error try again';
                }
            }
            else{
                echo 'Invalid Extention ... ';
            }
 
        } 
        else{
            echo 'CV File Required ';
        }
     }
}

if($_SERVER['REQUEST_METHOD']=="POST"){
   
    $name=clean($_POST['name']);
    $email=clean($_POST['email']);
    $pass=clean($_POST['password']);
    $address=clean($_POST['Address']);
    $url=clean($_POST['linkedinUrl']); 
    $gender=$_POST['gender'];
    

    validaitName($name);
    validaitEmail($email);
    validaitPassword($pass);
    validaitGender($gender);
    validaitAddress($address);
    validaitUrl($url); 
    uploadFile(); 
   
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
<h2>Register</h2>
<!-- task3.php -->

<form action="<?php echo $_SERVER['PHP_SELF']?>" method='post' enctype="multipart/form-data">

    <div class="form-group">
    <label for="name"><b>Name</b></label>
    <input type="text" class="form-control" placeholder="Enter Name" name="name"  >
    </div>

    <div class="form-group">
    <label for="email"><b>Email</b></label>
    <input  class="form-control" placeholder="Enter Email" name="email"  >
    </div>

    <div class="form-group">
    <label for="psw"><b>Password</b></label>
    <input type="password" class="form-control" placeholder="Enter Password" name="password" >
    </div>
     
    <div class="form-group">
    <label for="gender"><b> Gender  </b></label> <br>
    <label for="gender">Female</label>    
    <input type="radio"  name="gender" value="female">
    <label for="gender">Male</label> 
    <input type="radio"  name="gender" value="male">
    </div>

    <div class="form-group">
    <label for="Address"><b>Address</b></label>
    <input type="text" class="form-control" placeholder="Enter Address" name="Address"  >
    </div>

    <div class="form-group">
    <label for="linkedinUrl"><b>linkedin Url</b></label>
    <input type="url" class="form-control" placeholder="Enter linkedin Url" name="linkedinUrl"  >
    </div>
 
    <div class="form-group">
    <label for="CvFile"><b>Upload CV</b></label>
    <input type="file" class="form-control" placeholder="Enter file" name="CvFile"  >
    </div>
    
    <button type="submit" class="btn btn-primary">Register</button>
    
</form>
</div>  
</body>
</html>