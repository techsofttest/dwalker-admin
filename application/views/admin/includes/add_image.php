<?php
//echo $_POST['upload'];
//$response= array('url'=>"http://localhost/gk4success/images/new_logo.png");
$_FILES['upload'];

$filename = rand().$_FILES["upload"]["name"]; 
$tempname = $_FILES["upload"]["tmp_name"];     
$folder = "uploads/".$filename; 
if (move_uploaded_file($tempname, $folder))  { 
            $msg = "http://localhost/finagro/application/views/admin/includes/".$folder; 
        }else{ 
            $msg = ""; 
      }  

$response= array('url'=> $msg);
echo json_encode($response);
?>