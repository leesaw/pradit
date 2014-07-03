        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=""><img style="max-width:90px; margin-top: -7px;" src="<?php echo base_url(); ?>images/logo.png"> ระบบจัดการสต๊อกสินค้า</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

				ผู้ใช้งาน :  <strong><?php echo $this->session->userdata('sessfirstname')." ".$this->session->userdata('sesslastname'); ?></strong>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url("main/changepass"); ?>"><i class="fa fa-gear fa-fw"></i> เปลี่ยนรหัสผ่าน</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url("main/logout"); ?>"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                                <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo site_url("main"); ?>"><i class="fa fa-dashboard fa-fw"></i> หน้าแรก</a>
                        </li>
						<?php if ($this->session->userdata('sessstatus') == 1) {?>
						<li>
                            <a href=""><i class="fa fa-usd fa-fw"></i> ซื้อขาย (Buy/Sell)<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="<?php echo site_url("managebill/addbill"); ?>">ออกบิล (Bill)</a>
								</li>
								<li>
									<a href="<?php echo site_url("managebill/addquotation"); ?>">ออกใบเสนอราคา</a>
								</li>
								<li>
                                    <a href="<?php echo site_url("managepurchase/addpurchase"); ?>"> ออกใบสั่งซื้อ</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managebill/historybill"); ?>"> ประวัติบิล</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managebill/historyquotation"); ?>"> ประวัติใบเสนอราคา</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managepurchase/historypurchase"); ?>">ประวัติใบสั่งซื้อ</a>
                                </li>
                            </ul>

                        </li>
						<?php } ?>
						<?php if ($this->session->userdata('sessstatus') == 1 || $this->session->userdata('sessstatus') == 2) {?>
						<li>
                            <a href=""><i class="fa fa-tags fa-fw"></i> คลังสินค้า (Stock)<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="<?php echo site_url("managestock"); ?>">ตรวจสอบจำนวนสินค้า</a>
								</li>
                                <li>
                                    <a href="<?php echo site_url("managestock/importstock"); ?>"> สินค้าเข้าสต็อก</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managestock/exportstock"); ?>">สินค้าออกจากสต็อก</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managestock/historyimportstock"); ?>"> ประวัติสินค้าเข้าสต็อก</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managestock/historyexportstock"); ?>">ประวัติสินค้าออกจากสต็อก</a>
                                </li>
                            </ul>

                        </li>
						<?php } ?>
						<?php if ($this->session->userdata('sessstatus') == 1) {?>
						<li>
                            <a href=""><i class="fa fa-truck fa-fw"></i> สินค้า (Product)<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url("manageproduct"); ?>">จัดการสินค้า</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("manageproduct/addproduct"); ?>">เพิ่มข้อมูลสินค้า</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managecat"); ?>">จัดการประเภทสินค้า</a>
                                </li>
                            </ul>

                        </li>
						<li>
                            <a href=""><i class="fa fa-shopping-cart fa-fw"></i> ข้อมูลลูกค้า (Customer)<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url("managecustomer"); ?>">จัดการข้อมูลลูกค้า</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managecustomer/addcustomer"); ?>">เพิ่มข้อมูลลูกค้า</a>
                                </li>
                            </ul>

                        </li>
						<li>
                            <a href=""><i class="fa fa-suitcase fa-fw"></i>  ข้อมูลผู้จำหน่าย (Supplier) <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url("managesupplier"); ?>">จัดการข้อมูลผู้จำหน่าย </a>
                                </li>
								<li>
                                    <a href="<?php echo site_url("managesupplier/addsupplier"); ?>">เพิ่มข้อมูลผู้จำหน่าย </a>
                                </li>
                            </ul>

                        </li>

                        <li>
                            <a href="<?php echo site_url("manageuser"); ?>"><i class="fa fa-group fa-fw"></i> จัดการผู้ใช้งาน (User)</a>
                        </li>

                        <li>
                            <a href="<?php echo site_url("managebranch"); ?>"><i class="fa fa-map-marker fa-fw"></i> จัดการข้อมูลสาขา (Branch)</a>
                        </li>
						<?php } ?>
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>