<?php
session_start();
ob_start();

require 'conn.php';

if (isset($_GET['id'])) {

    $riddle_id = intval($_GET['id']);

    $sql = "SELECT COUNT(*) as count FROM questions WHERE riddle_id = $riddle_id";
    $result = $conn->query($sql);

    $row = mysqli_fetch_assoc($result);


    if ($row['count'] > 0) {

        $sql = "DELETE FROM `questions` WHERE `riddle_id`='$riddle_id'";
        $result1 = $conn->query($sql);

        if ($result1) {

            $_SESSION['alert'] = [
                'title' => 'Success!',
                'text' => 'Riddle Deleted Succesfully.',
                'icon' => 'success',
                'redirect' => 'index.php'
            ];

            header("Location: index.php");
            exit;
        }


    } else {
        ?>
        <center>
            <h1>ID NOT FOUND</h1>
            <p>Redirecting...</p>
        </center>
        <?php
        header("Refresh:3; URL=index.php");
    }
} else {
    ?>
    <center>
        <h1>ID NOT FOUND</h1>
        <p>Redirecting...</p>
    </center>
    <?php
    header("Refresh:3; URL=index.php");
}
ob_end_flush();
?>