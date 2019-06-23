<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thank You</title>
    <style media="screen">
    *{
      padding:0;
      margin:0;
    }

    html{
        font-family: 'Titillium Web';
    }
    .container{
      display: flex;
      flex-direction: column;
      width: auto;
      color:ghostwhite;
      background: rgb(114,43,14);
      background: radial-gradient(circle, rgba(114,43,14,1) 0%, rgba(16,14,23,1) 69%);
      min-height: 100vh;
      align-items: center;
      justify-content: center;
    }
    #login-btn{
      font-size: 20px;
      text-decoration: none;
      padding: 10px 50px;;
      margin-top: 50px;
      transition: 0.5s;
      background: rgb(252,160,69);
      background: radial-gradient(circle, rgba(252,160,69,1) 0%, rgba(252,94,58,1) 100%);
      color: ghostwhite;
      border:none;
      border-radius: 5px;
    }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 style="font-size: 50px;">Thank you for joining smART</h1>
      <p>We have sent a verification email to the provided email address.</p>
      <a href="login.php" id="login-btn">Log In</a>
    </div>
  </body>
</html>
