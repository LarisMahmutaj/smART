<?php
  if (POST) {
    file_put_contents(__DIR__ . '/../log.txt', '');
    return redirect('/error_log.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Log</title>
</head>
<body>
  <form action="/error_log.php" method="post">
    <input type="submit" value="Clear" />
  </form>
  <br />
  <pre><?= file_get_contents(__DIR__ . '/../log.txt'); ?></pre>
</body>
</html>
