
<?php include_once '../model/db_config.php'; ?>
<?php
    
    if(isset($_POST['id'])){
        $del_id =$_POST['id'];
        $del_id = trim($del_id);
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $decryption_iv = '1234567891011121';
        $decryption_key = "1234";
        $del_id=openssl_decrypt ($del_id, $ciphering, 
        $decryption_key, $options, $decryption_iv);
        $sql = "DELETE FROM category_types WHERE cat_type_id='$del_id'";
        $sql = mysqli_query($link,$sql);
        
    }
?>