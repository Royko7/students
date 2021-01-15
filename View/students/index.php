<h2 class="d-flex justify-content-center">Список студентів</h2>
<br>
<a href="students/add" class=" btn btn-success">Добавити студента</a>
<hr>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

<!---->
<!--<table class="table">-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th scope="col">№</th>-->
<!--        <th scope="col">Ім'я</th>-->
<!--        <th scope="col">Фамілія</th>-->
<!--        <th scope="col">Група</th>-->
<!--        <th scope="col"></th>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    <tr>-->
<!--        --><?php
////        debug($res);
//
//        foreach ($data as  $value){
//            $result = implode(' ', $value);
////            echo $result;
//            $res = explode(' ',$result);
////                echo '<br>';
////                echo $res[1];
////        debug($value);
//
//        ?>
<!--        --><?php // $_GET['id'] = $value['id'];
//        $id = $_GET['id'];
//        ;?>
<!---->
<!--        <th scope="row">--><?//=$res[0] ?><!--</th>-->
<!--        <td>--><?php //echo $res[1];?><!--</td>-->
<!--        <td>--><?//= $res[2] ?><!--</td>-->
<!--        <td>--><?//=$res[3] ?><!--</td>-->
<!--        <td><a href="students/read/--><?//=$id?><!--" class="btn btn-warning">Читати </a></td>-->
<!--<!--        <td><a href="-->--><?php ////header('Location:students/read'); $_GET['id']?><!--<!--" class="btn btn-warning">Читати </a></td>-->-->
<!--    </tr>-->
<!--    --><?php
//    }
//    debug($data);

//    debug($_GET['id']);

        ?>




    </tbody>
</table>

<?php
// Include config file
require_once 'config/config.php';

// Attempt select query execution
$sql = 'SELECT * FROM users';
if($result = $pdo->query($sql)){
    if($result->rowCount() > 0){
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>№</th>";
        echo "<th>Ім'я</th>";
        echo "<th>Фамілія</th>";
        echo "<th>Група</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = $result->fetch()){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['group_name'] . "</td>";
            echo "<td>";
            echo "<a href='students/read/". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span>    </a>";
            echo "<a href='students/update/". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
            echo "<a href='students/delete/". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        // Free result set
        unset($result);
    } else{
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

// Close connection
unset($pdo);
?>