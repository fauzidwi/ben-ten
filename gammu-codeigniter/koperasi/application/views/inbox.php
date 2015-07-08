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
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/sb-admin.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/animate.min.css';?>">
    <script src="<?php echo base_url().'assets/js/jquery-1.11.1.min.js';?>"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js';?>"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
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
            $('#myTable').DataTable();
            $(function () { $("[data-toggle='tooltip']").tooltip(); });
            $('#page-wrapper').css({"height": vh(1)});
            ambilKomentar();
        });       
    </script>    
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
                    <li>
                        <a href="<?php echo base_url().'admin/dashboard';?>"><i class="fa fa-fw fa-home"></i>  Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-fw fa-folder-o"><span class="icon_counter icon_counter_red" id="jumlah"></span></i> Inbox</a>
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

        <div id="page-wrapper">
            <div class="container-fluid">  
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Daftar Pesan Masuk</h4>
                        <div class="table-responsive">                                    
                            <table id="myTable" class="table table-bordred table-striped">
                                <thead><th>No</th>
                                       <th>No Pengirim</th>
                                       <th>Pesan</th>
                                       <th>Tanggal</th>
                                       <th>Balas</th>
                                       <th>Hapus</th>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $key) { ?>                                    
                                <tr>
                                <td><?php echo $key['ID'];?></td>
                                <td><?php echo $key['SenderNumber'];?></td>
                                <td><?php echo $key['TextDecoded'];?></td>
                                <td><?php $date=date_create($key['ReceivingDateTime']);echo date_format($date, 'jS F Y'); ?></td>
                                <td><p><a href="<?php echo base_url().'admin/reply_inbox/'.$key['ID'];?>" class="btn btn-primary btn-xs" data-placement="top" data-toggle="tooltip" title="Balas"><span class="glyphicon glyphicon-pencil"></span></a></p></td>
                                <td><p><a href="<?php echo base_url().'admin/delete_inbox/'.$key['ID'];?>" class="btn btn-danger btn-xs" data-placement="top" data-toggle="tooltip" title="Hapus"><span class="glyphicon glyphicon-trash"></span></a></p></td>
                                </tr>  
                                <?php }?>        
                                </tbody>      
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

        <!--<script type="text/javascript">
        $(function() {
            var h=$(window).height();    
            function vh( val ) {return  h*val+'px';}
            $('#page-wrapper').css({"height": vh(1)});
        });
        </script>-->
 
</body>

</html>
