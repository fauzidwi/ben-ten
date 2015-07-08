<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMIN PANEL</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().'assets/ico/logo.ico';?>" />

    <link href='http://fonts.googleapis.com/css?family=Lato:400,300,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/sb-admin.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/animate.min.css';?>">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img class="animated infinite pulse" src="<?php echo base_url().'assets/img/logo.png';?>" alt="" style="height:250%;margin: -15px;"/></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().'admin/edit_user';?>"><i class="fa fa-fw fa-user"></i> Edit Data User</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url().'admin/logout';?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="#"><i class="fa fa-fw fa-home"></i>  Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/inbox';?>"><i class="fa fa-fw fa-folder-o"><span class="icon_counter icon_counter_red" id="jumlah"></span></i> Inbox</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/outbox';?>"><i class="fa fa-fw fa-folder-open-o"></i>  Outbox</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/send';?>"><i class="fa fa-fw fa-send"></i>  Send SMS</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/nasabah';?>"><i class="fa fa-fw fa-file"></i>  Data Nasabah</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/broadcast';?>"><i class="fa fa-fw fa-cloud-upload"></i>  Broadcast</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div class="special" id="page-wrapper" style="background-image: url('<?php echo base_url().'assets/img/backgrounds/1.jpeg';?>')">  
            <div class="container header-content">
                <div class="row header-content-inner">
                    <h1 class="">sms gateway</h1>
                    <h1>koperasi syariah podojoyo</h1>
                    <p class="">sistem terintegrasi dengan modem sebagai gateway informasi nasabah</p>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
        <script src="<?php echo base_url().'assets/js/jquery-1.11.1.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js';?>"></script>
        <script type="text/javascript">
        function ambilKomentar(){
           $.ajax({
              type: "POST",
              url: "<?php echo base_url().'admin/get_inbox';?>",
              dataType:'json',
              success: function(response){
               $("#jumlah").text(""+response+"");
               timer = setTimeout("ambilKomentar()",5000);
              }
             });  
        }
        $(document).ready(function(){
            var h=$(window).height();    
            function vh( val ) {return  h*val+'px';}
            $('#page-wrapper').css({"height": vh(1)});
            ambilKomentar();
        });       
        </script>
 
</body>

</html>
