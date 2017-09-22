<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Khali Cinema</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="assets/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-func.js"></script>
<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
</head>
<body>
<!-- START PAGE SOURCE -->
<div id="shell">
  <div id="header">
    <h1 id="logo"><a href="index.php">MovieHunter</a></h1>
    <div id="navigation">
      <ul>
        <li><a href="index.php">HOME</a></li>
        <?php
        if(!isset($_SESSION['user']))
          echo '<li><a href="login.php">LOGIN</a></li>';
        else {
          echo '<li><a href="suathongtin.php?mataikhoan='.$_SESSION['id'].'">Hi, '.$_SESSION['user'].'</a></li>';
          echo '<li><a href="logout.php">Thoát</a></li>';
        }
          
        ?>
      </ul>
    </div>
    <div id="sub-navigation">
      
    </div>
  </div>
  <div id="main">
    <div id="content">
      <div class="box">
        <div class="head">
          <strong style="text-transform: uppercase;color: #000;font-size: 20px;font-style: bold;">Phim đang chiếu</strong><br/> 
        </div>
        <?php
        include_once 'connect/db_connect.php';
        $db=new DB_Connect();
        $conn=$db->connect();
        $sql="select * from phim where ngaybatdau <= NOW()";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){
          echo '
              <div class="movie" style="padding:20px;">
                <div class="movie-image"><img src="images/'.$row['anh'].'" alt="" /> </div>
                <div class="rating">
                  <a href="thongtinphim.php?maphim='.$row['maphim'].'"><p>'.$row['tenphim'].'</p></a>
                </div>
              </div>
          ';
        }
        ?>
        <div class="cl">&nbsp;</div>
      </div>
      <div class="box">
        <div class="head">
          <strong style="text-transform: uppercase;color: #000;font-size: 20px;font-style: bold;">Phim sắp chiếu</strong>
        </div>
       <?php
        $sql="select * from phim where ngaybatdau > NOW()";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){
           echo '
              <div class="movie" style="padding:20px;">
                <div class="movie-image"> <span class="play"><span class="name"><a href="thongtinphim.php?maphim='.$row['maphim'].'">'.$row['tenphim'].'</a></span></span> <img src="images/'.$row['anh'].'" alt="" /> </div>
                <div class="rating">
                   <a style="margin-left:10px;" href="thongtinphim.php?maphim='.$row['maphim'].'"><p>'.$row['tenphim'].'</p></a>
                </div>
              </div>
          ';
        }
       ?>
        <div class="cl">&nbsp;</div>
      </div>
    </div>

    <div class="cl">&nbsp;</div>
  </div>
  <div id="footer">
    <p class="lf">Khali Cinema &copy; 2017 </p>
    <p class="rf">Design by <a href="http://chocotemplates.com/">Anonymous</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>