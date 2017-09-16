<?php
ob_start();
session_start();
if(!isset($_SESSION["user"]))
{
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Movie Ticket Booking Widget Flat Responsive Widget Template :: w3layouts</title>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Movie Ticket Booking Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<link href='//fonts.googleapis.com/css?family=Kotta+One' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href="assets/css/seat/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="assets/js/jquery-1.11.0.min.js"></script>
<script src="assets/js/jquery.seat-charts.js"></script>
</head>
<body>
<div class="content">
  <h1 ><a style="color: #FFF" href="index.php">Khali Cinema</a></h1>
  <div class="main">
    <div class="demo">
      <div id="seat-map">
        <div class="front">Màn hình</div>         
      </div>
      <div class="booking-details">
        <ul class="book-left">
          <li>Phim </li>
          <li>Ngày chiếu </li>
          <li>Thời gian</li>
          <li>Số ghế</li>
          <li>Danh sách :</li>
        </ul>
        <ul class="book-right">
          <li>: <span id="name"></span></li>
          <li>: <span id="date"></span></li>
          <li>: <span id="time"></span></li>
          <li>: <span id="counter">0</span></li>
        </ul>
        <div class="clear"></div>
        <ul id="selected-seats" class="scrollbar scrollbar1"></ul>
      
            
        <button class="checkout-button" onclick="thanhtoan(<?php echo $_SESSION['id']; ?>)">Thanh toán</button> 
        <div id="legend"></div>
      </div>
      <div style="clear:both"></div>
      </div>

      <script type="text/javascript">
        var giave = 0;
        $(document).ready(function() {          
          $.ajax({
            url : "controls/ghengoi.php",
            type : "get",
            dateType:"json",
            data : {
              malichchieu:$_GET('malichchieu'),
            },
            success : function (result){    
              var response=JSON.parse(result);
              var stt="";
              var seats=[];
              var booked=[];
              var ghes=[];
              $('#name').text(response.phim);
              $('#date').text(response.ngaychieu);
              $('#time').text(response.thoigian);
              giave=response.gia;
              for(var i=0;i<(response.soghe/10);i++)
                seats.push("aaaaaaaaaa");
              for(var i=0;i<response.ghengois.length;i++){
                var pos=response.ghengois[i].vitri;
                  booked.push(parseInt((pos/10)+1)+"_"+(pos%10));
              }
              load_seat(seats,booked);
            }
          }); 
        });
        function load_seat(seats,booked){
          var $cart = $('#selected-seats'), //Sitting Area
          $counter = $('#counter'), //Votes
          $total = $('#total'); //Total money
          
          var sc = $('#seat-map').seatCharts({
            map: seats,
            naming : {
              top : false,
              getLabel : function (character, row, column) {
                return (row-1)*10+column;
              }
            },
            legend : { //Definition legend
              node : $('#legend'),
              items : [
                [ 'a', 'available',   'Chưa đặt' ],
                [ 'a', 'unavailable', 'Đã đặt'],
                [ 'a', 'selected', 'Ghế bạn chọn']
              ]         
            },
            click: function () { //Click event
              if (this.status() == 'available') { //optional seat
                $('<li>'+this.settings.label+'</li>')
                  .attr('id', 'cart-item-'+this.settings.id)
                  .data('seatId', this.settings.id)
                  .appendTo($cart);

                $counter.text(sc.find('selected').length+1);                   
                return 'selected';
              } else if (this.status() == 'selected') { //Checked
                  //Update Number
                  $counter.text(sc.find('selected').length-1);
                    
                  //Delete reservation
                  $('#cart-item-'+this.settings.id).remove();
                  return 'available';
              } else if (this.status() == 'unavailable') { //sold
                return 'unavailable';
              } else {
                return this.style();
              }
            }
          });
          sc.get(booked).status('unavailable');
        }
        function $_GET(param) {
          var vars = {};
          window.location.href.replace( location.hash, '' ).replace( 
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function( m, key, value ) { // callback
              vars[key] = value !== undefined ? value : '';
            }
          );

          if ( param ) {
            return vars[param] ? vars[param] : null;  
          }
          return vars;
        }
        function thanhtoan(mataikhoan){
          var code = prompt("Nhập mã giảm giá", '');
          var giamgia=0;
          if(code!=null){
            $.ajax({
              url : "controls/giamgia.php",
              type : "post",
              dateType:"text",
              data : {
                magiamgia:code,
              },
              success : function (result){    
                var ob=JSON.parse(result);
                if(ob.status==200){
                  giamgia=ob.giamgia;
                  datve(mataikhoan,giamgia);
                }else{
                  alert("Mã không hợp lệ");
                }              }
          }); 
          }else{
            datve(mataikhoan,0);
          }
        }
        function datve(mataikhoan,giamgia){
          var lis = document.querySelectorAll('#selected-seats li[id]');
          var ghes = [];
          for (var i = 0; i < lis.length; i++) {
            ghes.push(lis[i].innerHTML);
          }
          $.ajax({
              url : "controls/datve.php",
              type : "post",
              dateType:"json",
              data : {
                add:'add',
                mataikhoan:mataikhoan,
                malichchieu:$_GET('malichchieu'),
                giamgia:giamgia,
                ghes:JSON.stringify(ghes),
              },
              success : function (result){    
                var ob=JSON.parse(result);
                if(ob.status=200){
                  alert('Bạn đã đặt vé thành công');
                }else{
                   alert('Có lỗi xảy ra');
                }
                window.setTimeout(function(){location.reload()},500)
              }
          }); 
        }
      </script>
  </div>
</div>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>
