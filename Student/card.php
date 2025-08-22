<?php
include "navbar.php";
include "connection.php";


session_start();


$sql=mysqli_query($con,"SELECT * FROM `student_registration` where full_name='$_SESSION[login_user]';");

$row=mysqli_fetch_assoc($sql);

    $full_name = $row['full_name'];
    $id = $row['id'];
    $card = $row['card'];


    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Card</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
        }

        .library-card {
            width: 450px;
            height: 300px;
            background-color:white;
            border: 5px solid #5d6726;
            border-radius: 25px;
            margin: 200px auto;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color:black;
            font-family: 'Arial', sans-serif;
        }

        .im img{
            width: 80px;
            height:70px;
            margin-left:310px;
            margin-top:10px;
        }
.college-name
{
   
    font-size: 20px;
  
}
        .student-name {
            font-size: 18px;
            margin-top:-50px;
            padding:2px;
           
        }

        .student-id {
            font-size: 18px;
        
            
            
        }

        .library-number {
            font-size: 16px;
            
        }

        #barcode {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="library-card">
       <div class="college-name" ><b style="font-size:21px; font-family:Georgia, 'Times New Roman', Times, serif; color:black; font: weigth bold;">Govt. Holkar Science College,Indore</b><br></div>
    <div style="font-size:20px; margin-top:10px" >   <b style="margin-left:30px; font-family: cursive; ">       #--Library Card Identification--#</b> 
    </div>
    <div class="im" style="margin: 0px;"><img src='images/<?php echo $_SESSION['image']; ?>' alt="Library Logo"></div>
        <div class="student-name"><b>Student Name : </b><?php echo $full_name; ?>
       </div>
        <div class="student-id" style="padding:3px; "><b>Student ID : </b><?php echo $id; ?></div>
        <div class="library-number" style="padding:3px;"><b>Library Card Number : </b><?php echo $card; ?></div>
        <div class="library-number" style="padding:3px;"><b>Course details : <b style="color:black;">B .C. A (C101)</b> </div>
        <div class="det" style="padding:0px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; margin-left:0px; "><h3 style="color:orange;"> 📚 Please , Keep Silence In The Library📚</h3></div>
       <script src="https://cdn.jsdelivr.net/jsbarcode/3.11.0/JsBarcode.all.min.js"></script>
       <div id="barcode"></div>
       <script>
        // Generate a barcode with value "123456789"
        JsBarcode("#barcode", "123", {
            format: "CODE128",
            displayValue: true
        });
    </script>
    </div>
        <!-- ... (existing card content) ... -->

       
        <!-- Print button -->
        <button class="btn btn-default" onclick="printLibraryCard()" style="margin-left:650px; margin-top:-250px; ">Print Library Card</button>
    
    <script>
        
        function printLibraryCard() {
            window.print();
        }
    </script>
    
    <?php
    function generateBarcode() {
        // Your barcode generation logic goes here
        // This can be a library or service for generating barcodes
        // Example: return "123456789";
    }
    ?>
</body>
</html>
