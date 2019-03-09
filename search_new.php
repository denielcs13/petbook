<?php
require './dbcon.php';
if(isset($_POST['search'])){
    
 $search = $_POST['search'];

    $query = "SELECT powner_name,company_name,pet_name,pet_unique_id,business_uniqueid FROM `business`,`user_inf` WHERE powner_name like'%".$search."%' or pet_name like'%".$search."%' or company_name like'%".$search."%'limit 6";
    $display = mysqli_query($conn, $query);
    $response = array();
    while ($row = mysqli_fetch_array($display))
    {
     $response[] = array("value"=>$row['email'],"label"=>$row['powner_name'],"id"=>$row["pet_unique_id"],"owner"=>$row["pet_name"],"company"=>$row["company_name"],"company_id"=>$row["business_uniqueid"]);
     
    }
echo json_encode($response);
    
 
}
?>