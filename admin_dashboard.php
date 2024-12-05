<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

$result = $conn->query("SELECT * FROM students");
?>
<h2>Manage Students</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['student_id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['department']; ?></td>
        <td>
            <a href="edit_student.php?id=<?php echo $row['student_id']; ?>">Edit</a> |
            <a href="delete_student.php?id=<?php echo $row['student_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
<a href="add_student.php">Add Student</a>
