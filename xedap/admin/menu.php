<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['adminName'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   <li>
                        <a href="taikhoan.php"><i class="fa fa-fw fa-table"></i> Tài khoản</a>
                    </li>
                    <li>
                        <a href="nhomsanpham.php"><i class="fa fa-fw fa-table"></i> Nhóm sản phẩm</a>
                    </li>
					<li>
                        <a href="sanpham.php"><i class="fa fa-fw fa-table"></i> Sản phẩm</a>
                    </li>
					<li>
                        <a href="hoadon.php"><i class="fa fa-fw fa-table"></i> Hóa đơn</a>
                    </li>
					<li>
                        <a href="slider.php"><i class="fa fa-fw fa-table"></i> Slider</a>
                    </li>
					<li>
                        <a href="khuyenmai.php"><i class="fa fa-fw fa-table"></i> Khuyến mại</a>
                    </li>
					<li>
                        <a href="thongke.php"><i class="fa fa-fw fa-table"></i> Thống kê</a>
                    </li>
                </ul>
            </div>
</nav>