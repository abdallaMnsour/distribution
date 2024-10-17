<?php
class Database
{
  public $conn;
  public $Database;

  public function __construct($table)
  {
    $this->conn = new mysqli("localhost", "root", "", "project_tr");
    $this->Database = $table;
  }
  public function readAll()
  {
    $query = $this->conn->query("SELECT * FROM $this->Database");
    $newArray = [];
    foreach ($query as $val) {
      array_push($newArray, $val);
    }
    return $newArray;
  }
  public function read($row, $condition)
  {
    $query = $this->conn->query("SELECT * FROM {$this->Database} WHERE $row = '$condition'");
    $newArray = [];
    foreach ($query as $val) {
      array_push($newArray, $val);
    }
    return $newArray[0];
  }
  public function delete($row, $condition)
  {
    $query = $this->conn->query("DELETE FROM {$this->Database} WHERE $row = '$condition'");
    if ($query) {
      return true;
    } else {
      echo $this->conn->connect_error;
      return false;
    }
  }
  public function insert($array, $path)
  {
    if (isset($array["email"])) {
      $numRows = $this->conn->query("SELECT * FROM $this->Database WHERE email = '$array[email]'");
      if ($numRows->num_rows > 0) {
        echo "user_exists";
        exit();
      }
    }
    $arrKey = [];
    $arrValue = [];
    if ($_FILES["image"]["error"] == 0) {
      $extensions = ["jpg", "gif", "png", "jpeg"];
      $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
      if (in_array($ext, $extensions)) {
        if ($_FILES["image"]["size"] <= 2 * 1024 * 1024) {
          $array["image"] = uniqid() . "." . $ext;
          move_uploaded_file($_FILES["image"]["tmp_name"], $path . $array["image"]);
          // move_uploaded_file($_FILES["image"]["tmp_name"], 'C:/xampp/htdocs/tr_full_project/distribution/admin/img/' . $array["image"]);
          // move_uploaded_file($_FILES["image"]["tmp_name"], 'http://localhost/tr_full_project/distribution/admin/img/' . $array["image"]);
        } else {
          echo "error_image=2=you'r image is too big";
          exit();
        }
      } else {
        echo "error_image=1=you have to submit an image";
        exit();
      }
    } else {
      $array["image"] = "undraw_profile.svg";
    }
    $array["password"] = md5($array["password"]);
    foreach ($array as $k => $val) {
      $arrKey[] .= $k;
      $arrValue[] .= "'" . $val . "'";
    }
    $key = implode(",", $arrKey);
    $value = implode(",", $arrValue);
    $query = $this->conn->query("INSERT INTO $this->Database ($key) VALUES ($value)");

    if ($query) {
      $get = $this->conn->query("SELECT * FROM $this->Database WHERE email = '$array[email]'")->fetch_assoc();
      echo "success=" . $get["id"] . "," . $get["username"] . "," . $get["priv"] . "," . $get["image"];
    } else {
      echo $this->conn->connect_error;
    }
  }
  public function update($array, $id, $path)
  {
    // email لا احتاجها لانه لا يمكن تغيير ال
    // هل المستخدم موجود بالفعل؟
    // if (isset($array["email"])) {
    //   $numRows = $this->conn->query("SELECT * FROM $this->Database WHERE email = '$array[email]'");
    //   if ($numRows->num_rows > 0) {
    //     echo "user_exists";
    //     exit();
    //   }
    // }
    $arrValue = [];
    // تحقق من الصوره
    $bool = false;
    if (isset($_FILES["image"])) {
      if ($_FILES["image"]["error"] == 0) {
        $extensions = ["jpg", "gif", "png", "jpeg"];
        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        if (in_array($ext, $extensions)) {
          if ($_FILES["image"]["size"] <= 2 * 1024 * 1024) {
            $bool = true;
            $array["image"] = uniqid() . "." . $ext;
            move_uploaded_file($_FILES["image"]["tmp_name"], $path . $array["image"]);
          } else {
            echo "error_image=2=you'r image is too big";
            exit();
          }
        } else {
          echo "error_image=1=you have to submit an image";
          exit();
        }
      }
    }
    // ان كان فارغا لا تفعل شئ password تحقق من ال
    if (isset($array["password"])) {
      if (!empty($array["password"])) {
        $array["password"] = md5($array["password"]);
      } else {
        unset($array["password"]);
      }
    }
    // username='abdalla' واجعلها بهذا الشكل array خذ القيم من ال
    foreach ($array as $k => $val) {
      $arrValue[] .= $k . "=" . "'" . $val . "'";
    }
    // قم بجمعهم في نص واحد
    $value = implode(",", $arrValue);
    $query = $this->conn->query("UPDATE $this->Database set $value WHERE id='$id'");

    if ($query) {
      if (!$bool) {
        $array["image"] = "no_image";
      } 
      echo "success=" . $id . "," . $array["username"] . "," . $array["priv"] . "," . $array["image"];
    } else {
      echo $this->conn->connect_error;
    }
  }
  public function readMessage($condition) {
    $query = $this->conn->query("UPDATE message SET isRead = 1 WHERE id = $condition");
    if ($query) {
      echo "read_message_true";
    }
  }
}
