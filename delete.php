<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "to_do";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];
    $task = $_POST['task'];
    $task_status = $_POST['task_status'];

    $sql = "DELETE FROM task WHERE id = $task_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    header("location: http://localhost/todo_app/index.php");
    $conn->close();
    exit();
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $result = $conn->query("SELECT * FROM task WHERE id = $task_id");

    if ($result->num_rows > 0) {
        $task_data = $result->fetch_assoc();
    }
}
?>

<form id="edit-task-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="task_id" value="<?php echo $task_data['id']; ?>">
    
    <!-- <?php
    // $task_statusOptions = array(
    //     "Not-Completed" => "Not Completed",
    //     "In-Progress" => "In Progress",
    //     "Completed" => "Completed",
    // );

    // foreach ($task_statusOptions as $value => $label) {
    //     $checked = ($task_data['task_status'] == $value) ? 'checked' : '';
    //     echo '<input type="radio" name="task_status" value="' . $value . '" ' . $checked . '> ' . $label;
    //     echo '&ThinSpace; &ThinSpace; &ThinSpace; &ThinSpace; ';
    // }
    ?> -->
    <button type="submit">DELETE</button>
 
</form>

