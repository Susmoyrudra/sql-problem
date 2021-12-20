<?php include_once '../model/db_config.php'; ?> 

<?php
$edit_id = $_POST['id'];
// $show_sql = "SELECT * FROM sub_categories WHERE sub_cat_id = '$edit_id'";
// $show_sql = mysqli_query($link,$show_sql);
// $show_sql = mysqli_fetch_array($show_sql);
// echo (mysqli_error($link));
$error1=$error2=$error3=$success="";
$sub_cat_name=$sub_cat_code="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    // $sub_cat_name =trim($_POST['sub_cat_name']);
    // $sub_cat_code =trim($_POST['sub_cat_code']);
     $sub_cat_name =trim($_POST['name']);
     $sub_cat_code =trim($_POST['code']);
    echo $sub_cat_name;
    if(empty($sub_cat_name) || empty($sub_cat_code)){
        if(empty($sub_cat_name) && empty($sub_cat_code)){
            // echo "safsd"
            $error1 = "Please fill up both forms";
        }
        else if (empty($sub_cat_name)){

            $error2 = "Please Insert Category Type Name";
            // echo $error2;
        }
        else if (empty($sub_cat_code)){
            $error3 = "Please Insert Category Type Code";
        }
    }
        else{
            // echo "1";
            $sql = "UPDATE sub_categories SET sub_cat_name='$sub_cat_name', sub_type_code='$sub_cat_code' WHERE sub_cat_id='$edit_id'";

        
            $sql= mysqli_query($link,$sql);
            if($sql_statment){
        
            
            
                $success = "Successfully Edited";
        
                // header("location: index.php");
            }
            
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
}       
    

    
?>



