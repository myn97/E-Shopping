<?php
 include("includes/db.php");
 include("includes/header.php");
 
switch(@$_GET['do']){
 case 'delete':
 $id=intval($_GET['id']);
 mysql_query("delete from products where serial=$id");
 if(mysql_errno()){
 echo"<div dir='ltr'>" . mysql_error() ."</div>"."حدث خطاء";
 }else{
 echo"تم الحذف بنجاح<br /><br /><a href='?'>اضغط هناء للبحث من جديد</a>";
 }
 break;
 case 'doedit':
 $id=intval($_GET['id']);
 $name=$_POST['name'];
 $description=$_POST['description'];
 if(!get_magic_quotes_gpc())$name=mysql_escape_string($name);
 if(!get_magic_quotes_gpc())$name=mysql_escape_string($description);
 $price=floatval($_POST['price']);
 if($_FILES['picture']['error']==0){ 
    $picture="images/".uniqid()."-".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'],$picture);
     @unlink($_POST['oldpic']);
     }else{
     $picture=($_POST['oldpic']);
     }
     $errors=array();
     if(empty($name)) $errors[]="الاسم";
     if(empty($description)) $errors[]="الوصف";
     if($price<=0) $errors[]="السعر";
     if(count($errors)>0){
        echo " يرجاء التاكد من (" . implode(" , ",$errors) . ")"." حدث خطاء";
        }else{
        mysql_query("update products set name='$name',description='$description', price=$price, picture='$picture' where serial=$id");
        if(mysql_errno()){
            echo"<div dir='ltr'>" . mysql_error() ."</div>"," حدث خطاء اثناء التنفيذ ";
        }else{
        echo"تم المعالجة بنجاح<br /><br /><a href='?'>عودة لصفحة التحكم</a>";
        break;
        }
        }
        case 'edit':
        $id=intval($_GET['id']);
        $query=mysql_query("select * from products where serial=$id");
        echo mysql_error();
        $row=mysql_fetch_array($query);
       
       ?> 
       <form action="?do=doedit&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
       <input name="oldpic" type="hidden" value="<?php echo $row['picture'];?>" />
        <table class="style" style="width: 100%; ">
        <tr>
        <th colspan="2" class="style">
        <span class="style" lang="ar-eg"><h1 class="newStyle2">......... تعديل .........</h1></span></th>
        </tr>
        <tr>
        <td class="style٧" style="width:100px"><span lang="ar-eg">اسم المنتج:</span></td>
        <td><input name="name" type="text" value="<?php echo $row['name'];?>" /></td>
        </tr>
        <tr> 
        <td class="style" style="width:100px"><span lang="ar-eg">وصف المنتج:</span></td>
 <td><textarea name="description" rows="3" cols="18" wrap="off"><?php echo $row['description'];?></textarea></td>
 </tr>
 <tr>
 <td class="style" style="width:100px">السعر:</td>
 <td><input name="price" type="text" value="<?php echo $row['price'];?>" /></td>
 </tr>
 <tr>
 <td class="style" style="width: 100px">صورة المنتج:</td>
 <td><input name="picture" type="file" value="" /> اترك الخانة فارغة اذا كنت لاتريد تغيير الصورة</td>
 </tr>
 <tr>
 <td colspan="2" class="style">
 <button type="submit">نفذ</button>
 &nbsp;
 <button type="reset">تفريغ</button></td>
 </tr>
 </table>
</form>
<?php
 break; 
 case 'view':
 default:
 $sql="select * from products ";
 $query=mysql_query($sql);
 if (mysql_num_rows($query)==0){
 echo"لاتوجد نتائج مطابقة";
 }else{
 ?>
 <table class="style" style="width:100% " border="2"> 
 <tr>
 <th colspan="4" class="style">
 <span class="newStyle2" lang="ar-eg"><h1 align="center">التحكم بالمنتجات</h1></span></th>
 </tr>
 <tr bgcolor="#eeeeee"> 
 <td ><b><span lang="areg">اسم المنتج</span></b></td>
 <td ><b><span lang="areg">سعر المنتج</span></b></td>
 <td ><b><span lang="areg">تعديل</span></b></td>
 <td ><b><span lang="areg">حذف</span></b></td>

 </tr>
 <?php
 while($row=mysql_fetch_array($query)){
 ?>
 <tr>
 <td><?php echo $row['name'];?></td>
 <td>$<?php echo $row['price'];?></td>
 <td><a href='?do=edit&id=<?php echo $row['serial'];?>'>تعديل</a></td> 
<td><a href='?do=delete&id=<?php echo $row['serial'];?>' onclick="returnconfirm('تاكيد الحذف')">حذف</a></td>
 </tr>
 <?php
 }
 ?>
 </table>
 <?php
 break;
 }
 }

//}
include("includes/footer.php");
?> 
