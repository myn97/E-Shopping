<?php
 include("includes/db.php");
 include("includes/functions.php");
 if( isset($_POST['command']))
 {
 if($_POST['command']=='add' && $_POST['productid']>0){
 $pid=$_POST['productid'];
 addtocart($pid,1);
 header("location:shoppingcart.php");
 exit();
 }
 }
  include("includes/header.php");
?> 

<form name="form1" method="post">
 <input type="hidden" name="productid" />
 <input type="hidden" name="command" />
</form>
<?php
$search=$_POST["search"];
$result=mysql_query("SELECT * from products where `name` or `description` like '%$search%' ;");
if (!mysql_num_rows($result)){
 echo "لاتوجد بيانات <br /><a href='search.php'>لمعاودة البحث </a>";
}else{
?>
<div align="center">
 <h1 align="center" class="newStyle2">المنتجات</h1>
 <table border="0" cellpadding="2px" width="600px">
 <?php
 while($row=mysql_fetch_array($result)){
 ?>
 <tr>
 <td><img src="<?php echo $row['picture']?>" style="width:250px; height:200px;"/></td>
 <td> <b><?php echo $row['name']?></b><br />
 <?php echo $row['description']?><br />
 Price:<big style="color:green">$<?php echo $row['price']?></big><br /><br />
 <input type="button" value=" اضفة للسلة"onclick="addtocart(<?php echo $row['serial']?>)" />
 </td>
 </tr>
 <tr><td colspan="2"><hr size="1" /></td>
 <?php } ?>
 </table>
</div>
<?php } ?>
<script language="javascript">
 function addtocart(pid){
 document.form1.productid.value=pid;
 document.form1.command.value='add';
 document.form1.submit();
 }
</script>
<?php include("includes/footer.php");?>
