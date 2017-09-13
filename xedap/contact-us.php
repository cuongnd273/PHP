<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Contact | E-Shopper</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
</head><!--/head-->

<body>
	 <?php
	require '/block/header.php';
	?>
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Liên lạc</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" id="name" class="form-control" required="required" placeholder="Họ tên">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" id="email" class="form-control" required="required" placeholder="Email">
				            </div>
							<div class="form-group col-md-12">
				                <input type="text" id="subject" class="form-control" required="required" placeholder="Chủ đề">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Góp ý"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="button" name="submit" class="btn btn-primary pull-right" value="SEND" onclick="sendemail()">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Liên hệ</h2>
	    				<address>
	    					<p>WORLD BIKE</p>
							<p>Số 154,Phạm Văn Đồng,Hà Nội</p>
							<p>HaNoi VN</p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Email: worldbike@gmail.com</p>
	    				</address>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	<?php
	require '/block/footer.php';
	?>
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/contact.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/search.js"></script>
</body>
</html>