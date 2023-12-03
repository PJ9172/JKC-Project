<?php
$conn = mysqli_connect("localhost", "root", "", "upload");
ini_set('upload_max_filesize', '4M');   // Set the maximum upload size to 4MB
ini_set('post_max_size', '4M');         // Set the maximum POST data size to 4MB

if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  if ($_FILES["image"]["error"] == 4) {
    echo "<script>alert('Image Does Not Exist');</script>";
  } else {
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION); // Use pathinfo to get the file extension
    $imageExtension = strtolower($imageExtension);

    if (!in_array($imageExtension, $validImageExtension)) {
      echo "<script>alert('Invalid Image Extension');</script>";
    } else if ($fileSize > 4194304) {  // 4MB in bytes (1024 * 1024 * 4)
      echo "<script>alert('Image Size Is Too Large');</script>";
    } else {
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($_FILES["image"]["tmp_name"], 'img/' . $newImageName);

      // Use prepared statement to insert data
      $query = "INSERT INTO tb_upload (name, image) VALUES (?, ?)";
      $stmt = mysqli_prepare($conn, $query);
      mysqli_stmt_bind_param($stmt, "ss", $name, $newImageName);
      mysqli_stmt_execute($stmt);

      if(mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Successfully Added'); document.location.href = 'event.php';</script>";
      } else {
        echo "<script>alert('Error in adding data');</script>";
      }

      mysqli_stmt_close($stmt);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
            /* background: linear-gradient(to bottom right, #66ffff 100%, #ff99cc 100%); */
             background-image: linear-gradient(to right,
                    rgba(259, 10, 20, 0.50),
                    rgba(206, 10, 225, 0.53));

        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
        }

        .container h1 {
            font-size: 24px;
        }

        .form-group {
            margin: 10px 0;
        }

        label {
            display: block;
            text-align: left;
        }

        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form class="container" action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <h1>Upload Image File</h1>
        <div class="form-group">
            <label for="name">Name:</label>
            <textarea  name="name" id="name" rows="4" required maxlength="300"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
    <br>
    <!-- <a  style="color:black"   href="event.php">Data</a> -->
</body>
</html>