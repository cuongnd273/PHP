<div class="sidebar">
			<div class="brand">
				<a href="index.php"><img src="assets/img/logo.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li>
							<a href="#subRooms" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>Phòng</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subRooms" class="collapse ">
								<ul class="nav">
									<?php if(isset($_SESSION['nhanvien']))
										echo '
										<li><a href="index.php" class="">Tất cả các phòng</a></li>
										<li><a href="index.php?active=true" class="">Phòng sử dụng</a></li>
										<li><a href="index.php?active=false" class="">Phòng trống</a></li>									
									';
									?>
									<?php if(isset($_SESSION['admin']))
										echo '<li><a href="phong.php" class="">Quản lý phòng</a></li>';
									?>
								</ul>
							</div>
						</li>
						<?php if(isset($_SESSION['admin']))
							echo '
							<li>
								<a href="#subBills" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Hóa đơn</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subBills" class="collapse ">
									<ul class="nav">
										<li><a href="hoadon.php?pay=chuathanhtoan" class="">Chưa thanh toán</a></li>
										<li><a href="hoadon.php?pay=dathanhtoan" class="">Đã thanh toán</a></li>
									</ul>
								</div>
							</li>
							<li><a href="nhanvien.php" class=""><i class="lnr lnr-users"></i> <span>Nhân viên</span></a></li>
							<li><a href="mathang.php" class=""><i class="lnr lnr-file-empty"></i> <span>Mặt hàng</span></a></li>
							<li><a href="thietbi.php" class=""><i class="lnr lnr-file-empty"></i> <span>Thiết bị</span></a></li>
						';
						?>
						<?php if(isset($_SESSION['nhanvien']))
										echo '
									<li><a href="doimatkhau.php" class=""><i class="lnr lnr-file-empty"></i> <span>Đổi mật khẩu</span></a></li>';
						?>
						<li><a href="logout.php" class=""><i class="lnr lnr-exit"></i> <span>Thoát</span></a></li>
					</ul>
				</nav>
			</div>
		</div>