<?php
$search = $_POST["search"];
require './dbcon.php';
$results = "select * from pet_meet ";
$query = mysqli_query($conn, $results);
$columns = mysqli_num_rows($query);
if(isset($_POST['search'])) {
$results = "SELECT type,breed,pet_name,pet_photo,sex,email,about_pet from pet_meet WHERE type LIKE '%".$search."%' or breed LIKE '%".$search."%' or pet_name LIKE '%".$search."%' or sex LIKE '%".$search."%'";
}
else {
    $results = "SELECT type,breed,pet_name,sex,email,about_pet from pet_meet";
}
$query_fetch = mysqli_query($conn, $results);
if(mysqli_num_rows($query_fetch)>0)
{    
while ($rows = mysqli_fetch_array($query_fetch))
{
 echo "<div class='left friend-box'>";
        echo "<div class='post-in-c'>";
        echo "<div class='fr-left'>";
        echo "<div class='fri-image'>";
        echo "<a>";
        if($rows['pet_photo'] == "")
{
    echo "<img class='photo' src='images/fr-pro-big-img.jpg'>";
}
else
{
  echo "<img class='photo'  alt='' src='".$rows['pet_photo']."'>";  
}
        echo $rows['pet_name'];
        echo "</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='fr-right'>";
        echo "<p class='ttl-lks'>";
		echo "<div class='fri-name'>";
        echo "<a>";
        echo $rows['pet_name'];
        echo "</a>";
        echo "</div>";
        
        echo "<div class='usr-cnct-l'>";
        echo "<p class='pst-text'>" . substr($rows['about_pet'], 0, 80) . "</p>";
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
<?php
$adopt = $_POST['adopt'];
$id = $_POST['id'];
print_r($adopt);
print_r($id);
if(isset($adopt) && $adopt=='true')
{
$adopt = 1;
require './dbcon.php';
$results = "update pet_meet set status = '$adopt' where id = '$id'";
mysqli_query($conn,$results);

}
elseif(isset($adopt) && $adopt=='false')
{
$adopt = 0;
require './dbcon.php';
$results = "update pet_meet set status = '$adopt' where id = '$id'";
mysqli_query($conn,$results);

}
?>