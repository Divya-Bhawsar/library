<?php
include "connection.php";
include "navbar.php";
include "sidenav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue_info Books</title>
    <link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body 
{
  background-image: url("images/issue.jpg");
  background-repeat:none;
  position: fixed;
  width: 100%;
}
.container
{
  height: 800px;
  background:black;
  opacity: .7;
  color:white;
  margin-top:-79px;
  width: 80%;
}
.Approve
{
    text-align:center;
    width: 400px;
    margin-left:400px;
}
.scroll
{
  width: 100%;
  height: 650px;
  overflow:auto;
}
</style>
</head>
<body>
<div class= "container">
 <h3 style ="text-align:center;">Information Of Borrowed Books</h3><br>
<?php
   if(isset($_SESSION['login_user']))
   {
    $sql="SELECT student_registration.full_name,id,books.bid,name,authors,edition,issue,issue_book.returns FROM student_registration inner join issue_book ON student_registration.full_name=issue_book.full_name inner join books ON issue_book.bid=books.bid 
    WHERE issue_book.approve='yes' ORDER BY `issue_book` . `returns` ASC";
    $res=mysqli_query($con,$sql);
    echo "<div class='scroll'>";
    echo "<table class='table table-bordered' >";
    echo "<tr style='background-color:#6db6b9e6;'>";
    echo "<th>"; echo"Student ID"; echo"</th>";
    echo "<th>"; echo"Student Name"; echo"</th>";
    echo "<th>"; echo"Book ID"; echo"</th>";
    echo "<th>"; echo"Book Name"; echo"</th>";
    echo "<th>"; echo"Authors Name"; echo"</th>";
    echo "<th>"; echo"Edition"; echo"</th>";
    echo "<th>"; echo"Issue Date"; echo"</th>";
    echo "<th>"; echo"Return Date"; echo"</th>";
    echo"</tr>";
    while($row=mysqli_fetch_assoc($res))
    {
      $d= strtotime($row['returns']);
        $q=0;
        $c=strtotime(date("Y-m-d"));
        $diff=abs($c-$d);
        $diff=intval($diff/86400);
         if($c > $d)
          {  
              $q=$q+1;
              $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
              mysqli_query($con,"UPDATE `issue_book` SET `approve`='$var' where `issue_book` . `returns`='$row[returns]' and approve='yes' limit $q;");
             // echo $c."</br>";
          }       
       echo "<tr>";
       echo "<td>"; echo $row['id']; echo"</td>";
       echo "<td>"; echo $row['full_name']; echo"</td>";
       echo "<td>"; echo $row['bid']; echo"</td>";
       echo "<td>"; echo $row['name']; echo"</td>";
       echo "<td>"; echo  $row['authors']; echo"</td>";
       echo "<td>"; echo $row['edition']; echo"</td>";
       echo "<td>"; echo $row['issue']; echo"</td>";
       echo "<td>"; echo $row['returns']; echo"</td>";
       echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
  }
 ?>
</div>
</body>
</html>
