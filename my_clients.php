<?php include "inc/app-top.php";?>
<?php
    include "inc/admin.php";
    $admins = new Admins();
    
    $client_list = $admins->getClientList();
    $result_list = json_decode($client_list, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Superadmin Dashboard</title>
    <?php include "inc/head.php"; ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include "inc/header.php"; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <?php $sidebar = "my-clients"; ?>
            <?php include "inc/sidebar.php"; ?>

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">My Clients</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Client List</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Client ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Contact No.</th>
                                                <th>Client Type</th>
                                                <th>Registered Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                      $s=1;
                      if($result_list["valid"]){
                       
                          for($i=0; $i<count($result_list["data"]); $i++){
                  ?>
                                            <tr>
                                                <td><?php echo $result_list["data"][$i]["client_id"]; ?></td>
                                                <td><?php echo $result_list["data"][$i]["client_name"]; ?></td>
                                                <td><?php echo $result_list["data"][$i]["client_address"]; ?></td>
                                                <td><?php echo $result_list["data"][$i]["client_number"]; ?></td>
                                                <td>
                                                    <?php 
                            $type = $result_list["data"][$i]["client_type"]; 
                            if ($type == 1){
                                echo '<span class="badge bg-warning">Individual</span>';
                            }
                            else{
                                echo '<span class="badge bg-danger">Company</span>';
                            }
                        ?>
                                                </td>
                                                <td><?php echo $result_list["data"][$i]["createdAt"]; ?></td>

                                                <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modal-editclient"
                                                        data-edit-id="<?php echo $result_list["data"][$i]["client_id"]; ?>"
                                                        class="btn btn-xs btn-primary btn-block btn-edit"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button type="button"
                                                        data-id="<?php echo $result_list["data"][$i]["client_id"]; ?>"
                                                        class="btn btn-xs btn-primary btn-block btn-delete"><i
                                                            class="fas fa-trash-alt "></i></button>
                                                </td>
                                            </tr>
                                            <?php
                      $s++;
                        }
                      }
                  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include "inc/footer.php"; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- EDIT CLIENT MODAL -->
    <div class="modal fade" id="modal-editclient">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" id="editclientform">
                    <div class="modal-body">
                        <div class="card-body">
                            <input type="hidden" id="client_id">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Client Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="client_name"
                                        placeholder="Enter Client Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Client Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="client_email"
                                        placeholder="Enter Client Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Client Phone No.</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="client_phone"
                                        placeholder="Enter Client Phone No.">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Client Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" id="client_address"
                                        placeholder="Enter Client Address"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Client Type</label>
                                <div class="col-sm-10">
                                    <select class="custom-select rounded-0" id="client_type">
                                        <option value="1">Individual</option>
                                        <option value="2">Company</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <?php include "inc/js.php"; ?>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $(document).on("click", ".btn-edit", function() {
            var client_id = $(this).attr("data-edit-id");
            var formData = {
                "action": "getClientData",
                "client_id": client_id
            }
            $.ajax({
                type: "post",
                url: "action.php",
                data: formData,
                dataType: "JSON",
                success: function(result) {
                    $("#modal-editclient").modal("show");
                    // var result_obj = JSON.parse(result);
                    var result_obj = JSON.parse(JSON.stringify(result));
                    //console.log(result_obj);
                    $("#client_id").val(result.client_id);
                    $("#client_name").val(result.client_name);
                    $("#client_address").val(result.client_address);
                    $("#client_email").val(result.client_email);
                    $("#client_phone").val(result.client_number);
                    $("#client_type").val(result.client_type);
                }
            })

        })

        //edit client
        $("#editclientform").submit(false);
        $("#editclientform").on("submit", function() {
            var client_name = $("#client_name").val();
            var client_address = $("#client_address").val();
            var client_email = $("#client_email").val();
            var client_number = $("#client_phone").val();
            var client_id = $("#client_id").val();
            var client_type = $("#client_type").val();
            var formData = {
                "action": "edit_clientdata",
                "client_id": client_id,
                "client_name": client_name,
                "client_address": client_address,
                "client_email": client_email,
                "client_number": client_number,
                "client_type": client_type
            }
            
            $.ajax({
                type: "post",
                url: "action.php",
                data: formData,
                success: function(result) {
                    var result_obj = JSON.parse(result);
                    console.log(result_obj);
                    if (result_obj.valid) {
                        swal({
                            type: "success",
                            title: "Success!",
                            text: result_obj.msg,
                            animation: true
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        swal({
                            type: "error",
                            title: "Oops!",
                            text: result_obj.msg,
                            animation: true
                        }).then(function() {

                        })
                    }
                }
            })

        })

//delete
        $(document).on("click", ".btn-delete", function() {
            
            var client_id = $(this).attr("data-id");
            var formData = {
                "action": "deleteClientData",
                "client_id": client_id
            }

            swal({
                type: "warning",
                title: "Are you sure,",
                text:  "you want to delete this client",
                animation: true,
                showCancelButton: true,
                //confirmButtonColor: '#3085d6',
                //cancelButtonColor: '#dd3',
                confirmButtonText: 'Yes'
            }).then((result) => {

                if( result.value){
                    $.ajax({
                        type: "post",
                        url: "action.php",
                        data: formData,
                        success: function(result) {
                            //swal
                            var result_obj = JSON.parse(result);
                                // var result_obj = JSON.parse(JSON.stringify(result));
                                console.log(result_obj);
                                if (result_obj.valid){
                                    swal({
                                        type : "success",
                                        title : "Success!",
                                        text : result_obj.msg,
                                        animation: true
                                    }).then(function () {
                                        location.reload();
                                    });
                                }
                                else{
                                    swal({
                                        type : "error",
                                        title : "Oops!",
                                        text : result_obj.msg,
                                        animation : true
                                    }).then(function (){
                                        
                                    })
                                }
                }
            })
                }
            })
           

        })
    })
    </script>


</body>

</html>