<?php include("includes/header.php");?>
<div align="center">
 <h1 align="center" class="newStyle2">اضافة منتج</h1>
<form action="doadd.php" method="post" enctype="multipart/form-data">
 <table>
 <tr><td>: الاسم</td><td><input name="name" type="text"></td></tr>
<tr><td> الوصف :</td><td><input name="description" type="text" ></td></tr>
<tr><td>سعر المنتج :</td><td><input name="price" type="text"></td></tr>
<tr><td> الصورة: </td><td><input name="picture" type="file" ></td></tr>
</table>
<input type="submit" value="اضافة">
</form>
</div>
<?php include("includes/footer.php");?>