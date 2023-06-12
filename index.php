<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <?php
echo '<link rel="stylesheet" type="text/css" href="main.css">';
?>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['task'];
    $task_status = $_POST['task_status'];
    echo "Submitted Task: $task<br>";
    echo "Submitted Task Status: $task_status";
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "to_do";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $task = $_POST['task'];
        $task_status = $_POST['task_status'];
        $sql = "INSERT INTO task (task, task_status) VALUES ('$task', '$task_status')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
          header("location: http://localhost/todo_app/index.php");
        $conn->close();
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<form id="task-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" id="task-input" name="task" placeholder="Enter a task" required><br><br>
    <?php
    $task_statusOptions = array(
        "Not-Completed" => "Not Completed",
        "In-Progress" => "In Progress",
        "Completed" => "Completed",
    );
    foreach ($task_statusOptions as $value => $label) {
        echo '<input type="radio" name="task_status" value="' . $value . '"> ' . $label;
        echo '&ThinSpace; &ThinSpace; &ThinSpace; &ThinSpace; ';
    }
    ?>
    <button type="submit">Add Task</button>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "to_do";
$conn = new mysqli($servername, $username, $password, $dbname);
$result = $conn->query("SELECT * FROM task");
$arr_users = [];
if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<div class="container">
  <h2>Tasks</h2>
  <p>Tasks Data</p>            
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Task</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php if (!empty($arr_users)) { ?>
            <?php foreach ($arr_users as $user) { ?>
                <tr>
                    <td><?php echo $user['task']; ?></td>
                    <td><?php echo $user['task_status']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
  </table>
</div>

<?php

?>


<ul id="task-list"></ul>

<script src="main.js"></script>