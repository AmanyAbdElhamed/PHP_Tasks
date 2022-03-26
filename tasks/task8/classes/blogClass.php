<?php

require 'dbConnection.php';
require 'validator.php';

class Artical
{
    private $title;
    private $content;
    private $image;

    public function validateInput($data)
    {
        $validate = new Validator();

        $this->title     = $validate->Clean($data['title']);
        $this->content   = $validate->Clean($data['content']);

        $errors = [];


        if (!$validate->Validate($this->title, "required")) {
            $errors['Title'] = "Required Field ";
        } elseif (!$validate->Validate($this->title, "string")) {
            $errors['Title'] = "Title must be chars ";
        }

        if (!$validate->Validate($this->content, "required")) {
            $errors['Content'] = "Required Field ";
        } elseif (!$validate->Validate($this->content, "length", 50)) {
            $errors['Content'] = "Content Length Must Be >= 50 Chars";
        }

        if ($validate->Validate($_FILES['image']['name'], 'required')) {
            if (!$validate->validate($_FILES, "image")) {
                $errors['Image'] = "Invalid Image Format";
            }
        }
        return $errors;
    }
    public function Insert($data)
    {

        $errors = $this->validateInput($data);

        if (count($errors) > 0) {

            $Message = $errors;
        } else {

            $db = new DB();
            $validate = new Validator();

            $this->image = $validate->Upload($_FILES);

            $sql = "insert into articals (title,content,imagePath) values('$this->title','$this->content','$this->image')";

            $op = $db->doQuery($sql);

            if ($op) {
                $Message = ["Message" => "Raw Inserted"];
            } else {
                $Message = ["Message" => "Error Try Again"];
            }
        }
        return $Message;
    }
    public function Edit($data, $id, $res)
    {

        $errors = $this->validateInput($data);

        if (count($errors) > 0) {

            $Message = $errors;
        } else {

            $validate = new Validator();

            if ($validate->Validate($_FILES['image']['name'], 'required')) {


                $this->image = $validate->Upload($_FILES);

                unlink('uploads/' . $res['imagePath']);
            } else {
                $this->image = $res['imagePath'];
            }

            $db = new DB();

            $sql = "update articals set title='$this->title',content='$this->content',imagePath='$this->image' where id=$id";
            $op  = $db->doQuery($sql);


            if ($op) {
                $Message = ["Message" => "Raw Updated"];

                header("Location: index.php");
                exit();
            } else {
                $Message = ["Message" => "Error Try Again"];
            }
        }
        return $Message;
    }
}
