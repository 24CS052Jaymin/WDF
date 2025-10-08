<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $poster = '';
    if(isset($_FILES['poster']) && $_FILES['poster']['name'] != '') {
        $target_dir = "uploads/";

        // Create folder if it doesn't exist
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }

        $poster = $target_dir . basename($_FILES["poster"]["name"]);
        move_uploaded_file($_FILES["poster"]["tmp_name"], $poster);
    }

    $sql = "INSERT INTO events (title, description, date, status, poster) 
            VALUES ('$title', '$description', '$date', '$status', '$poster')";

    if($conn->query($sql)) {
        echo "<p style='color:green; text-align:center;'>Event added successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
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
            max-width: 50px;
        }
    </style>
</head>
<body>
<h2>Add Event</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title" required>
    
    <label>Description</label>
    <textarea name="description"></textarea>
    
    <label>Date</label>
    <input type="date" name="date" required>
    
    <label>Status</label>
    <select name="status">
        <option value="Open">Open</option>
        <option value="Closed">Closed</option>
    </select>
    
    <label>Poster</label>
    <input type="file" name="poster">
    
    <input type="submit" value="Add Event">
</form>
</body>
</html>