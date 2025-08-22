<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Footer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <style>
    footer {
      background-color: rgb(1, 4, 4);
      padding: 30px 20px;
      text-align: center;
    }

    footer h3 {
      color: white;
      font-size: 15px;
      font-family: 'Times New Roman', Times, serif;
      margin-bottom: 20px;
    }

    .social-icons {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .fa {
      padding: 10px;
      font-size: 20px;
      width: 40px;
      height: 40px;
      text-align: center;
      text-decoration: none;
      border-radius: 50%;
      line-height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .fa-facebook {
      background: #3B5998;
      color: white;
    }

    .fa-twitter {
      background: #55ACEE;
      color: white;
    }

    .fa-google {
      background: #db4a39;
      color: white;
    }

    .fa-instagram {
      background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
      color: white;
    }

    .fa-linkedin {
      background: #0077B5;
      color: white;
    }

    footer p {
      color: aliceblue;
      font-family: 'Times New Roman', Times, serif;
      font-size: 14px;
      line-height: 1.6;
    }

    @media (max-width: 600px) {
      .fa {
        width: 35px;
        height: 35px;
        font-size: 18px;
      }

      footer h3 {
        font-size: 13px;
      }

      footer p {
        font-size: 13px;
      }
    }
  </style>
</head>
<body>

<footer>
  <h3>******* Contact us through Social Media *******</h3>
  <div class="social-icons">
    <a href="#" class="fa fa-facebook"></a>
    <a href="#" class="fa fa-twitter"></a>
    <a href="#" class="fa fa-google"></a>
    <a href="#" class="fa fa-instagram"></a>
    <a href="#" class="fa fa-linkedin"></a>
  </div>
  <p>
    Email: Online.library@gmail.com<br>
    Mobile: +8880101*********
  </p>
</footer>

</body>
</html>
