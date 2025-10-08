edit_event.php

<?php
include 'db.php';

// Get event ID from URL
if(!isset($_GET['id'])) {
    die("Event ID is required");
}

$id = $_GET['id'];

// Fetch event from DB
$sql = "SELECT * FROM events WHERE id = $id";
$result = $conn->query($sql);

if($result->num_rows == 0) {
    die("Event not found");
}

$event = $result->fetch_assoc();

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $poster = $event['poster']; // keep old poster by default
    if(isset($_FILES['poster']) && $_FILES['poster']['name'] != '') {
        $target_dir = "uploads/";
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }
        $poster = $target_dir . basename($_FILES["poster"]["name"]);
        move_uploaded_file($_FILES["poster"]["tmp_name"], $poster);
    }

    $update = "UPDATE events SET title='$title', description='$description', date='$date', status='$status', poster='$poster' WHERE id=$id";

    if($conn->query($update)) {
        echo "<p style='color:green; text-align:center;'>Event updated successfully!</p>";
        // Refresh $event variable
        $result = $conn->query($sql);
        $event = $result->fetch_assoc();
    } else {
        echo "<p style='color:red; text-align:center;'>Error: ".$conn->error."</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h2 {
            text-align: center;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
        }
        input[type="text"], input[type="date"], select, textarea, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0 12px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        img {
            max-width: 100px;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<h2>Edit Event</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>

    <label>Description</label>
    <textarea name="description"><?php echo htmlspecialchars($event['description']); ?></textarea>

    <label>Date</label>
    <input type="date" name="date" value="<?php echo $event['date']; ?>" required>

    <label>Status</label>
    <select name="status">
        <option value="Open" <?php if($event['status']=='Open') echo 'selected'; ?>>Open</option>
        <option value="Closed" <?php if($event['status']=='Closed') echo 'selected'; ?>>Closed</option>
    </select>

    <label>Poster</label>
    <?php if($event['poster'] != ''): ?>
        <img src="<?php echo $event['poster']; ?>" alt="Poster">
    <?php endif; ?>
    <input type="file" name="poster">

    <input type="submit" value="Update Event">
</form>
</body>
</html>