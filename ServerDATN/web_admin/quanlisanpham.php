<?php
require '../services/books-services.php';
require '../services/categories-services.php';
require '../services/authors-services.php';
require '../services/publishers-services.php';


$bookService = new BookServices();
$cateService = new CategoriesService();
$authorService = new AuthorsService();
$publisherService = new PublishersService();
$books = $bookService->getAllBooks()->getData();
$cates = $cateService->getAllCategories()->getData();
$authors = $authorService->getAllAuthors()->getData();
$publishers = $publisherService->getAllPublishers()->getData();







$pdo = new DBConfig();
$conn = $pdo->getConnect();

if (isset($_POST['sbmInsert'])) {
  // Lấy dữ liệu từ form
  $title = $_POST['title'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $categoryid = $_POST['categoryid'];
  $authorid = $_POST['authorid'];
  $publisherid = $_POST['publisherid'];
  $imageUrls = $_POST['url'];
  $count = count($imageUrls);

  // Thêm thông tin sách vào bảng tblbooks
  $sql = "INSERT INTO tblbooks (title, price, quantity, categoryid, authorid, publisherid, releasedate, state) VALUES (:title, :price, :quantity, :categoryid, :authorid, :publisherid, now(), 1)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':price', $price);
  $stmt->bindParam(':quantity', $quantity);
  $stmt->bindParam(':categoryid', $categoryid);
  $stmt->bindParam(':authorid', $authorid);
  $stmt->bindParam(':publisherid', $publisherid);
  if ($stmt->execute()) {
    $bookId = $conn->lastInsertId();
    for ($i = 0; $i < $count; $i++) {
      $url = $imageUrls[$i];
      if (!empty($url)) {
        if ($i == 0) {
          $sql = 'insert into tblimages(url,isdefault,bookid) values (:url,1,:bookId)';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':url', $url);
          $stmt->bindParam(':bookId', $bookId);
          $stmt->execute();
          echo $i;
        } else {
          $sql = 'insert into tblimages(url,isdefault,bookid) values (:url,0,:bookId)';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':url', $url);
          $stmt->bindParam(':bookId', $bookId);
          $stmt->execute();
          echo $i;
        }
      }
    }
  }
  header('Location: ' . $_SERVER['PHP_SELF']); // Reload the page
  exit;
}
if (isset($_POST['sbmUpdate'])) {
  // Lấy dữ liệu từ form
  $bookId = $_POST['bookid'];
  $title = $_POST['title'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $categoryid = $_POST['categoryid'];
  $authorid = $_POST['authorid'];
  $publisherid = $_POST['publisherid'];


  // Thêm thông tin sách vào bảng tblbooks
  $sql = "UPDATE tblbooks SET TITLE = :title, PRICE = :price, QUANTITY = :quantity, 
  CATEGORYID = :categoryid, AUTHORID = :authorid, PUBLISHERID = :publisherid where bookId =:bookId";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':bookId', $bookId);

  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':price', $price);
  $stmt->bindParam(':quantity', $quantity);
  $stmt->bindParam(':categoryid', $categoryid);
  $stmt->bindParam(':authorid', $authorid);
  $stmt->bindParam(':publisherid', $publisherid);
  $stmt->execute();
  header('Location: ' . $_SERVER['PHP_SELF']); // Reload the page
  exit;
}

