<?php

$active = "user";
require_once "includes/headerAndSide.php";

if (!isset($_SESSION["user_id"])) {
  header("location: login.php");
  exit();
}

require_once "functions/connect.php";
$result = $conn->query("SELECT * FROM user WHERE id = '$_SESSION[user_id]'");
$query = $result->fetch_assoc();

?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Users <span style="font-size: 18px;color: #888;"> / <?= $query["priv"] == 1 ? "User" : "Admin" ?></span></h1>

  <!-- DataTales Example -->
  <?php include_once "design/user_table.php"; ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Your Website 2020</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<!-- Get all countries from JSON file -->
<script>
  /* ===============================================================
   COUNTRY SELECT BOX FILLING
  =============================================================== */
  $.getJSON('../js/countries.json', function(data) {
    $.each(data, function(key, value) {
      var selectOption = "<option value='" + value.name + "' data-dial-code='" + value.dial_code + "'>" + value.name + "</option>";
      $("select.country").append(selectOption);
    });
  })
</script>
<!-- my script for users -->
<script>
  var log = console.log;

  // wards in modal
  function funcDelete(id, name, priv) {
    $(".modal-user .modal-body span:first").text(priv);
    $(".modal-user .modal-body span:nth-child(2)").text(name);
    $("#deleteVal").data("id", id);
  }

  // edit user from table to form
  // قم بالحصول علي البيانات من الداتابيز
  function funcEdit(id) {
    $("#submit_user_edit").data("id", id);
    $(`#modalEdit form input[type=radio]`).each(function() {
      $(this).removeAttr("checked");
    })
    $(`#modalEdit form select[name=priv] option`).each(function() {
      $(this).removeAttr("selected");
    })
    $.post(`functions/Database_read.php?id=${id}`, {}, function(data) {
      // let test = Object.keys(JSON.parse(data)).map(function(value, i, array) {
      //   log(Object.keys(JSON.parse(data))[i])
      // log(Object.values(JSON.parse(data))[i])
      // })
      let keys = Object.keys(JSON.parse(data));
      let values = Object.values(JSON.parse(data));
      for (let i = 1; i < keys.length; i++) {
        if (keys[i] != "priv" &&
          keys[i] != "image" &&
          keys[i] != "password" &&
          keys[i] != "gender") {
          $(`#modalEdit form [name=${keys[i]}]`).val(values[i]);
        }
      }
      $(`#modalEdit form input[type=radio]`).each(function() {
        JSON.parse(data)["gender"] == $(this).val() ? $(this).attr("checked", "") : "";
      })
      $(`#modalEdit form select[name=priv] option`).each(function() {
        JSON.parse(data)["priv"] == $(this).val() ? $(this).attr("selected", "") : "";
      })
      $(`#modalEdit form .test`).text(values[9]);
      $(`#modalEdit form #img`).attr("src", 'img/' + values[8]);
    })
  }

  // delete user & close modal & remove <tr> row
  function deleteVal(e) {
    $.post(`functions/userDelete.php?id=${e}`, {}, function() {
      $(".modal-user .modal-footer button:first").click();
      $(`table tbody tr#${e}`).remove();
    })
  }

  var bool = false;
  // remove class checked from all input radio
  // make color red if is empty
  $("input[type=radio]").each(function() {
    bool = false;

    // remove class checked on load
    $(this).removeClass("checked");
    $(this).click(function() {
      bool = true;
      // remove class checked on click
      $("input[type=radio]").each(function() {
        $(this).removeClass("checked");
      });

      // add class checked on click
      $(this).addClass("checked");
    })
  })

  // create new user
  $(".add_user_modal").submit(function(e) {
    e.preventDefault();

    let newObj = {};
    let countObj = 0;
    let countInp = 0;
    $(`
      .add_user_modal input[name]:not(input[type=radio]):not(input[type=file]),
      .add_user_modal textarea,
      .add_user_modal select[name],
      .add_user_modal .checked
    `).each(function() {
      countInp++;
      if ($(this).val() != "") {
        countObj++;
        newObj[$(this).attr("name")] = $(this).val();
        // black
        $(this).css("border", "1px solid #d1d3e2");
      } else {
        // red
        $(this).css("border", "1px solid #ffb4b4");
      }
      if (bool) {
        $(".style_gender").css("color", "#d1d3e2");
      } else {
        $(".style_gender").css("color", "#ffb4b4");
      }
    })

    if (countInp == countObj) {
      log("true count");
      // $.post("functions/create_user.php", newObj, function(data) {
      $.ajax({
        url: "functions/create_user.php",
        method: "post",
        data: new FormData(this),
        success(data) {
          log(data);
          if (data.includes("success")) {

            // للحصول علي المعلومات التاليه success تقطيع القيم اللتي بعد ال
            let id = data.split("=")[1].split(",")[0],
              name = data.split("=")[1].split(",")[1],
              priv = data.split("=")[1].split(",")[2],
              img = data.split("=")[1].split(",")[3];
            // log(id);
            // log(name);
            // log(priv);
            // log(img);
            $(`
            .add_user_modal input[name]:not(input[type=file]),
            .add_user_modal textarea,
            .add_user_modal select[name]
            `).each(function() {
              $(this).val("");
            });
            $(".add_user_modal .checked").removeClass("checked");
            $("img#imgV").attr("src", "");

            // close the modal
            $("button[data-dismiss=modal]").click();

            // if the data is true "print"
            $(`table tbody`).append(`
            <tr id=${id}>
              <td>${$("table tbody").children().length + 1}</td>
              <td><img src='img/${img}' alt="user_image" style="width: 50px;height: 50px;border-radius: 50%;box-shadow: 0 0 2px #888" /></td>
              <td>${newObj.username}</td>
              <td>${newObj.address_1}</td>
              <td>${newObj.address_2}</td>
              <td>${newObj.country}</td>
              <td>${newObj.county}</td>
              <td>${newObj.city}</td>
              <td>${newObj.phone}</td>
              <td>${newObj.email}</td>
              <td>${newObj.priv == 0 ? "Admin" : "user" }</td>
              <td>${newObj.gender == 0 ? "mail" : "female"}</td>
              <td>
                <button class="btn btn-primary btn-sm w-100" data-toggle="modal" data-target="#modalEdit" onclick="funcEdit(${id})" data-whatever="@mdo">Edit</button>
                <a type="button" class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#model" onclick="funcDelete($(this).data('id'), $(this).data('name'), $(this).data('priv'))" data-id="${id}" data-name="${name}" data-priv="${priv == 0 ? "Admin" : "user"}">
                  delete
                </a>
              </td>
            </tr>`);

          } else if (data.includes("user_exists")) {
            $(".add_user_modal input[type=email]").css("border", "1px solid #ffb4b4");
          } else if (data.includes("error_image")) {
            // if img has error
            if (data.split("=")[1] = "1") {
              $(".add_user_modal input[type=file]").css("border", "1px solid #ffb4b4");
              $(".img_error_div").text(data.split("=")[2]);
            } else if (data.split("=")[1] = "2") {
              $(".add_user_modal input[type=file]").css("border", "1px solid #ffb4b4");
              $(".img_error_div").text(data.split("=")[2]);
            }
          }
        },
        processData: false,
        contentType: false
      })
    }

    // let formData = new FormData($(this)[0]);
    // formData.append('file', $("input[type=file]")[0].files[0]);
    // log(formData);
    // $.ajax({
    //   url: "functions/create_user.php",
    //   method: "POST",
    //   data: formData,
    //   success: function (data) {
    //     log(data)
    //   }
    // })


  })

  // edit old user 
  $("#submit_user_edit").submit(function(e) {

    e.preventDefault();
    log($("#submit_user_edit").data("id"))
    let newObj = {};
    let countObj = "";
    let countInp = 0;
    $(`
      #submit_user_edit input[name]:not(input[type=radio]):not(input[type=file]):not(input[type=password]),
      #submit_user_edit textarea,
      #submit_user_edit select[name],
      #submit_user_edit .checked
    `).each(function() {
      countInp++;
      if ($(this).val() != "") {
        countObj++;
        newObj[$(this).attr("name")] = $(this).val();
        // black
        $(this).css("border", "1px solid #d1d3e2");
      } else {
        // red
        $(this).css("border", "1px solid #ffb4b4");
      }
      if (bool) {
        $(".style_gender").css("color", "#d1d3e2");
      } else {
        $(".style_gender").css("color", "#ffb4b4");
      }
    })

    if (countInp == countObj) {
      $.ajax({
        url: `functions/userEdit.php?id=${$(this).data("id")}`,
        method: "post",
        data: new FormData(this),
        success(data) {
          console.log(data)
          if (data.includes("success")) {

            // للحصول علي المعلومات التاليه success تقطيع القيم اللتي بعد ال
            let id = data.split("=")[1].split(",")[0],
              name = data.split("=")[1].split(",")[1],
              priv = data.split("=")[1].split(",")[2];

            // close the modal
            $("button[data-dismiss=modal]").click();

            // if the data is true "print"
            if (!data.includes("no_image")) {
              log("image exists")
              let img = data.split("=")[1].split(",")[3];
              $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(2) img`).attr("src", "img/" + img);
            }

            // test ...
            // for (let i = 2; i < 10; i++) {
            //   newObj[$(this).attr("name")]
            //   $(`table tbody tr#${$(this).data("id")} td`)[2].innerText(newObj.username);
            // }

            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(3)`).text(newObj.username);
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(4)`).text(newObj.address_1);
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(5)`).text(newObj.address_2);
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(6)`).text(newObj.country);
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(7)`).text(newObj.county);
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(8)`).text(newObj.city);
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(9)`).text(newObj.phone);
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(10)`).text(newObj.email);
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(11)`).text(newObj.priv == 0 ? "Admin" : "user");
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(12)`).text(newObj.gender == 0 ? "mail" : "female");
            $(`table tbody tr#${$("#submit_user_edit").data("id")} td:nth-child(13)`).html(`
              <a href="?action=edit&id=${id}" class="btn btn-primary btn-sm w-100">edit</a>
              <a type="button" class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#model" onclick="funcDelete($(this).data('id'), $(this).data('name'), $(this).data('priv'))" data-id="${id}" data-name="${name}" data-priv="${priv == 0 ? "Admin" : "user"}">delete</a>
            `);
            // $(`table tbody`).append(`
            // <tr id=${id}>
            //   <td>${$("table tbody").children().length + 1}</td>
            //   <td></td>
            //   <td>${}</td>
            //   <td>${newObj.address_1}</td>
            //   <td>${newObj.address_2}</td>
            //   <td>${newObj.country}</td>
            //   <td>${newObj.county}</td>
            //   <td>${newObj.city}</td>
            //   <td>${newObj.phone}</td>
            //   <td>${newObj.email}</td>
            //   <td>${newObj.priv == 0 ? "Admin" : "user" }</td>
            //   <td>${newObj.gender == 0 ? "mail" : "female"}</td>
            // </tr>`);

          } else if (data.includes("user_exists")) {
            $("#submit_user_edit input[type=email]").css("border", "1px solid #ffb4b4");
          } else if (data.includes("error_image")) {
            // if img has error
            if (data.split("=")[1] == "1") {
              $("#submit_user_edit input[type=file]").css("border", "1px solid #ffb4b4");
              $(".img_error_div_edit").text(data.split("=")[2]);
            } else if (data.split("=")[1] == "2") {
              $("#submit_user_edit input[type=file]").css("border", "1px solid #ffb4b4");
              $(".img_error_div_edit").text(data.split("=")[2]);
            }
          }
        },
        processData: false,
        contentType: false
      })
    }
  })
</script>
</body>

</html>