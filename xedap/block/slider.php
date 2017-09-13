<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
					<div class="carousel-inner">
						<?php
						require_once 'connect/db_connect.php';
						$db=new DB_Connect();
						$conn=$db->connect();
						$sql="select * from slider";
						$result=$conn->query($sql);
						$i=true;
						while($row=mysqli_fetch_assoc($result))
						{
							if($i==true)
							{
							echo '<div class="item active">';
							$i=false;
							}else{
							echo '<div class="item">';
							}
						echo'	
									<div class="col-sm-6">
										<h1><span>W</span>-ORLD BIKE</h1>
										<p>'.$row['gioithieu'].'</p>
										<a href="../xedap/product-details.php?id='.$row['link'].'" class="btn btn-default get">Get it now</a>
									</div>
									<div class="col-sm-6">
										<img src="images/home/'.$row['anh'].'" class="girl img-responsive" alt="" width="484px" heigth="441px" />
									</div>
								</div>';
						}
							?>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
