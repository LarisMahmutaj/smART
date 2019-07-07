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

  if(filter_has_var(INPUT_POST, 'login_btn')){
    session_start();
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if(!empty($username) && !empty($password)){
      $sql = 'SELECT * FROM member WHERE username = :username';
      $stmt = $pdo->prepare($sql);
      $stmt->execute(['username' => $username]);
      $member = $stmt->fetch();
      $_SESSION['member'] = $member;
      $verified = $member->verified;
      $hash = $member->password;
      if($verified == 1){
        if(!password_verify($password, $hash)){
          $msg = 'Username or password incorrect';
        }else{
          header('location: index.php');
        }
      }else{
        $msg = "This account hasnt been verified yet.<br> Please check your email.";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="login-style.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <title>Log in</title>
  </head>
  <body>
    <div class="container">
      <form method="post" class="login-box" action = "login.php">
        <h1>Login</h1>
        <input class="input-box" type="text" name="username" placeholder="Username" value="<?php echo isset($_POST['username'])? $username: ''; ?>">
        <input class="input-box" type="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password'])? $password: ''; ?>">
        <input type="submit" name="login_btn" id="login-btn" value="Log In">
        <?php if($msg != ''): ?>
          <p><em><i class="fas fa-exclamation-triangle"></i>  <?php echo $msg; ?></em></p>
        <?php endif; ?>
        <a href="register.php">Dont have an account? Register</a>
      </form>
    </div>
  </body>
</html>
