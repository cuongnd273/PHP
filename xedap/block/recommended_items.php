<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm ngẫu nhiên</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
						<?php
						require_once 'connect/db_connect.php';
						$db=new DB_Connect();
						$conn=$db->connect();
						$sql='SELECT *FROM sanpham where loaisanpham=1 ORDER BY RAND() LIMIT 3';
						$result=$conn->query($sql);
						$count=mysqli_num_rows($result);
						while($row=mysqli_fetch_array($result))
						{
							echo'		
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<a href="product-details.php?id='.$row['masanpham'].'"><img src="images/products/'.$row['anh'].'" alt="" style="width:280px;height:200px;"/></a>';
								$sqlGG="select COUNT(manhom) as total,giamgia from chitietkhuyenmai,khuyenmai where chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and '$date'<khuyenmai.thoigianketthuc and '$date'>khuyenmai.thoigianbatdau and loaikhuyenmai=0 and manhom='$row[manhom]'";
								$resultGiamgia=$conn->query($sqlGG);
								$set=mysqli_fetch_array($resultGiamgia);
								if($set['total']>0)
								{
									echo '<h2 style="text-decoration:line-through;">'.number_format($row['gia']).'</h2>';
									echo '<h2 >'.number_format($row['gia']-($row['gia']*$set['giamgia']/100)).'</h2>';
								}else{
									echo '<h2 style="text-decoration:line-through;"></h2>';
									echo '<h2>'.number_format($row['gia']).'</h2>';
								}
							echo'						<p>'.$row['tensanpham'].'</p>
														<button type="button" class="btn btn-fefault add-to-cart" onclick="add('.$row['masanpham'].',1)">
														<i class="fa fa-shopping-cart"></i>
														Add to cart
														</button>
													</div>
												</div>
											</div>
										</div>';
						}
						echo '</div>';
						$result=$conn->query($sql);
						echo '<div class="item">';
						while($row=mysqli_fetch_array($result))
						{
							echo'		
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<a href="product-details.php?id='.$row['masanpham'].'"><img src="images/products/'.$row['anh'].'" alt="" style="width:280px;height:200px;"/></a>';
								$sqlGG="select COUNT(manhom) as total,giamgia from chitietkhuyenmai,khuyenmai where chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and '$date'<khuyenmai.thoigianketthuc and '$date'>khuyenmai.thoigianbatdau and loaikhuyenmai=0 and manhom='$row[manhom]'";
								$resultGiamgia=$conn->query($sqlGG);
								$set=mysqli_fetch_array($resultGiamgia);
								if($set['total']>0)
								{
									echo '<h2 style="text-decoration:line-through;">'.number_format($row['gia']).'</h2>';
									echo '<h2 >'.number_format($row['gia']-($row['gia']*$set['giamgia']/100)).'</h2>';
								}else{
									echo '<h2 style="text-decoration:line-through;"></h2>';
									echo '<h2>'.number_format($row['gia']).'</h2>';
								}
							echo'						<p>'.$row['tensanpham'].'</p>
														<button type="button" class="btn btn-fefault add-to-cart" onclick="add('.$row['masanpham'].',1)">
														<i class="fa fa-shopping-cart"></i>
														Add to cart
													</button>
													</div>
													
												</div>
											</div>
										</div>';
						}
						echo '</div>';
						?>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->