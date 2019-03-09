<?php

require './dbcon.php';
if(isset($_POST['search'])){
   
 $search = $_POST['search'];

//    $query = "SELECT pet_name, powner_name, email, pet_unique_id FROM user_inf WHERE powner_name LIKE '%".$search."%' OR email LIKE '%".$search."%' OR email LIKE '%".$search."%' OR pet_name LIKE '%".$search."%' UNION ALL SELECT default_type, company_name, email, business_uniqueid FROM business WHERE company_name LIKE '%".$search."%' UNION SELECT group_type,group_name,user_id_fk,group_id FROM groups where group_name LIKE '%".$search."%' UNION SELECT ngo,ngo_name,website,ngo_unique_id FROM ngo_resgitration WHERE  ngo_name LIKE '%".$search."%' UNION SELECT page_type,page_name,user_id_fk,page_id FROM pages WHERE page_name LIKE '%".$search."%'";
    $query = "SELECT pet_name, powner_name, email, pet_unique_id, profile_pic FROM user_inf WHERE powner_name LIKE '%".$search."%' OR email LIKE '%".$search."%' OR email LIKE '%".$search."%' OR pet_name LIKE '%".$search."%' UNION ALL SELECT default_type, company_name, email, business_uniqueid, profile_image FROM business WHERE company_name LIKE '%".$search."%' UNION SELECT group_type,group_name,user_id_fk,group_id,gr_profile_pic FROM groups where group_name LIKE '%".$search."%' UNION SELECT ngo,ngo_name,website,ngo_unique_id,profile_image FROM ngo_resgitration WHERE  ngo_name LIKE '%".$search."%' UNION SELECT page_type,page_name,user_id_fk,page_id,pg_profile_pic FROM pages WHERE page_name LIKE '%".$search."%'";
    $display = mysqli_query($conn, $query);
    $response = array();
     if (mysqli_num_rows($display)== 0){
              $no_data= 'No Results';
              
              //$image='images/no-serch-icon.png' ;
              $image='images/no_search.png' ;


              $response[]=array("label"=>$no_data,"owner"=>$no_data,"image"=>$image);
            }
            else {
    while ($row = mysqli_fetch_array($display))
    {
        if($row["profile_pic"]==''){
    		$image='images/pet-icon.png';    		
    	}
    	else{
    		$image=$row['profile_pic'];
    	}
           
     $response[] = array("value"=>$row['email'],"label"=>$row['powner_name'],"id"=>$row["pet_unique_id"],"owner"=>$row["pet_name"],"image"=>$image);
        // print_r($response);    
     //$response[] = array("value"=>$row['email'],"label"=>$row['powner_name'],"id"=>$row["pet_unique_id"],"owner"=>$row["pet_name"]);
    }
    }

echo json_encode($response);

}

?>