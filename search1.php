<?php
require './dbcon.php';
if(isset($_POST['search'])){
    
 $search = $_POST['search'];

    $query = "SELECT powner_name,pet_name,email,pet_unique_id FROM user_inf WHERE powner_name like '%".$search."%' or email like '%".$search."%' or email like '%".$search."%' or pet_name like '%".$search."%' UNION ALL SELECT company_name,business_uniqueid,business_type,admin FROM business WHERE company_name like '%".$search."%'";
    $display = mysqli_query($conn, $query);
    $response = array();
    while ($row = mysqli_fetch_array($display))
    {
     $response[] = array("value"=>$row['email'],"label"=>$row['powner_name'],"id"=>$row["pet_unique_id"],"owner"=>$row["pet_name"],"company"=>$row['company_name']);
     
    }
echo json_encode($response);
    
 
}
?>