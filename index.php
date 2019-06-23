<?php
  session_start();
  if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $usertag = strstr($user->email, '@', true);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="index-style.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

      #settings a:hover{
        padding: 4px 12px;
      }
    </style>
    <title>smART</title>
  </head>
  <body>
    <div class="container">
      <div class="header" id="myHeader">
        <h1><a href="#">smART</a></h1>
        <p id="searchbox"class="search"><input type="text" placeholder="Search.."><button type="button" name="button"><i class="fas fa-search"></i></button></p>
        <div class="menu" id="myMenu">
          <a class="icon" onclick="hamburger(), searchHide()"><i class="fa fa-bars"></i></a>
          <a href="#" id="home" class="item">Home</a>
          <a href="#" id="profile" class="item">Profile</a>
          <a href="login.php" id="logout" class="item">Log out</a>
        </div>
      </div>
      <div class="nav">
        <a href="#" style="color:#ff5b0d; border-radius: 3px; border-bottom: 2px solid #ff5b0d;">Following</a>
        <a href="#">Explore</a>
      </div>
      <div class="main">
        <div class="info">
          <div style="display:inline-flex; flex-wrap:wrap">
            <a href="#"><i class="fas fa-user-circle profile_pic"></i></a>
            <div class="username">
              <a href="#"><h4><?php echo $user->username; ?></h4></a>
              <a href="#"><h5><?php echo '@'. $usertag ?></h5></a>
            </div>
          </div>
          <div class="followers">
            <a href="#">
              <div>
                <h5>Posts</h5>
                <h3>15</h3>
              </div>
            </a>
            <a href="#">
              <div>
                <h5>Followers</h5>
                <h3>52</h3>
              </div>
            </a>
            <a href="#">
              <div>
                <h5>Following</h5>
                <h3>43</h3>
              </div>
            </a>
          </div>
        </div>
        <div class="posts">
          <div class="single-post">
            <i class="fas fa-user-circle profile_pic" style="color:#100e17"></i>
            <div class="content">
              <div style="display:flex; justify-content:space-between;">
                <h4><span><a href="#">Username</a></span> <span style="font-size:13px; color:gray;"><a href="#">@usertag</a></span></h4>
                <a href="#"><i class="fas fa-chevron-down"></i></a>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <a href="#"><img src="PowerSuitTurn.jpg" alt=""></a>
              <p><i class="fas fa-thumbs-up" style="font-size:20px; color:#ff5b0d;"></i><span style="font-weight:bold;"> 37</span></p>
            </div>
          </div>
          <div class="single-post">
            <i class="fas fa-user-circle profile_pic" style="color:#da1c5f"></i>
            <div class="content">
              <div style="display:flex; justify-content:space-between;">
                <h4><span><a href="#">Username</a></span> <span style="font-size:13px; color:gray;"><a href="#">@usertag</a></span></h4>
                <a href="#"><i class="fas fa-chevron-down"></i></a>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <a href="#"><img src="valve-fantasy-game-1.jpg" alt=""></a>
              <p><i class="fas fa-thumbs-up" style="font-size:20px; color:#ff5b0d;"></i><span style="font-weight:bold;"> 58</span></p>
            </div>
          </div>
        </div>
        <div class="suggestions">
          <div class="d1">
            <h5>Accounts you may like</h5>
            <a href="#" style="color:gray;"><h5>See More</h5></a>
          </div>
          <div class="accounts">
            <div class="user">
              <a href="#"><i class="fas fa-user-circle profile_pic" style="color:#db4251;"></i></a>
              <div class="username">
                <a href="#"><h4>Username</h4></a>
                <a href="#"><h5>@usertag</h5></a>
              </div>
              <button type="button" name="add">Follow</button>
            </div>
            <div class="user">
              <a href="#"><i class="fas fa-user-circle profile_pic" style="color:#94bbe9;"></i></a>
              <div class="username">
                <a href="#"><h4>Username</h4></a>
                <a href="#"><h5>@usertag</h5></a>
              </div>
              <button type="button" name="add">Follow</button>
            </div>
            <div class="user">
              <a href="#"><i class="fas fa-user-circle profile_pic" style="color:#9ae994;"></i></a>
              <div class="username">
                <a href="#"><h4>Username</h4></a>
                <a href="#"><h5>@usertag</h5></a>
              </div>
              <button type="button" name="add">Follow</button>
            </div>
          </div>
        </div>
      </div>
      <a href="#"><i id="create" class="fas fa-edit"></i></a>
    </div>

    <script>
      function hamburger() {
        var x = document.getElementById("myMenu");
          if (x.className === "menu") {
            x.className += " responsive";
          } else {
          x.className = "menu";
          }

          var y = document.getElementById("myHeader");
          if(y.className === "header"){
            y.className+= " align-end";
          }else{
            y.className = "header";
          }
      }

      function searchHide(){
        var x = document.getElementById("searchbox");
        if(x.className === "search"){
          x.className += " removeSearch"
        }else{
          x.className="search"
        }
      }
    </script>
  </body>
</html>
