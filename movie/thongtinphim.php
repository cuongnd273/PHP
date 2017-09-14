<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Khali Cinema</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="assets/user/css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="assets/user/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="assets/user/js/jquery-func.js"></script>
<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
</head>
<body>
<!-- START PAGE SOURCE -->
<div id="shell">
  <div id="header">
    <h1 id="logo"><a href="#">MovieHunter</a></h1>
    <div id="navigation">
      <ul>
        <li><a class="active" href="#">HOME</a></li>
        <li><a href="#">LOGIN</a></li>
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
          echo '<img width="250" height="430" src="images/'.$row['anh'].'">';
        ?>
          
        </div>
        <div style="width:500px;float:left;padding: 50px">
        <?php
        echo '
            <ul>
            <li><strong style="color:#FFF;font-size: 15px;font-style: bold;">Khởi chiếu:  </strong>Từ '.$row['ngaybatdau'].' đến '.$row['ngayketthuc'].'</li>
            <li><strong style="color:#FFF;font-size: 15px;font-style: bold;">Đạo diễn:  </strong>'.$row['daodien'].'</li>
            <li><strong style="color:#FFF;font-size: 15px;font-style: bold;">Diễn viên:  </strong>'.$row['dienvien'].'</li>
            <li><strong style="color:#FFF;font-size: 15px;font-style: bold;">Thời lượng:  </strong>'.$row['thoiluong'].'</li>
            <li><strong style="color:#FFF;font-size: 15px;font-style: bold;">Giá vé:  </strong>'.$row['gia'].' VND</li>
            <li><strong style="color:#FFF;font-size: 15px;font-style: bold;">Tóm tắt phim:  </strong><p>'.$row['tomtat'].'</p></li>
          </ul>
        ';
        ?>
        </div>
      </div>
     <div style="margin: 50px;">
       <h1>Lịch chiếu</h1>
        <ul>
          <li style="padding:10px;"><a>27/09/2017</a></li>
          <li style="padding:10px;"><a>27/09/2017</a></li>
          <li style="padding:10px;"><a>27/09/2017</a></li>
        </ul>
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