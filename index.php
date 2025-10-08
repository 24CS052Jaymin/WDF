index.php

<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        a.button {
            padding: 6px 12px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 4px;
            margin: 2px;
        }
        a.button.delete {
            background-color: #f44336;
        }
        img {
            max-width: 50px;
        }
    </style>
</head>
<body>
<h1>Event Management</h1>
<a href="add_event.php" class="button">Add Event</a>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
        <th>Status</th>
        <th>Poster</th>
        <th>Actions</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM events ORDER BY date ASC");
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['description']}</td>
                <td>{$row['date']}</td>
                <td>{$row['status']}</td>
                <td>";
        if($row['poster']) echo "<img src='{$row['poster']}'>";
        echo "</td>
                <td>
                    <a href='edit_event.php?id={$row['id']}' class='button'>Edit</a>
                    <a href='delete_event.php?id={$row['id']}' class='button delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
    }
    ?>
</table>
</body>
</html>