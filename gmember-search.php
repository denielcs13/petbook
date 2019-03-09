<?php 
if ((isset($_SESSION['pet_unique_id']))) {   
   $parent_id=$_SESSION['pet_unique_id'];
}
if ((isset($_SESSION['business_unique_id']))) {   
   $parent_id=$_SESSION['business_unique_id'];
}
if ((isset($_SESSION['ngo_unique_id']))) {   
   $parent_id=$_SESSION['ngo_unique_id'];
}
require 'dbcon.php'; 
?>
<?php
$search = $_POST["search"];
$gp_id=$_POST["grpid"];
require './dbcon.php';
//$results = "SELECT pet_name, about_data, pet_unique_id, profile_pic
//FROM user_inf
//UNION SELECT `company_name` , `description` , `business_uniqueid` , `profile_image`
//FROM `business`
//UNION SELECT `ngo_name` , `ngo_desc` , `ngo_unique_id` , `profile_image`
//FROM `ngo_resgitration` ";
$results="select * from groups";
$query = mysqli_query($conn, $results);
$columns = mysqli_num_rows($query);
if(isset($_POST['search'])) {
$results = "SELECT pet_name, about_data, pet_unique_id, profile_pic, group_user_id
FROM user_inf, group_users
WHERE user_inf.status = '1'
AND user_inf.pet_name LIKE '%".$search."%'
AND user_inf.pet_unique_id = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
UNION SELECT `company_name` , `description` , `business_uniqueid` , `profile_image` , group_user_id
FROM `business` , group_users
WHERE business.status = '1'
AND business.company_name LIKE '%".$search."%'
AND business.business_uniqueid = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
UNION SELECT `ngo_name` , `ngo_desc` , `ngo_unique_id` , `profile_image` , group_user_id
FROM `ngo_resgitration` , group_users
WHERE ngo_resgitration.status = '1'
AND ngo_resgitration.ngo_name LIKE '%".$search."%'
AND ngo_resgitration.ngo_unique_id = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
ORDER BY group_user_id DESC";
}
else {
    $results = "SELECT pet_name, about_data, pet_unique_id, profile_pic, group_user_id
FROM user_inf, group_users
WHERE user_inf.status = '1'
AND user_inf.pet_unique_id = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
UNION SELECT `company_name` , `description` , `business_uniqueid` , `profile_image` , group_user_id
FROM `business` , group_users
WHERE business.status = '1'
AND business.business_uniqueid = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
UNION SELECT `ngo_name` , `ngo_desc` , `ngo_unique_id` , `profile_image` , group_user_id
FROM `ngo_resgitration` , group_users
WHERE ngo_resgitration.status = '1'
AND ngo_resgitration.ngo_unique_id = group_users.user_id_fk
AND group_users.group_id_fk = '$gp_id'
AND group_users.status = '1'
ORDER BY group_user_id DESC";
}
$query_fetch = mysqli_query($conn, $results);
if(mysqli_num_rows($query_fetch)>0)
{    
while ($rows = mysqli_fetch_array($query_fetch))
        //$id=$rows['pet_unique_id'];
{
 echo "<div class='left friend-box'>";
        echo "<div class='post-in-c'>";
        echo "<div class='fr-left'>";
        echo "<div class='fri-image'>";
        echo "<a href='about3.php?id={$rows['pet_unique_id']} '>";
        if($rows['profile_pic'] == "")
{
    echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
}
else
{
  echo "<img class='photo'  alt='' src='".$rows['profile_pic']."'>";  
}
        //echo $rows['pet_name'];
        echo "</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='fr-right'>";
        echo "<p class='ttl-lks'>";
        echo "<a href='about3.php?id={$rows['pet_unique_id']} '>";
        echo $rows['pet_name'];
        echo "</a>";
        echo "<div class='fri-name'>";
        //echo "<div class='left friend-box'>";
        //echo "</div>";
        echo "<div class='usr-cnct-l'>";
        echo "<p class='pst-text'>" . substr($rows['about_data'], 0, 80) . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>"; 
        echo "</div>"; 
    
    
    
    
    
   //$group_data= $rows['pet_name'];
//   echo json_encode($group_data)."<br>";
}
}
else
{
echo "<div class='no-rc'>";
echo "<i class='fa fa-table' aria-hidden='true'></i>";

echo "No record found";
echo "</div>";
 //echo json_encode("No record found");   
}

?>
<link rel="stylesheet" href="css/packery-docs.css" media="screen" />
<script src="js/packery-docs.min.js"></script>

