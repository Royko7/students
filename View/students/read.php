<h2>Студент</h2>
<?php
$id = substr($_SERVER['REQUEST_URI'], -1);
$_GET['id'] = $id;
//debug($_GET['id']);

//debug($_POST);
//        // Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require 'config/config.php';

    // Prepare a select statement
    $sql = 'SELECT * FROM users WHERE id = :id';
//            debug($sql);
    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Retrieve individual field value
                $name = $row["name"];
                $last_name = $row["last_name"];
                $group_name = $row["group_name"];
            }

        }

    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else {
    // URL doesn't contain id parameter. Redirect to error page
//        header("location: error.php");
    exit();
}
        ?>


<table class="table">
    <thead>
    <tr>
        <th scope="col">№</th>
        <th scope="col">Ім'я</th>
        <th scope="col">Фамілія</th>
        <th scope="col">Група</th>
        <th scope="col"></th>
    </tr>
    <th scope="row"><?= $row['id'] ?></th>
    <td><?php echo $row['name']; ?></td>
    <td><?= $row['last_name'] ?></td>
    <td><?= $row['group_name'] ?></td>
    </th>
    </thead>
    <tbody>

