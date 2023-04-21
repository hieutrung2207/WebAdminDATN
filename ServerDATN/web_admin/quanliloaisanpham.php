<?php
require '../services/categories-services.php';

$cateService = new CategoriesService();

$response = $cateService->getAllCategories()->getData();

if (isset($_POST["sbmInsert"])) {
    $categoryname = $_POST['categoryname'];
    $result = $cateService->getInsertCategory($categoryname);
    if($result){
        header('Location: ' . $_SERVER['PHP_SELF']); // Reload the page
        exit;
    }
    else{
        echo "Thêm thất bại";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách nhân viên | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/doc/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body onload="time()" class="app sidebar-mini rtl">

    <!-- Navbar-->
    <header class="app-header">
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">


            <!-- User Menu-->
            <li><a class="app-nav__item" href="index.php"><i class='bx bx-log-out bx-rotate-180'></i> </a>

            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">

            <div>
                <img class="app-sidebar__user-avatar" onclick="window.location.href = 'home.php'" src="images/logo_admin.png" width="50px" height="50px">
                <p class="app-sidebar__user-name"><b>Admin</b></p>
                <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
            </div>
        </div>
        <hr>
        <ul class="app-menu">
            <!-- Trang chủ -->
            <li><a class="app-menu__item " href="home.php"><i class='app-menu__icon bx bx-tachometer'></i><span class="app-menu__label">Trang chủ</span></a></li>
            <!-- Quản lí khách hàng -->
            <li><a class="app-menu__item" href="quanlinguoidung.php"><i class='app-menu__icon bx bx-user-voice'></i><span class="app-menu__label">Quản lý khách hàng</span></a></li>
            <!-- Quản lí sản phẩm -->
            <li><a class="app-menu__item " href="quanlisanpham.php"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
            </li>
            <!-- Quản lí loại sản phẩm  -->
            <li><a class="app-menu__item active" href="quanliloaisanpham.php"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý loại sản phẩm</span></a>
            </li>
            <!-- Quản lí hóa đơn -->
            <li><a class="app-menu__item" href="quanlihoadon.php"><i class='app-menu__icon bx bx-task'></i><span class="app-menu__label">Quản lý đơn hàng</span></a></li>
            <!-- Báo cáo doanh thu -->
            <li><a class="app-menu__item " href="quanlidoanhthu.php"><i class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Báo cáo doanh thu</span></a>
            </li>


        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách loại sản phẩm</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">

                                <a data-toggle="modal" data-target="#ModalADD" class="btn btn-add btn-sm" title="Thêm"><i class="fas fa-plus"></i>
                                    Thêm mới</a>
                            </div>



                            <!-- <div class="col-sm-2">
                              <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i
                                  class="fas fa-file-upload"></i> Tải từ file</a>
                            </div>
              
                            <div class="col-sm-2">
                              <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                                  class="fas fa-print"></i> In dữ liệu</a>
                            </div>
                            <div class="col-sm-2">
                              <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button" title="Sao chép"><i
                                  class="fas fa-copy"></i> Sao chép</a>
                            </div>
              
                            <div class="col-sm-2">
                              <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                            </div>
                            <div class="col-sm-2">
                              <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                                  class="fas fa-file-pdf"></i> Xuất PDF</a>
                            </div> -->
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i class="fas fa-trash-alt"></i> Xóa</a>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th width="10"><input type="checkbox" id="all"></th>
                                    <th width="100px">Mã sản phẩm</th>
                                    <th>Tên loại</th>

                                    <th width="150px">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($response as $categories) : ?>
                                    <tr>
                                        <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                        <td id="bookId"><?php echo $categories->getCategoryId() ?></td>
                                        <td><?php echo $categories->getCategoryName() ?></td>

                                        <td>
                                           
                                            <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp" data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i></button>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <!-- <tr>
                  <td width="10"><input type="checkbox" name="check1" value="1"></td>
                  <td>83216008</td>
                  <td>Giường ngủ Tara chân gỗ</td>
                  <td><img src="/img-sanpham/tare.jpg" alt="" width="100px;"></td>
                  <td>65</td>

                  <td>19.600.000 đ</td>
                  <td>Giường người lớn</td>
                  <td><span class="badge bg-success">Còn hàng</span></td>
                  <td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa" onclick="myFunction(this)"><i class="fas fa-trash-alt"></i>
                    </button>
                    <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp" data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i></button>

                  </td>
                </tr> -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--
  MODAL UPDATE
-->
    <div class="modal fade" id="ModalUP" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group  col-md-12">
                            <span class="thong-tin-thanh-toan">
                                <h5>Sửa loại sản phẩm</h5>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">Mã loại</label>
                            <input disabled class="form-control" type="text" required value="">
                        </div>
                        <div class="form-group col-md-9">
                            <label class="control-label">Tên loại</label>
                            <input class="form-control" type="text" required value="">
                        </div>

                    </div>
                    <BR>

                    <div style="display:flex;text-align:center">
                        <div style="flex:1"><button class="btn btn-save" type="button">Sửa</button></div>
                        <div style="flex:1"><a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a></div>
                    </div>
                    <BR>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!--
MODAL
-->

    <!--
  MODAL ADD
-->
    <div class="modal fade" id="ModalADD" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group  col-md-12">
                                <span class="thong-tin-thanh-toan">
                                    <h5>Thêm loại sản phẩm</h5>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">Tên loại</label>
                                <input class="form-control" type="text" required name="categoryname">
                            </div>

                        </div>
                        <div style="display:flex;text-align:center">
                            <div style="flex:1"><button class="btn btn-save" name="sbmInsert" type="submit">Thêm mới</button></div>
                            <div style="flex:1"><a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a></div>
                        </div>
                        <BR>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!--
MODAL
-->

    <!-- Essential javascripts for application to work-->
    <script src="js/doc/jquery-3.2.1.min.js"></script>
    <script src="js/doc/popper.min.js"></script>
    <script src="js/doc/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="src/jquery.table2excel.js"></script>
    <script src="js/doc/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/doc/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/doc/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/doc/plugins/dataTables.bootstrap.min.js"></script>



    <script type="text/javascript">
        $('#sampleTable').DataTable();
        //Thời Gian
        function time() {
            var today = new Date();
            var weekday = new Array(7);
            weekday[0] = "Chủ Nhật";
            weekday[1] = "Thứ Hai";
            weekday[2] = "Thứ Ba";
            weekday[3] = "Thứ Tư";
            weekday[4] = "Thứ Năm";
            weekday[5] = "Thứ Sáu";
            weekday[6] = "Thứ Bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            nowTime = h + " giờ " + m + " phút " + s + " giây";
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = day + ', ' + dd + '/' + mm + '/' + yyyy;
            tmp = '<span class="date"> ' + today + ' - ' + nowTime +
                '</span>';
            document.getElementById("clock").innerHTML = tmp;
            clocktime = setTimeout("time()", "1000", "Javascript");

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
        }
    </script>
    <script>
        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("myTable").deleteRow(i);
        }
        jQuery(function() {
            jQuery(".trash").click(function() {
                swal({
                        title: "Cảnh báo",
                        text: "Bạn có chắc chắn là muốn xóa sản phẩm này?",
                        buttons: ["Hủy bỏ", "Đồng ý"],
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Đã xóa thành công.!", {

                            });
                        }
                    });
            });
        });
        oTable = $('#sampleTable').dataTable();
        $('#all').click(function(e) {
            $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
            e.stopImmediatePropagation();
        });
    </script>
    <script>
        var modal = document.getElementById("myModal"); // Lấy modal
        var btn = document.getElementById("myBtn"); // Lấy nút mở modal
        var span = document.getElementsByClassName("close")[0]; // Lấy nút đóng modal

        // Khi người dùng nhấn nút, mở modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Khi người dùng nhấn nút đóng, đóng modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Khi người dùng nhấn bất kỳ đâu bên ngoài modal, đóng modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


</body>

</html>