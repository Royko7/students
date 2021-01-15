<?php
// Include config file
require_once 'config/config.php';
$id = substr($_SERVER['REQUEST_URI'], -1);
$_GET['id'] = $id;
// Define variables and initialize with empty values
$name = $last_name = $group_name = "";
$name_err = $last_name_err = $group_name_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
// Get hidden input value
    $id = $_POST["id"];

// Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!preg_match("/[а-я]/i", $input_name) && !preg_match("/[a-z]/i", $input_name)) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

// Validate address address
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter an address.";
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
// Prepare an update statement
        $sql = "UPDATE users SET name=:name, last_name=:last_name, group_name=:group_name WHERE id=:id";

        if ($stmt = $pdo->prepare($sql)) {
// Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":last_name", $param_last_name);
            $stmt->bindParam(":group_name", $param_group_name);
            $stmt->bindParam(":id", $param_id);

// Set parameters
            $param_name = $name;
            $param_last_name = $last_name;
            $param_group_name = $group_name;
            $param_id = $id;

// Attempt to execute the prepared statement
            if ($stmt->execute()) {
// Records updated successfully. Redirect to landing page
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
} else {
// Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
// Get URL parameter
        $id = trim($_GET["id"]);

// Prepare a select statement
        $sql = "SELECT * FROM users WHERE id = :id";
        if ($stmt = $pdo->prepare($sql)) {
// Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);

// Set parameters
            $param_id = $id;

// Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

// Retrieve individual field value
                    $name = $row["name"];
                    $last_name = $row["last_name"];
                    $group_name = $row["group_name"];
                } else {
// URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

// Close statement
        unset($stmt);

// Close connection
        unset($pdo);
    } else {
// URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Record</h2>
                </div>
                <p>Please edit the input values and submit to update the record.</p>
                <form action="" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Ім'я</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                        <label>Фамілія</label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                        <span class="help-block"><?php echo $last_name_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                        <label>Група</label>
                        <input type="text" name="group_name" class="form-control" value="<?php echo $group_name; ?>">
                        <span class="help-block"><?php echo $group_name_err; ?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
