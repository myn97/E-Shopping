<?php
 include("includes/db.php");
 include("includes/functions.php");
 if( isset($_POST['command']))
 {
 if($_POST['command']=='update'){
 $name=$_POST['name'];
 $email=$_POST['email'];
 $address=$_POST['address'];
 $phone=$_POST['phone'];

 $result=mysql_query("INSERT into `customers` values ('','$name','$email','$address','$phone')");
 $customerid=mysql_insert_id();
 $date=date('Y-m-d');
 $result=mysql_query("INSERT into `orders` values ('','$date','$customerid')");
 $orderid=mysql_insert_id();
 $max=count($_SESSION['cart']);
 for($i=0;$i<$max;$i++){
 $pid=$_SESSION['cart'][$i]['productid'];
 $q=$_SESSION['cart'][$i]['qty'];
 $price=get_price($pid);
 mysql_query("INSERT into `order_detail` values ($orderid,$pid,$q,$price)");
 }
 die('Thank You! your order has been placed!');
}
 }
 include("includes/header.php");
 ?>

<form name="form1" onsubmit="validate()" method="post">
<input type="hidden" name="command" />
<div align="center">
<h1 align="center" class="newStyle2">بيانات الفاتورة</h1>
<table border="0" cellpadding="2px">
<tr><td>اجمالي السعر:</td><td style="color:blue;">$<?php echo get_order_total()?></td></tr>
 <tr><td>الاسم:</td><td><input type="text" name="name"/></td></tr>
 <tr><td>العنوان:</td><td><input type="text" name="address"/></td></tr>
<tr><td>البريد الالكتروني:</td><td><input type="text" name="email"/></td></tr>
<tr><td>الهاتف:</td><td><input type="text" name="phone"/></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Place Order" /></td></tr>
</table>
</div>
</form>

<script language="javascript">
 function validate(){
 var f=document.form1;
 if(f.name.value==''){
 alert('Your name is required');
 f.name.focus();
 return false;
 }
 f.command.value='update';
 f.submit();
 }
</script>
<?php include("includes/footer.php");?>
