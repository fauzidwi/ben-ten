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
    <style>
    .portfolio-modal .modal-content {
    padding: 100px 0;
    min-height: 100%;
    border: 0;
    border-radius: 0;
    background-clip: border-box;
    -webkit-box-shadow: none;
    box-shadow: none;
    }

    .portfolio-modal .modal-content h2 {
        margin: 0;
        font-size: 3em;
    }

    .portfolio-modal .modal-content img {
        margin-bottom: 30px;
    }

    .portfolio-modal .modal-content .item-details {
        margin: 30px 0;
    }

    .portfolio-modal .close-modal {
        position: absolute;
        top: 25px;
        right: 25px;
        width: 75px;
        height: 75px;
        background-color: transparent;
        cursor: pointer;
    }

    .portfolio-modal .close-modal:hover {
        opacity: .3;
    }

    .portfolio-modal .close-modal .lr {
        z-index: 1051;
        width: 1px;
        height: 75px;
        margin-left: 35px;
        background-color: #2c3e50;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .portfolio-modal .close-modal .lr .rl {
        z-index: 1052;
        width: 1px;
        height: 75px;
        background-color: #2c3e50;
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    </style>
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
            ambilKomentar();
        }); 
        $(document).ready(function() {
                $('.input-group input[required], .input-group textarea[required], .input-group select[required]').on('keyup change', function() {
                    var $form = $(this).closest('form'),
                        $group = $(this).closest('.input-group'),
                        $addon = $group.find('.input-group-addon'),
                        $icon = $addon.find('span'),
                        state = false;
                        
                    if (!$group.data('validate')) {
                        state = $(this).val() ? true : false;
                    }else if ($group.data('validate') == "length") {
                        state = $(this).val().length < $group.data('length') ? true : false;
                    }else if($group.data('validate') == 'phone') {
                      state = /^[0-9]+$/.test($(this).val())
                    }else if ($group.data('validate') == "number") {
                      state = !isNaN(parseFloat($(this).val())) && isFinite($(this).val());
                    }

                    if (state) {
                            $addon.removeClass('danger');
                            $addon.addClass('success');
                            $icon.attr('class', 'glyphicon glyphicon-ok');
                    }else{
                            $addon.removeClass('success');
                            $addon.addClass('danger');
                            $icon.attr('class', 'glyphicon glyphicon-remove');
                    }
                    
                    if ($form.find('.input-group-addon.danger').length == 0) {
                        $form.find('[type="submit"]').prop('disabled', false);
                    }else{
                        $form.find('[type="submit"]').prop('disabled', true);
                    }
                });
                
                $('.input-group input[required], .input-group textarea[required], .input-group select[required]').trigger('change');        
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
                    <li>
                        <a href="#"><i class="fa fa-fw fa-folder-o"><span class="icon_counter icon_counter_red" id="jumlah"></span></i> Inbox</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/outbox';?>"><i class="fa fa-fw fa-folder-open-o"></i>  Outbox</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/send';?>"><i class="fa fa-fw fa-send"></i>  Send SMS</a>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-fw fa-file"></i>  Data Nasabah</a>
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
                        <h4>Data Nasabah</h4>
                        <div class="table-responsive">                                    
                            <table id="myTable" class="table table-bordred table-striped">
                                <thead><th>No-REK</th>
                                       <th>Nama</th>
                                       <th>Alamat</th>
                                       <th>No-TELP</th>
                                       <th>Saldo</th>
                                       <th><a href="#Daftar" class="btn btn-success btn-sm" data-toggle="modal">TAMBAH DATA <span class="glyphicon glyphicon-plus"></span></a></th>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $key) { ?>                                    
                                <tr>
                                <td><?php echo $key['id'];?></td>
                                <td><?php echo $key['nama'];?></td>
                                <td><?php echo $key['alamat'];?></td>
                                <td><?php echo $key['no_telp'];?></td>
                                <td><?php echo $key['saldo'];?></td>
                                <td style="display:inline;">
                                <a href="<?php echo base_url().'admin/edit_member/'.$key['id'];?>" class="btn btn-primary btn-xs" data-placement="top" data-toggle="tooltip" title="Ubah" style="margin-top:5%;"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="<?php echo base_url().'admin/delete_member/'.$key['id'];?>" class="btn btn-danger btn-xs" data-placement="top" data-toggle="tooltip" title="Hapus"Style="margin-top:5%;"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
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
    <div class="portfolio-modal modal fade" id="Daftar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">   
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                    <form method="post" data-toggle="validator" role="form" action="<?php echo base_url().'admin/add_member';?>">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="inputNama" id="inputNama" placeholder="Nama Lengkap" required>
                        <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputKursus">Tanggal Lahir</label>
                      <div class="input-group">
                        <input type="date" class="form-control" name="bday" id="inputBrithday" placeholder="yyyy-mm-dd" required>
                        <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="inputAlamat" id="inputAlamat" placeholder="Alamat Lengkap" required>
                        <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="inputTelp" id="inputTelp" placeholder="No HP (+628xxxxxxxx)" required>
                        <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group" data-validate="number">
                        <input type="text" class="form-control" name="inputSaldo" id="inputSaldo" placeholder="Jumlah Saldo" required>
                        <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                      </div>
                    </div>
                    <div class="form-group">     
                    <button type="submit" class="btn btn-primary col-xs-12"><h5>Submit</h5></button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
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
