<?php
    include_once '../model/db_config.php';
    // $page = $_POST["page"]; 
    $record_per_page = 10;  
    $page = '';  
    $output = '';  
    if(isset($_POST["page"]))  
    {  
        $page = $_POST["page"];  
    }  
    else  
    {  
        $page = 1;  
    }
   
    $record_per_page = 10;
    $start_from = ($page - 1)*$record_per_page; 
    $sql = "SELECT  * FROM sub_categories ORDER BY sub_cat_id DESC LIMIT $start_from, $record_per_page";
    $execute = mysqli_query($link,$sql);
    $output .= "  
      <table class='table table-striped table-bordered table-sm'>  
           <tr>  
                <th width='50%'>Category Type Name</th>  
                <th width='50%'>Category Type Code</th>
                <th width='50%'>Edit</th>
                <th width='50%'>Delete</th>   
           </tr>  
    ";  
    if($execute->num_rows>0){
        while($row=$execute->fetch_assoc()){
            $id = $row['sub_cat_id'];
            $id = (string)$id;
            //echo ($id);  
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            
            $encryption_iv = '1234567891011121';
         
            $encryption_key = "1234";
           
            $encryption = openssl_encrypt($id, $ciphering,
            $encryption_key, $options, $encryption_iv);
            //echo ($encryption);
            $decryption_iv = '1234567891011121';
         
            $decryption_key = "1234";
          
            $decryption=openssl_decrypt ($encryption, $ciphering, 
            $decryption_key, $options, $decryption_iv);
            #echo ($decryption);
            $output.= '<tr>
                 <td class = "edit_td">'.$row['sub_cat_name'].'</td>
                 <td class = "edit_td">'.$row['sub_cat_code'].'</td>
                 <td> <a href ="#" id ="'.$encryption.'" class="btn btn-primary editBtn" role="button">'.'Edit'.'</a></td>
                 <td> <a class="btn btn-primary deleteBtn " id ="'.$encryption.'" href="#">'.'Delete'.' </a> </td>
             </tr>';
            
        }
    
    }
    $output .= '</table><br /><div align="center">';
    $page_query = "SELECT * FROM sub_categories ORDER BY sub_cat_id DESC";  
    $page_result = mysqli_query($link, $page_query);  
    $total_records = mysqli_num_rows($page_result);  
    $total_pages = ceil($total_records/$record_per_page);  
    for($i=1; $i<=$total_pages; $i++)  
    {  
        $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
    }  
    $output .= '</div><br /><br />'; 
    echo $output;
?>