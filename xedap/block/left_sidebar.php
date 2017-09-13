<div class="left-sidebar">
						<h2>Danh mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<?php
						require_once 'connect/db_connect.php';
						$sql="select * from nhomsanpham where tennhom!='Quà khuyến mãi'";
						$db=new DB_Connect();
						$conn=$db->connect();
						$result=mysqli_query($conn,$sql) or die('Cau lenh sai');
						while($row=mysqli_fetch_assoc($result))
						{
						echo	'<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="shop.php?id='.$row['manhom'].'">'.$row['tennhom'].'</a></h4>
									</div>
								</div>';
						}
						?>
						</div><!--/category-products-->	
						
						<div class="price-range"><!--price-range-->
							<h2>Giá</h2>
							<div class="well text-center">
								 <input  type="text" class="span2" value="" data-slider-min="0" data-slider-max="22000000" data-slider-step="500000" data-slider-value="[1000000,5000000]" id="sl2" ><br />
								 <b class="pull-left">VND: 0</b> <b class="pull-right">VND: 22.000.000</b>
								 <input type="button" value="Tìm" onclick="search()">
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/93.jpg" alt="" width="270px" height="330px"/>
						</div><!--/shipping-->
					
					</div>