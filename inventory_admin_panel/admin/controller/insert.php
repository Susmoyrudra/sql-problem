<?php include_once '../model/db_config.php'; ?> 


<?php
    $error1=$error2=$error3=$success="";
    $sub_cat_name=$sub_cat_code="";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $sub_cat_name =trim($_POST['name']);
        $sub_cat_code =trim($_POST['code']);
        // echo $sub_cat_name;
        if(empty($sub_cat_name) || empty($sub_cat_code)){
            if(empty($sub_cat_name) && empty($sub_cat_code)){
                echo "sadsad";
                $error1 = "Please fill up both forms";
            }
            else if (empty($sub_cat_name)){

                $error2 = "Please Insert Category Type Name";
                echo $error2;
            }
            else if (empty($sub_cat_code)){
                $error3 = "Please Insert Category Type Code";
            }

            
        }
        else{
            // echo "1";

            $existed_sql_name="SELECT * FROM sub_categories WHERE sub_cat_name='$sub_cat_name' ";
            $existed_sql_code="SELECT * FROM sub_categories WHERE sub_cat_code='$sub_cat_code' ";
            
            $existed_sql_name= mysqli_query($link,$existed_sql_name);
            $existed_sql_code= mysqli_query($link,$existed_sql_code);
            if($existed_sql_name->num_rows>0 && $existed_sql_code->num_rows>0){
                echo (1);
            }
            elese{
                $sql = "INSERT INTO sub_categories (sub_cat_name, sub_cat_code) VALUES (?, ?)";
            
                $sql_statment = mysqli_prepare($link,$sql);
                echo mysqli_error($link);
                    if ($sql_statment){
                        // print_r('ssssss');
                        mysqli_stmt_bind_param($sql_statment, "ss", $var1,$var2);
                        $var1=$sub_cat_name;
                        $var2 = $sub_cat_code;
                        echo $var1;
                        $execute = mysqli_stmt_execute($sql_statment);
                        // print_r($execute);
                        if($execute){
                            
                            $success = "Successfully Inserted";
                            echo $success;
                            //header("location: index.php");
        
                        }
                }
      
                else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        }
        
    }
        
?>
