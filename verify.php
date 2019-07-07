<?php
  $msg = '';
  if(isset($_GET['vkey'])){
    $vkey = $_GET['vkey'];

    $host = 'localhost';
    $user = 'root';
    $password = 'scnmhfcbmmfthftwwaanem';
    $dbname = 'smart';
    $dsn = 'mysql:host='. $host .';dbname='. $dbname;
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = 'SELECT verified, vkey FROM member WHERE verified = 0 AND vkey = :vkey';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['vkey' => $vkey]);
    $resultSet = $stmt->fetchAll();

    if(count($resultSet) != 1){
      $msg = 'This account is invalid or has already been verified';
    }else{
      $sql = 'UPDATE member SET verified = 1 WHERE vkey = :vkey LIMIT 1';
      $stmt = $pdo->prepare($sql);
      $stmt->execute(['vkey' => $vkey]);
      header('location:login.php');
    }
  }else{
    die("Something went wrong");
  }
?>

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
    </style>
  </head>
  <body>
    <div class="container">
      <?php if($msg != ''): ?>
        <p><em><i class="fas fa-exclamation-triangle"></i>  <?php echo $msg; ?></em></p>
      <?php endif; ?>
    </div>
  </body>
</html>
