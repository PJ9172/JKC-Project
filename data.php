<?php
$conn = mysqli_connect("localhost", "root", "", "upload");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
    <style>
      .container {
        display: block;
      }

      .item {
        border: 1px solid #ccc;
        width: 400px; /* Set the width of the item container */
        margin: 10px; /* Add margin to provide space between items */
      }

      .image {
        max-width: 100%; /* Set maximum width to 100% of the container */
        max-height: 100%; /* Set maximum height to 100% of the container */
        display: block;
      }

      .con {
        border: 1px solid black;
        width: 100%;
        height: auto;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <?php
      $rows = mysqli_query($conn, "SELECT * FROM tb_upload ORDER BY id DESC");
      ?>

      <center>
        <?php while ($row = mysqli_fetch_assoc($rows)) : ?>
          <div class="item">
            <div>
              <img class="image" src="img/<?php echo $row["image"]; ?>" title="<?php echo htmlspecialchars($row['image']); ?>" alt="Image">
            </div>
            <div class="con">contain: <?php echo htmlspecialchars($row["name"]); ?></div>
          </div>
        <?php endwhile; ?>
      </center>
    </div>
    <br>
    <!-- <a href="login.html">Upload Image File</a> -->
  </body>
</html>
