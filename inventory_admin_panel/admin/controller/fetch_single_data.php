<?php include_once '../model/db_config.php';?>

<?php

    if(isset($_POST["id"]))
    {
        $edit_id = $_POST["id"];
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $decryption_iv = '1234567891011121';
        $decryption_key = "1234";
        $id=openssl_decrypt ($edit_id, $ciphering, 
        $decryption_key, $options, $decryption_iv);
        $sql = "SELECT * FROM sub_categories WHERE sub_cat_id = '".$id."'";
        $execute = mysqli_query($link,$sql);
        while($row=$execute->fetch_assoc())
        {
            $data[]=$row;
        }
        echo json_encode($data);
    }
?>