<?php
  include("includes/db.php");
  include("includes/functions.php");
 if(isset($_POST['command']) && isset($_POST['productid']))
 {
 if($_POST['command']=='add' && $_POST['productid']>0)
 {
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
<div align="center">
 <h1 align="center" class="newStyle2">المنتجات</h1>
 <table border="0" cellpadding="2px" width="1200px">
 <tr>
 <?php
  $nu=0;
 $result=mysql_query("SELECT * from products");
 while($row=mysql_fetch_array($result)){
  $nu++;
  if($nu==4)
  {
      $div_row .='</tr><tr>';
      $nu=1;
  }

  @$div_row .='
  <td style="width:400px;" valign="top">
  <div class="form-inline" valign="top">
  <div style="width:390px;">
  <img src="'.$row['picture'].'" style="width:250px; height:200px;"/>
  <br>
  <b>'.$row['name'].'</b><br />
  '.$row['description'].'.
<br />
  Price:<big style="color:green"> $'.$row['price'].'</big><br /><br />
  <input type="button" value="Add to Cart" onclick="addtocart('.$row['serial'].');" />
  </div>
  <span class="form-outline mr-auto"><img src="images/111.jpg"  style="width:1px; height:355px"/></span>
</div>
<hr size="1" />
  </td>
  
  ';
}
echo $div_row;
 ?>
</tr>
</table>
</div>
<script language="javascript">
function addtocart(pid){
 document.form1.productid.value=pid;
 document.form1.command.value='add';
 document.form1.submit();
 }
</script> 
   <?php include("includes/footer.php");?>