<?php
ob_start();
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
<script type="text/javascript">
  function lichchieu(malichchieu){
      var link="datve.php?malichchieu="+malichchieu;
      window.location.href=link;
  }
</script>
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
        if(!isset($_SESSION['user'])){
          echo '<li><a href="login.php">LOGIN</a></li>';
          $status=false;
        }
        else {
           echo '<li><a href="suathongtin.php?mataikhoan='.$_SESSION['id'].'">Hi, '.$_SESSION['user'].'</a></li>';
          echo '<li><a href="logout.php">Thoát</a></li>';
          $status=true;
        }
        ?>
      </ul>
    </div>
    <div id="sub-navigation">
      
    </div>
  </div>
  <div id="main">
    <div id="content">
      <div style="display:inline-block;">
        <div style="float:left;">
        <?php
          include_once 'connect/db_connect.php';
          $db=new DB_Connect();
          $conn=$db->connect();
          $id=$_GET['maphim'];
          $result=mysqli_query($conn,"select * from phim,giave where maphim='$id' and phim.loaive=magia");
          $row=mysqli_fetch_array($result);
          echo '<img width="250" height="320" src="images/'.$row['anh'].'">';
        ?>
          
        </div>
        <div style="width:500px;float:left;padding: 50px">
        <?php
        echo '
            <ul>
            <li><strong style="color:#000;font-size: 15px;font-style: bold;">Khởi chiếu:  </strong><strong style="color:#000;">Từ '.$row['ngaybatdau'].' đến '.$row['ngayketthuc'].'</strong></li>
            <li><strong style="color:#000;font-size: 15px;font-style: bold;">Đạo diễn:  </strong><strong style="color:#000;">'.$row['daodien'].'</strong></li>
            <li><strong style="color:#000;font-size: 15px;font-style: bold;">Diễn viên:  </strong><strong style="color:#000;">'.$row['dienvien'].'</strong></li>
            <li><strong style="color:#000;font-size: 15px;font-style: bold;">Thời lượng:  </strong><strong style="color:#000;">'.$row['thoiluong'].'</strong></li>
            <li><strong style="color:#000;font-size: 15px;font-style: bold;">Giá vé:  </strong><strong style="color:#000;">'.$row['gia'].' VND</strong></li>
            <li><strong style="color:#000;font-size: 15px;font-style: bold;">Tóm tắt phim:  </strong><p style="color:#000;">'.$row['tomtat'].'</p></li>
          </ul>
        ';
        ?>
        </div>
      </div>
      <?php
      if(date("Y-m-d")>=$row['ngaybatdau']){
      echo '
        <div style="margin: 50px;">
       <h1 style="color:#000">Lịch chiếu</h1>
        <ul>';
          $result=mysqli_query($conn,"select * from lichchieu where phim='$id' and ngaychieu >NOW() group by ngaychieu order by ngaychieu asc");
          while($row=mysqli_fetch_array($result)){
            $ngaychieu=$row['ngaychieu'];
            echo '<li style="padding:10px;color:green;font-family:bold;font-size:15px;">'.$row['ngaychieu'];
            echo '<ul>';
            $resultTime=mysqli_query($conn,"select malichchieu,tenphong,DATE_FORMAT(batdau, '%H:%i') as batdau,DATE_FORMAT(ketthuc, '%H:%i') as ketthuc from lichchieu,phongchieu where phim='$id' and ngaychieu = '$ngaychieu' and lichchieu.phongchieu=phongchieu.maphong");
            while($time=mysqli_fetch_array($resultTime)){
              echo '<li style="padding:5px;color:green;font-family:bold;font-size:15px;" ><a onclick="lichchieu(\''.$row['malichchieu'].'\')">'.$time['tenphong'].'  '.$time['batdau'].'-'.$time['ketthuc'].'</a></li>';
            }
            echo '</ul>';
            echo '</li>';
          }
      echo '
        </ul>
     </div>';
      }
      ?>
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