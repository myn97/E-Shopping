
<?php
include("includes/db.php");
include("includes/functions.php");
include("includes/header.php");
$name=$_POST["name"];
$description=$_POST["description"];
$price=$_POST["price"];
//Protect against SQL Injection
$price=floatval($price);
if
(!get_magic_quotes_gpc())$name=mysql_escape_string($name);
if
(!get_magic_quotes_gpc())$description=mysql_escape_string($description);
//Protect against XSS
$name=strip_tags($name);
$description=strip_tags($description);
//Content validation
$errors=array();
if(empty($name))$errors[]="الاسم";
if(empty($description)) $errors[]="الوصف";
if($price<=0) $errors[]="السعر";
if($_FILES['picture']['error']>0) $errors[]="الصورة";
if($_FILES['picture']['error']==0 && strpos($_FILES['picture']['type'],"image/")===false)$errors[]="صيغة الملف";
echo "<center>";
if (count($errors)){
 echo " يرجاء التاكد من (" . implode(" , ",$errors) . ") <br /><a href='add.php'>اضغط هناء للعودة</a>";
}else{
 $path="images/".dechex(rand(1,1e6))."-".$_FILES['picture']['name'];
if(move_uploaded_file($_FILES['picture']['tmp_name'],$path)){
 $sql="INSERT INTO products(`name` ,`description`,`price` ,`picture`) VALUES ('$name', '$description', $price,'$path')";
 $query=mysql_query($sql);
 if (!mysql_errno()){
 echo "تمت الاضافة";
 }else{
 echo "حدث خطاء";
 }
 }else{
 echo "حدث خطاء في النقل";
 } 
}
echo "</center>";
 include("includes/footer.php");
?>