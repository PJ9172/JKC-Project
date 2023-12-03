<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "upload";
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("ERROR: Could not connect. "
        . mysqli_error($conn));
}

// Delete selected photos
if (isset($_POST['delete_photos'])) {
    $selectedPhotos = $_POST['selected_photos'];

    foreach ($selectedPhotos as $photoId) {
        // Perform deletion logic for each selected photo
        $deleteQuery = "DELETE FROM tb_upload WHERE id = $photoId";
        mysqli_query($conn, $deleteQuery);

    }

    // Redirect back to the event page after deletion
    header("Location: event.php?msg=Selected photos deleted successfully");
    exit();
}

// Retrieve photos for display
$sql = "SELECT * FROM tb_upload";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #86fcfc 0%, #fb60bd 100%);
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-3 {
            flex-basis: calc(25% - 15px);
            margin-bottom: 15px;
        }

        .img-container {
            width: 100%;
            max-height: 200px; /* Set your desired fixed height */
            overflow: hidden;
            border: 1px solid #ddd; 
            border-radius: 10px; 
        }

        .img-fluid {
            width: 100%;
            height: auto;
            object-fit: cover; 
        }

        .btn-danger {
            background-color: #dc3545; 
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c82333; 
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Event Photos</h2>

        <form method="post" action="">
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="col-3 mb-3">
                        <label>
                            <div class="img-container">
                                <img src="img/<?php echo $row["image"]; ?>" alt="Photo" class="img-fluid">
                            </div>
                            <input type="checkbox" name="selected_photos[]" value="<?php echo $row['id']; ?>">
                        </label>
                    </div>
                <?php endwhile; ?>
            </div>

            <button type="submit" class="btn btn-danger" name="delete_photos">Delete Selected Photos</button>
        </form>
    </div>

</body>

</html>
