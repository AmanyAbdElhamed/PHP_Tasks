<?php 
class Validator{
    public function Clean($input){
        return  stripslashes(strip_tags(trim($input)));
    }
    public function Validate($input, $flag, $length = 6){
    
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
    public function Upload($input){
    
    
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
    
    
    
    

}
?>