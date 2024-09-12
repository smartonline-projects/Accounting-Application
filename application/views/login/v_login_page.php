
<html lang="en" class="no-js">
<head>
<meta charset="utf-8"/>
<title><?php echo $this->config->item('nama_app');?></title>
<link rel="shortcut icon" href="logoi.png"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="<?php echo base_url('assets/css/font_css.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/plugins/select2/select2.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/plugins/select2/select2-metronic.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/style-metronic.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/style-responsive.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/plugins.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/themes/blue.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/pages/login-soft.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/custom.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/img/logoi.png');?>" rel="shortcut icon" />
<link href="<?php echo base_url('assets/plugins/gritter/css/jquery.gritter.css');?>" rel="stylesheet" type="text/css"/>



</head>

<body class="login" onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">



<div class="logo">
	<a href="<?php echo base_url();?>">
		<img src="<?php echo base_url('assets/img/logo_login.png');?>" width="250" alt=""/>
	</a>
</div>

<div class="content">

	<form id="frmlogin" class="login-form"  action="<?php echo base_url('app/auth');?>" method="post">
		<h3 class="form-title">Login </h3>
		<!--div class="alert alert-danger alert-dismissable">
			   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			   <?php echo $this->session->flashdata('result_login'); ?>
		</div-->		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Nama</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Nama" id="username" name="username" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="password" name="password" required/>
			</div>
		</div>
		<div class="form-actions">            
			
			<button type="submit" class="btn blue pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
			<?php echo '<label class="label label-sm label-warning">' . $this->session->flashdata( "result_login" ) . '</label>';?>
		</div>
	</form>
	
</div>

<div class="copyright">     
	 <?php echo $this->config->item('name_app');?>
</div>

<script src="<?php echo base_url('assets/plugins/jquery-1.10.2.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-migrate-1.2.1.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.cokie.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/uniform/jquery.uniform.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/backstretch/jquery.backstretch.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/select2/select2.min.js');?>" type="text/javascript" ></script>
<script src="<?php echo base_url('assets/scripts/core/app.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/scripts/custom/ui-general.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/gritter/js/jquery.gritter.js');?>" type="text/javascript" ></script>


<?php if ( $this->session->flashdata('ntf1')) {?>
	<script type="text/javascript">
		$.gritter.add( {
			title: '<b><?php echo 'Informasi Login'?></b>',
			text: '<?php echo $this->session->flashdata('ntf1'); ?>',
			image: '<?php echo base_url('assets/img/logoi.png');?>',
			class_name: 'color-success'
		} );
	</script>
	<?php }?>
	<?php if ( $this->session->flashdata('ntf2')) {?>
	<script type="text/javascript">
		$.gritter.add( {
			title: '<b><?php echo 'Informasi Login'?></b>',
			text: '<?php echo $this->session->flashdata('ntf2'); ?>',
			class_name: 'color-primary'
		} );
	</script>
	<?php }?>
	<?php if ( $this->session->flashdata('ntf3')) {?>
	<script type="text/javascript">
		$.gritter.add( {
			title: '<b><?php echo 'Informasi Login'?></b>',
			text: '<?php echo $this->session->flashdata('ntf3'); ?>',
			class_name: 'color-warning'
		} );
	</script>
	<?php }?>
	<?php if ( $this->session->flashdata('ntf4')) {?>
	<script type="text/javascript">
		$.gritter.add( {
			title: '<b><?php echo 'Informasi Login'?></b>',
			text: '<?php echo $this->session->flashdata('ntf4'); ?>',
			class_name: 'color-danger'
		} );
	</script>
	<?php }?>
	
<SCRIPT type="text/javascript">
    
	var Login = function () {
   
	var handleLogin = function() {
		$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                remember: {
	                    required: false
	                }
	            },

	            messages: {
	                username: {
	                    required: "Nama Harus Diisi."
	                },
	                password: {
	                    required: "Password Harus Diisi."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

         $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.login-form').validate().form()) {
	                    $('.login-form').submit();
	                }
	                return false;
	            }
	        });
	}
	 return {
        init: function () {
			//handleLogin();
           	$.backstretch([
		        "<?php echo base_url();?>assets/img/bg/1.jpg",
		        "<?php echo base_url();?>assets/img/bg/2.jpg",
		        "<?php echo base_url();?>assets/img/bg/3.jpg",
		        "<?php echo base_url();?>assets/img/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		    });
        }

    };

}();

	
	
    window.history.forward();
    function noBack() { window.history.forward(); }
    
    var isCtrl = false;
    document.onkeyup=function(e)
    {
        if(e.which == 17)
        isCtrl=false;
    }
    document.onkeydown=function(e)
    {
        if(e.which == 17)
        isCtrl=true;
        if((e.which == 85 && isCtrl == true) || (e.which == 67 && isCtrl == true))
        {
            return false;
        }
    }


    var isNS = (navigator.appName == "Netscape") ? 1 : 0;
    if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
    function mischandler(){
        return false;
    }
    function mousehandler(e){
        var myevent = (isNS) ? e : event;
        var eventbutton = (isNS) ? myevent.which : myevent.button;
        if((eventbutton==2)||(eventbutton==3)) return false;
    }
    document.oncontextmenu = mischandler;
    document.onmousedown = mousehandler;
    document.onmouseup = mousehandler;
    
    history.pushState(null, document.title, location.href);
    window.addEventListener('popstate', function (event)
    {
      history.pushState(null, document.title, location.href);
    });
	
	

	jQuery(document).ready(function() {
		  App.init();
		  Login.init();
		
		  UIGeneral.init();
		  
		  
		});		
 
    
   
		

    
</SCRIPT>
	
</body>
</html> 