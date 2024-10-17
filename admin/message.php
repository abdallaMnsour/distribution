<?php
$active = "message";
include_once "includes/headerAndSide.php";

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Message <span style="font-size: 18px;color: #888;"> / <?= $query["priv"] == 1 ? "User" : "Admin" ?></span></h1>

  <!-- DataTales Example -->

  <!-- Modal -->
  <div class="modal-message-read modal fade" id="modal_message_read" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Message from 
            <span style="font-weight: bold"></span>
            <span class="text-primary"></span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal-message-delete modal fade" id="modal_message_delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          are you sure you want to remove message from
          <span style="font-weight: bold"></span>
          <span class="text-danger"></span>
          ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a type="button" class="btn btn-danger" id="deleteVal" onclick="deleteMessage($(this).data('id'))" data-id="">Confirm</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Username</th>
              <!-- <th>Address_1</th> -->
              <!-- <th>Address_2</th> -->
              <!-- <th>country</th> -->
              <!-- <th>county</th> -->
              <!-- <th>city</th> -->
              <th>Phone</th>
              <th>Email</th>
              <th>Privileges</th>
              <th>Gender</th>
              <th>Control</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Username</th>
              <!-- <th>Address_1</th> -->
              <!-- <th>Address_2</th> -->
              <!-- <th>country</th> -->
              <!-- <th>county</th> -->
              <!-- <th>city</th> -->
              <th>Phone</th>
              <th>Email</th>
              <th>Privilege</th>
              <th>Gender</th>
              <th>Control</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $myId = 0;
            require_once "functions/connect.php";
            $messages = $conn->query("SELECT * FROM message WHERE isRead = 0");

            foreach ($messages as $message) :
              $user = $conn->query("SELECT * from user WHERE id = '$message[user_id]'")->fetch_assoc();
            ?>
              <tr id="<?= $message["id"] ?>">
                <td><?= ++$myId ?></td>
                <td><img src="img/<?= $user["image"] ?>" alt="user_image" style="width: 50px;height: 50px;border-radius: 50%;box-shadow: 0 0 2px #888"></td>
                <td><?= $user["username"] ?></td>
                <!-- <td><?= $user["address_1"] ?></td> -->
                <!-- <td><?= $user["address_2"] ?></td> -->
                <!-- <td><?= $user["country"] ?></td> -->
                <!-- <td><?= $user["county"] ?></td> -->
                <!-- <td><?= $user["city"] ?></td> -->
                <td><?= $user["phone"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["priv"] == 0 ? "Admin" : "user" ?></td>
                <td><?= $user["gender"] == 0 ? "mail" : "female" ?></td>
                <td>
                <a class="btn btn-primary btn-sm w-100" data-toggle="modal" data-target="#modal_message_read" onclick="funcReadMessage('<?= $message['message'] ?>', '<?= $user['username'] ?>', '<?= $user['priv'] == 0 ? 'Admin' : 'user' ?>', <?= $message['id']?>)">read</a>
                  <!-- <?php // if ($user["id"] == $_SESSION["user_id"]) { 
                        ?> -->
                  <!-- special user modal -->
                  <!-- <?php // } else { 
                        ?> -->
                  <a type="button" class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#modal_message_delete" onclick="funcDeleteMessage(<?= $message['id'] ?>, '<?= $user['username'] ?>', '<?= $user['priv'] == 0 ? 'Admin' : 'user' ?>')">
                    delete
                  </a>
                  <!-- <?php // } 
                        ?> -->

                </td>
              </tr>
            <?php endforeach;
            $messages = $conn->query("SELECT * FROM message WHERE isRead = 1");

            foreach ($messages as $message) :
              $user = $conn->query("SELECT * from user WHERE id = '$message[user_id]'")->fetch_assoc();
            ?>
              <tr id="<?= $message["id"] ?>">
                <td><?= ++$myId ?></td>
                <td><img src="img/<?= $user["image"] ?>" alt="user_image" style="width: 50px;height: 50px;border-radius: 50%;box-shadow: 0 0 2px #888"></td>
                <td><?= $user["username"] ?></td>
                <!-- <td><?= $user["address_1"] ?></td> -->
                <!-- <td><?= $user["address_2"] ?></td> -->
                <!-- <td><?= $user["country"] ?></td> -->
                <!-- <td><?= $user["county"] ?></td> -->
                <!-- <td><?= $user["city"] ?></td> -->
                <td><?= $user["phone"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["priv"] == 0 ? "Admin" : "user" ?></td>
                <td><?= $user["gender"] == 0 ? "mail" : "female" ?></td>
                <td>
                  <a class="btn btn-primary bg-light text-primary btn-sm w-100" data-toggle="modal" data-target="#modal_message_read" onclick="funcReadMessage('<?= $message['message'] ?>', '<?= $user['username'] ?>', '<?= $user['priv'] == 0 ? 'Admin' : 'user' ?>', <?= $message['id']?>)">read</a>
                  <!-- <?php // if ($user["id"] == $_SESSION["user_id"]) { 
                        ?> -->
                  <!-- special user modal -->
                  <!-- <?php // } else { 
                        ?> -->
                  <a type="button" class="btn btn-danger btn-sm w-100 mt-1" data-toggle="modal" data-target="#modal_message_delete" onclick="funcDeleteMessage(<?= $message['id'] ?>, '<?= $user['username'] ?>', '<?= $user['priv'] == 0 ? 'Admin' : 'user' ?>')">
                    delete
                  </a>
                  <!-- <?php // } 
                        ?> -->

                </td>
              </tr>
            <?php endforeach;
            $user = null; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- my script for messages -->
<?php include_once "includes/footer.php"; ?>
<script>
  // wards in modal
  function funcDeleteMessage(id, name, priv) {
    $(".modal-message-delete .modal-body span:first").text(priv);
    $(".modal-message-delete .modal-body span:nth-child(2)").text(name);
    $("#deleteVal").data("id", id);
  }
  // delete user & close modal & remove <tr> row
  function deleteMessage(e) {
    $.post(`functions/messages/delete_message.php?id=${e}`, {}, function() {
      $(".modal-message-delete .modal-footer button:first").click();
      $(`table tbody tr#${e}`).remove();
    })
  }
  // read messages
  function funcReadMessage(message, name, priv, id) {
    $.post(`functions/messages/read_message.php?id=${id}`, {}, function (data) {
      if (data.includes("read_message_true")) {
        $(`table tbody tr#${id} td a.btn-primary`).addClass("bg-light text-primary");
        $(".modal-message-read h5 span:first").text(priv);
        $(".modal-message-read h5 span:nth-child(2)").text(name);
        $(".modal-message-read .modal-body").text(message);
      }
    })
  }
</script>