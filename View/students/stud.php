<h3 class="d-flex justify-content-center">Додати студента</h3>
<br>

<a href="/" class=" btn btn-warning">Назад</a>
<hr>
<br>
<form action="" method="post">
    <div class="row">
        <div class="col">
            <input type="text" name="name" class="form-control" placeholder="Ім'я" aria-label="First name">
        </div>
        <div class="col">
            <input type="text" name="last_name" class="form-control" placeholder="Фамілія" aria-label="Last name">
        </div>

        <div class="col">
            <input type="text" name="group_name" class="form-control" placeholder="Група" aria-label="Last name">
        </div>

    </div>
    <hr>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Додати</button>
    </div>
</form>


<?php
// Include config file
require_once 'config/config.php';

// Define variables and initialize with empty values
$name = $last_name = $group_name = "";
$name_err = $last_name_err = $group_name_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate address
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $address_err = "Please enter an address.";
    } else {
        $last_name = $input_last_name;
    }

    // Validate salary
    $input_group_name = trim($_POST["group_name"]);
    if (empty($input_group_name)) {
        $group_name_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_group_name)) {
        $group_name_err = "Please enter a positive integer value.";
    } else {
        $group_name = $input_group_name;
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($last_name_err) && empty($group_name_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, last_name, group_name) VALUES (:name, :last_name, :group_name)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":last_name", $param_last_name);
            $stmt->bindParam(":group_name", $param_group_name);

            // Set parameters
            $param_name = $name;
            $param_last_name = $last_name;
            $param_group_name = $group_name;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: /");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

