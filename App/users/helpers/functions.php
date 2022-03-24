<?php

function Clean($input)
{

    return  stripslashes(strip_tags(trim($input)));
}





function Validate($input, $flag, $length = 6)
{

    $status = true;

    switch ($flag) {

        case "required":
            # code...
            if (empty($input)) {

                $status = false;
            }
            break;


        case "email":
            # code...
            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {

                $status = false;
            }
            break;

        case "number":
            # code...
            if (!filter_var($input, FILTER_VALIDATE_INT)) {

                $status = false;
            }
            break;


        case "length":
            # Code ... 
            if (strlen($input) < $length) {
                $status = false;
            }
            break;



        case "image":
            # code 

            $imgType    = $input['image']['type'];
            # Allowed Extensions 
            $allowedExtensions = ['jpg', 'png', 'jpeg'];

            $imgArray = explode('/', $imgType);

            # Image Extension ...... 
            $imageExtension =  strtolower(end($imgArray));


            if (!in_array($imageExtension, $allowedExtensions)) {
                $status = false;
            }

            break;


        case "date":
            # code .... 


            $dateData = explode('-', $input);

            if (!checkdate($dateData[1], $dateData[2], $dateData[0])) {
                $status = false;
            }
            break;

       case "FutureDate":
        # code .... 
          $date = strtotime($input); 
           if($date <  time() ){
               $status = false; 
           } 
           break; 

      case "string" : 
      # code .... 
        
      if (!preg_match("/^[a-zA-Z-' ]*$/",$input)) {
       $status = false;
      }

       break; 


       case "phone" : 
    
        if (!preg_match("/^01[0-2,5][0-9]{8}$/",$input)) {
         $status = false;
        }
  
         break; 




    }

    return $status;
}






function PrintMessages($message = null)
{

    if (isset($_SESSION['Message'])) {

        foreach ($_SESSION['Message'] as $key => $value) {
            # code...

            echo '*' . $key . ' : ' . $value . '<br>';
        }

        unset($_SESSION['Message']);
    }
    //  else {
    //     echo '   <li class="breadcrumb-item active">' . $message . '</li>';
    // }
}


function doQuery($sql)
{
    $result = mysqli_query($GLOBALS['con'], $sql);
    return $result;
}


function DBRemove($table, $id)
{

    $sql = "delete from $table where id = $id";
    $op  = mysqli_query($GLOBALS['con'], $sql);

    if ($op) {
        $status = true;
    } else {
        $status = false;
    }




    return $status;
}



function Upload($input)
{


    # Upload Image ..... 

    $image = null;

    $imgType    = $input['image']['type'];

    $imgArray = explode('/', $imgType);

    # Image Extension ...... 
    $imageExtension =  strtolower(end($imgArray));



    $FinalName = time() . rand() . '.' . $imageExtension;

    $disPath = 'uploads/' . $FinalName;

    $imgTemName = $_FILES['image']['tmp_name'];


    if (move_uploaded_file($imgTemName, $disPath)) {

        $image = $FinalName;
    }

    return $image;
}






# Url ... 

function Url($input){
      
    
    return "http://".$_SERVER['HTTP_HOST']."/group12/App/Admin/".$input; 

}

function addToCart($product_id,$customer_id){

    $sql="select id from cart where customer_id=$customer_id";
    $op=doQuery($sql);
    $cart_data=mysqli_fetch_assoc($op);
    $cartID= $cart_data["id"];
    $sql ="inser into cart_items (cart_id,product_id)values($cartID,$product_id)";
    $op=doQuery($sql);
    if($op){
        $message = ["Message" => "Raw Inserted"];
    }else{
        $message = ["Message" => "Error Try Again"]; 
    }

    $_SESSION['Message'] = $message; 

}
function makeOrder(){
    $ID=$_SESSION['user']['id'];
    $sql="select id from cart where customer_id=$ID";
    $op=doQuery($sql);
    $cart_id=mysqli_fetch_assoc($op);
    #########################################
    
    $totalPrice=$_SESSION['Total'];
    //unset($_SESSION['Total']);
    $number_orders=time();
    $shippingDate=strtotime(date("Y-m-d"));
   $sql= "insert into orders (number_orders,totalprice,customer_id,shippingDate) 
   values ($number_orders,'$totalPrice',$ID,'$shippingDate')";
    $op  = doQuery($sql);
    
    if($op){
        $message = ["Message" => "Raw Inserted"];
        $last_Inserted_id=mysqli_insert_id($GLOBALS['con']);
        
        // $s = "delete from cart_items where cart_id = $cart_id";
        // $o  = mysqli_query($GLOBALS['con'], $s);
    
       // $status=DBRemove('cart_items',$cart_id);
        // if(!$status){
        //     DBRemove('orders',$last_Inserted_id); 
        // }
    }else{
        $message = ["Message" => "Error Try Again"];
        
    }

    $_SESSION['Message'] = $message; 
    ############################################
    
    return $last_Inserted_id;
    
}
function makeDetailOrder(){
    
    $orderID=makeOrder();
    ###############################################################
    for ($i=0; $i < count($_SESSION['orderDetails']) ; $i++) { 

    $product_id= $_SESSION['orderDetails']['productID'][$i];
    $quantity= $_SESSION['orderDetails']['Quantity'][$i];
    $unitPrice= $_SESSION['orderDetails']['Price'][$i];
    $sql = "insert into order_details (order_id,product_id,quantity,unitPrice)
     values ($orderID,$product_id,$quantity,$unitPrice)"; 
    $op  = doQuery($sql);
       if($op){
           $message = ["Message" => "Raw Inserted"];
       }else{
           $message = ["Message" => "Error Try Again"]; 
       }

       $_SESSION['Message'] = $message; 
    }
    return $orderID;
}