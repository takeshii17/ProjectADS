<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'student') {
    header("Location: index.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$query = "SELECT s.subject_name, g.grade FROM grades g
          JOIN subjects s ON g.subject_id = s.subject_id
          WHERE g.student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<h2>Your Grades</h2>
<table border="1">
    <tr>
        <th>Subject</th>
        <th>Grade</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['subject_name']; ?></td>
        <td><?php echo $row['grade']; ?></td>
    </tr>
    <?php } ?>
</table>
