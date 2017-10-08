<?php
include "connection.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 
</head>

<body>
<a href="add_menu_items.php?id=0">ADD MAIN MENU</a><br><br>
<?php
$res=mysqli_query($link,"select * from main_menu where parentid=0  order by parentid ");
while($row=mysqli_fetch_array($res))
{
echo $row["title"]."<a href='add_menu_items.php?id=$row[id]' style='font-weight:bold; text-decoration:none; margin-left:10px'>+</a> <a href='delete_menu_items.php?id=$row[id]' style='font-weight:bold; text-decoration:none; margin-left:10px'>x</a>"."<br>";
$id=$row["id"];

 $cou=0;
 $res5=mysqli_query($link,"select * from main_menu where parentid=$id");
 $cou=mysqli_num_rows($res5);
 if($cou>0){generate_menu($id,1);}
}


function generate_menu($id,$level)
{
    include "connection.php";
   $level++;
   $res1=mysqli_query($link,"select * from main_menu where parentid=$id");
   while($row1=mysqli_fetch_array($res1))
   {
     for($i=1;$i<=$level;$i++)
	 {
	 if( $i>1) echo "|---- ";
	 }
      echo $row1["title"]."<a href='add_menu_items.php?id=$row1[id]' style='font-weight:bold; text-decoration:none; margin-left:10px'>+</a> <a href='delete_menu_items.php?id=$row1[id]' style='font-weight:bold; text-decoration:none; margin-left:10px'>x</a>"."<br>";  
	  $id1=$row1["id"];
      generate_menu($id1,$level);   
   }

}

?>







</body>
</html>
