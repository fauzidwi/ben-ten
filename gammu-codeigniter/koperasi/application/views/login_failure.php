<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KOPERASI SYARIAH PODOJOYO</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().'assets/ico/logo.ico';?>" />

        <!-- CSS -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css';?>">
        <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css';?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/form-elements.css';?>">
        <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css';?>">


    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>KOPERASI</strong> SYARIAH PODOJOYO</h1>
                            <div class="description">
                            	<p>sistem informasi sms gateway</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3 style="color:red;">Login Gagal, Coba Lagi</h3>
                            		<p>Masukkan username dan password untuk log on :</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="<?php echo base_url().'admin';?>" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                        <button type="submit" class="btn">LOG IN</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?php echo base_url().'assets/js/jquery-1.11.1.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/js/jquery.backstretch.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/js/scripts.js';?>"></script>
        
    </body>

</html>