if (isset($_POST['showItem'])) {
  echo "123";
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
      <li><a class="app-menu__item active" href="quanlisanpham.php"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
      </li>
      <!-- Quản lí loại sản phẩm  -->
      <li><a class="app-menu__item " href="quanliloaisanpham.php"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý loại sản phẩm</span></a>
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
        <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
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
                  <th>Tên sản phẩm</th>
                  <th>Ảnh</th>
                  <th>Số lượng</th>

                  <th>Giá tiền</th>
                  <th>Danh mục</th>
                  <th>Tác giả</th>
                  <th>Nhà xuất bản</th>
                  <th>Trạng thái</th>
                  <th width="150px">Chức năng</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($books as $book) : ?>
                  <tr>
                    <td width="10"><input type="checkbox" name="check1" value="1"></td>
                    <td id="bookId"><?php echo $book->getBookid() ?></td>
                    <td><?php echo $book->getTitle() ?></td>
                    <td><img src="<?php
                                  $images = $bookService->getImagesByBookID($book->getBookid())->getData();

                                  foreach ($images as $image) {
                                    if ($image->getIsdefault() == 1) {
                                      echo $image->getUrl();
                                    }
                                  }
                                  ?>" alt="" style="height:100px; width:100px; display:block; margin:auto;"></td>

                    <td><?php echo $book->getQUANTITY() ?></td>

                    <td><?php echo number_format($book->getPrice(), 0, '', '.') . " đ" ?></td>
                    <td><?php echo $bookService->getCategoryName($book->getCategoryId()) ?></td>
                    <td><?php echo $bookService->getauthorname($book->getauthorid()) ?></td>
                    <td><?php echo $bookService->getPublisherName($book->getpublisherid()) ?></td>

                    <td style="text-align:center">
                      <?php if ($book->quantity == 0) : ?>
                        <span class="badge bg-danger">Hết hàng</span>
                      <?php else : ?>
                        <span class="badge bg-success">Còn hàng</span>
                      <?php endif; ?>

                      <br>

                      <div>
                        <div>
                          <input id="showItem_<?php echo $book->getBookid() ?>" name="showItem_<?php echo $book->getBookid() ?>" type="radio" onchange="getStateBook(<?php echo $book->getBookid() ?>,1)"  <?php if($book->getState()==1) echo "checked" ?> />
                          <label for="showItem_<?php echo $book->getBookid() ?>">Show</label>
                        </div>
                        <div>
                          <input id="hideItem_<?php echo $book->getBookid() ?>" name="showItem_<?php echo $book->getBookid() ?>" type="radio" onchange="getStateBook(<?php echo $book->getBookid() ?>,0)"  <?php if($book->getState()==0) echo "checked" ?>/>
                          <label for="hideItem_<?php echo $book->getBookid() ?>">Hide</label>
                        </div>
                      </div>



                    </td>
                    <td>

                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" data-book-id="<?php echo $book->getBookid() ?>" id="show-emp" data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i></button>

                    </td>
                  </tr>
                <?php endforeach; ?>
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

        <form method="POST" action="">
          <div class="modal-body">
            <div class="row">
              <div class="form-group  col-md-12">
                <span class="thong-tin-thanh-toan">
                  <h5>Chỉnh sửa sản phẩm</h5>
                </span>
              </div>
            </div>

            <div class="row">

              <div class="form-group col-md-6">
                <label class="control-label">Tên sản phẩm</label>
                <input class="form-control" type="text" name="title" required>
              </div>
              <div class="form-group  col-md-6">
                <label class="control-label">Số lượng</label>
                <input class="form-control" type="number" name="quantity" required>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Giá bán</label>
                <input class="form-control" type="number" name="price" required>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">Danh mục</label>
                <select class="form-control" id="exampleSelect1" name="categoryid" required>

                  <?php foreach ($cates as $cate) : ?>

                    <option value="<?php echo $cate->getCategoryId() ?>"><?php echo $cate->getCategoryName() ?></option>

                  <?php endforeach ?>


                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">Tác giả</label>
                <select class="form-control" id="exampleSelect1" name="authorid" required>

                  <?php foreach ($authors as $author) : ?>

                    <option value="<?php echo $author->getauthorid() ?>"><?php echo $author->getAuthorName() ?></option>

                  <?php endforeach ?>


                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">Nhà xuất bản</label>
                <select class="form-control" id="exampleSelect1" name="publisherid" required>

                  <?php foreach ($publishers as $publisher) : ?>

                    <option value="<?php echo $publisher->getpublisherid() ?>"><?php echo $publisher->getPublisherName() ?></option>

                  <?php endforeach ?>


                </select>
              </div>
              <div class="form-group col-md-6">

                <input class="form-control" type="hidden" name="bookid" required>
              </div>
             
            </div>
            <BR>
            <div style="display:flex">
              <div style="flex: 1;text-align:center"> <button name="sbmUpdate" class="btn btn-save" type="submit">Lưu lại</button></div>
              <div style="flex: 1;text-align:center"><a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a></div>
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
                  <h5>Thêm sản phẩm</h5>
                </span>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label">Tên sản phẩm</label>
                <input class="form-control" type="text" name="title" required>
              </div>
              <div class="form-group  col-md-6">
                <label class="control-label">Số lượng</label>
                <input class="form-control" type="number" name="quantity" required>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Giá bán</label>
                <input class="form-control" type="number" name="price" required>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">Danh mục</label>
                <select class="form-control" id="exampleSelect1" name="categoryid" required>

                  <?php foreach ($cates as $cate) : ?>

                    <option value="<?php echo $cate->getCategoryId() ?>"><?php echo $cate->getCategoryName() ?></option>

                  <?php endforeach ?>


                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">Tác giả</label>
                <select class="form-control" id="exampleSelect1" name="authorid" required>

                  <?php foreach ($authors as $author) : ?>

                    <option value="<?php echo $author->getauthorid() ?>"><?php echo $author->getAuthorName() ?></option>

                  <?php endforeach ?>


                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleSelect1" class="control-label">Nhà xuất bản</label>
                <select class="form-control" id="exampleSelect1" name="publisherid" required>

                  <?php foreach ($publishers as $publisher) : ?>

                    <option value="<?php echo $publisher->getpublisherid() ?>"><?php echo $publisher->getPublisherName() ?></option>

                  <?php endforeach ?>


                </select>
              </div>
              <div class="form-group col-md-12" style="margin: 5px;">
                <label class="control-label">Hình ảnh</label><br>
                <div style="text-align: center;">
                  <img id="image-preview" src="" width="200px" height="200px"><br>
                </div>
                <div class="form-group col-md-8" style="margin:5px">
                  <div id="url-inputs">
                    <div class="url-input">
                      <label>Image: </label>
                      <input name="url[]" type="url" onblur="previewImage(this)">
                      <label style="font-size: 14px; color: gray; text-align: center; font-style: italic;">*default</label>
                    </div>

                  </div>

                  <a class="btn btn-sm" type="button" onclick="addUrlInput()">Thêm ảnh...</a>
                </div>
              </div>
            </div>
            <BR>
            <div style="display:flex">
              <div style="flex: 1;text-align:center"> <button name="sbmInsert" class="btn btn-save" type="submit">Thêm mới</button></div>
              <div style="flex: 1;text-align:center"><a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a></div>
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
      jQuery(".edit").click(function() {
        var bookId = $(this).data('book-id');

        $.ajax({
          url: '../services/getBookById.php',
          type: 'POST',
          data: {
            bookId: bookId
          },
          dataType: "json",

          success: function(response) {
            // Set giá trị của title từ dữ liệu lấy được
            console.log(bookId);
            console.log(response);

            $("input[name='title']").val(response.TITLE);
            $("input[name='quantity']").val(response.QUANTITY);
            $("input[name='price']").val(response.PRICE);
            $("input[name='bookid']").val(response.BOOKID);

            $("select[name='categoryid']").val(response.CATEGORYID);
            $("select[name='authorid']").val(response.AUTHORID);
            $("select[name='publisherid']").val(response.PUBLISHERID);




          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        })

      });
    });
    oTable = $('#sampleTable').dataTable();
    $('#all').click(function(e) {
      $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
      e.stopImmediatePropagation();
    });
  </script>
  <script>
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);
    }
    jQuery(function() {
      jQuery(".trash").click(function() {
        var bookId = $(this).data('book-id');
        swal({
            title: "Cảnh báo",
            text: "Bạn có chắc chắn là muốn xóa sản phẩm này?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                type: "POST",
                url: "../services/deleteBook.php",
                data: {
                  bookId: bookId
                },
                success: function() {
                  swal("Xóa thành công", "Bạn đã xóa sản phẩm ra khỏi danh sách", "success").then(() => {
                    location.reload();
                  });
                }
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
  <script>
    function previewImage(input) {
      // Lấy giá trị từ input đầu tiên
      var firstInput = document.querySelector('#url-inputs .url-input:first-child input');
      var imageUrl = firstInput.value;

      // Hiển thị hình ảnh trên thẻ img
      var imagePreview = document.getElementById("image-preview");
      imagePreview.src = imageUrl;
    }

    function addUrlInput() {
      var urlInputs = document.getElementById("url-inputs");
      var urlInput = document.createElement("div");
      urlInput.classList.add("url-input");
      urlInput.innerHTML = '<label>Image: </label><input style="margin-left:3px" name="url[]" type="url"/>';
      urlInputs.appendChild(urlInput);
    }

    function getStateBook(bookId, state) {
      $.ajax({
        type: "POST",
        url: "../services/changeStateBookAllow.php",
        data: {
          bookId: bookId,
          state: state
        },
        success: function(data) {
          console.log(bookId);
        

        }
      });
    }
  </script>

</body>

</html>