

<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<meta charset="utf-8"/>
<title><?php echo $this->config->item('nama_app');?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="<?php echo base_url();?>assets/css/font_css.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/themes/light.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/plugins/sweet-alert2/sweetalert2.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/img/logoi.png" rel="shortcut icon" />
<link href="<?php echo base_url('assets/plugins/data-tables/DT_bootstrap.css')?>" rel="stylesheet" />

<style>

   .rightJustified {
        text-align: right;
    }
    
    .total{
        font-size: 14px;
        font-weight: bold;
        color: blue;
   }
   
.bodycontainer { max-height: 150px; width: 100%; margin: 0; overflow-y: auto; }
.table-scrollable { margin: 0; padding: 0; }

</style>

</head>

<body class="page-header-fixed" onunload="">


<div class="header navbar navbar-fixed-top">
	<div class="header-inner">
		<a class="navbar-brand" href="<?php echo base_url();?>dashboard">
			<img src="<?php echo base_url();?>assets/img/logo.png"   class="img-responsive"/>            
		</a>
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="<?php echo base_url();?>assets/img/menu-toggler.png" alt=""/>			
		</a>		
		
		<ul class="nav navbar-nav pull-right">	
            <!--li class="dropdown" id="header_notification_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-warning"></i>
					<span class="badge">
						 6
					</span>
				</a>
				<ul class="dropdown-menu extended notification">
					<li>
						<p>
							 6 Pemberitahuan
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
									</span>
									 Hutang Jatuh Tempo
									<span class="time">
										 Rp. <?php echo $this->M_global->_hutangjatuhtempo();?>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-warning">
										<i class="fa fa-bell-o"></i>
									</span>
									 Piutang Jatuh Tempo
									<span class="time">
										 22 mins
									</span>
								</a>
							</li>
							
							
							
						</ul>
					</li>
					<li class="external">
						<a href="#">
							 Lihat Semua <i class="m-icon-swapright"></i>
						</a>
					</li>
				</ul>
			</li-->	    
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img alt="" src="<?php echo base_url();?>assets/puser/<?php echo $this->session->userdata('photo');?>" width="40"/>
					
					<span class="username">
						 <?php echo $this->session->userdata('username');?>			                         
					</span>
					<i class="fa fa-angle-down"></i>
				</a>
				
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo base_url();?>master_user_profile">
							<i class="fa fa-user"></i> Profil
						</a>
					</li>
                    <li>
					</li>
					<li class="divider">
					</li>					
					<li>
						<a href="<?php echo base_url()?>app/logout">
							<i class="fa fa-key"></i> Keluar
						</a>
					</li>
				</ul>
			</li>
			
			
		</ul>
	</div>
</div>
<div class="clearfix">
</div>
