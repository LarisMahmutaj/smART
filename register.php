<?php
  $msg = '';

  $host = 'localhost';
  $user = 'root';
  $password = 'scnmhfcbmmfthftwwaanem';
  $dbname = 'smart';


  //set DSN
  $dsn = 'mysql:host='. $host .';dbname='. $dbname;

  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  if(filter_has_var(INPUT_POST, 'register_btn')){
    session_start();
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    if(!empty($username) && !empty($email) && !empty($password) && !empty($password2)){
      //create user
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $msg = 'Please use a valid email!';
      }else{
        $sql = 'SELECT * FROM user WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($list) >0){
          $msg = 'There already exists an account with this email';
        }else{
          $number = preg_match('@[0-9]@', $password);

          if(!$number || strlen($password) < 8 ){
            $msg = 'Password must contain at least one number';
          }else{
            if($password != $password2){
              $msg = 'Passwords do not match!';
            }else{
              $sql = 'SELECT * FROM user WHERE username = :username';
              $stmt = $pdo->prepare($sql);
              $stmt->execute(['username' => $username]);
              $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
              if(count($list) >0){
                $msg = 'Username taken. Please chose a different username!';
              }else{
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                $vkey = md5(time().$username);
                $sql = 'INSERT INTO user(username, email, password, vkey) VALUES(:username, :email, :password_hashed, :vkey)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['username' => $username, 'email' => $email, 'password_hashed' => $password_hashed, 'vkey' => $vkey]);
                if($stmt){
                  //Send Email
                  $to = $email;
                  $subject = 'Email Verification';
                  $body = "<a href='http://localhost/smart/verify.php?vkey=$vkey'>Verify account</a>";
                  $headers = "From: el.smART.official@gmail.com \r\n";
                  $headers .= "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                  mail($to, $subject, $body, $headers);

                  header('location: thankyou.php');
                }
              }
            }
          }
        }
      }
      // $password_hashed = password_hash($password, PASSWORD_DEFAULT);
      // $sql = 'INSERT INTO user(username, email, password) VALUES(:username, :email, :password_hashed)';
      // $stmt = $pdo->prepare($sql);
      // $stmt->execute(['username' => $username, 'email' => $email, 'password_hashed' => $password_hashed]);
    }else{
      //failed
      $msg = 'Please fill in all fields';
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <link href="register-style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5cbd45029c.js"></script>
    <title>Register</title>
  </head>
  <body>
    <div class="container">
      <div class="slider">
        <div id="welcome" class="slides fade">
          <div><h1>Welcome To smArt</h1></div>
        </div>
        <img class="slides fade" src="img-1.jpg" alt="">
        <img class="slides fade" src="img-2.jpg" alt="">
      </div>
      <form role="form" method="post" action="register.php" class="register-box">
        <h2>Register Here</h2>
        <input class="input-box" type="text" name="email" placeholder="Email" value="<?php echo isset($_POST['email'])? $email : ''; ?>">
        <input class="input-box" type="text" name="username" placeholder="Username" value="<?php echo isset($_POST['username'])? $username : ''; ?>">
        <input class="input-box" type="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password'])? $password : ''; ?>">
        <input class="input-box" type="password" name="password2" placeholder="Confirm Password" value="<?php echo isset($_POST['password2'])? $password2 : ''; ?>">
        <?php if($msg != ''): ?>
          <p><em><i class="fas fa-exclamation-triangle"></i>  <?php echo $msg; ?></em></p>
        <?php endif; ?>
        <input id="register-btn" type="submit" name="register_btn" value="Register">

        <a href="login.php">Already have an account? Log in</a>
      </form>

    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
      var slideIndex = 0;
      showSlides();

      function showSlides(){
        var slides = document.getElementsByClassName('slides');
        for(var i = 0;i<slides.length;i++){
          slides[i].style.display = "none"
        }
        slideIndex++;
        if(slideIndex>slides.length){
          slideIndex =1;
        }
        slides[slideIndex-1].style.display = "flex";
        setTimeout(showSlides,5000);
      }
    </script>
  </body>
</html>
