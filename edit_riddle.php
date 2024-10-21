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

        $sql = "SELECT * FROM questions WHERE riddle_id = $riddle_id";
        $dataResult = $conn->query($sql);
        $dataRow = mysqli_fetch_assoc($dataResult);


        // Get the JSON string from the 'data' column
        $jsonData = $dataRow['riddle_choices'];

        // Decode the JSON data into a PHP array (optional, if you want to manipulate it)
        $dataArray = json_decode($jsonData, true);



        ?>
        <!doctype html>
        <html lang="en">

        <head>
            <title>Edit</title>
            <!-- Required meta tags -->
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

            <!-- Bootstrap CSS v5.2.1 -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

            <!-- font awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        </head>

        <body>
            <header>
                <!-- place navbar here -->
            </header>
            <main>
                <div class="container-md my-5">
                    <h1 class="text-center mb-4">EDIT RIDDLE</h1>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="riddleId" class="form-label">Riddle ID</label>
                            <input type="text" class="form-control" name="riddle_id" id="riddleId" readonly
                                value="<?php echo htmlspecialchars($dataRow['riddle_id']); ?>" />
                        </div>

                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" name="riddle_question" id="question"
                                value="<?php echo htmlspecialchars($dataRow['riddle_question']); ?>" required />
                        </div>

                        <div class="mb-3">
                            <label for="choices" class="form-label">Choices</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">A.</span>
                                <input type="text" class="form-control" name="choiceA" id="choiceA"
                                    value="<?php echo isset($dataArray[0]) ? htmlspecialchars($dataArray[0]) : ''; ?>"
                                    required />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">B.</span>
                                <input type="text" class="form-control" name="choiceB" id="choiceB"
                                    value="<?php echo isset($dataArray[1]) ? htmlspecialchars($dataArray[1]) : ''; ?>"
                                    required />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">C.</span>
                                <input type="text" class="form-control" name="choiceC" id="choiceC"
                                    value="<?php echo isset($dataArray[2]) ? htmlspecialchars($dataArray[2]) : ''; ?>"
                                    required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="riddle_answer" id="answerA" value="0" <?php echo ($dataRow['riddle_answer'] === $dataArray[0]) ? 'checked' : ''; ?> required />
                                <label class="form-check-label" for="answerA"> A. </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="riddle_answer" id="answerB" value="1" <?php echo ($dataRow['riddle_answer'] === $dataArray[1]) ? 'checked' : ''; ?> required />
                                <label class="form-check-label" for="answerB"> B. </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="riddle_answer" id="answerC" value="2" <?php echo ($dataRow['riddle_answer'] === $dataArray[2]) ? 'checked' : ''; ?> required />
                                <label class="form-check-label" for="answerC"> C. </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="riddle_points" class="form-label">Points</label>
                            <input type="number" class="form-control" name="riddle_points" id="riddle_points"
                                value="<?php echo htmlspecialchars($dataRow['riddle_points']); ?>" required />
                        </div>

                        <div class="mb-3">
                            <label for="riddle_difficulty" class="form-label">Difficulty (1-Easy | 2-Medium | 3-Hard)</label>
                            <input type="number" class="form-control" name="riddle_difficulty" id="riddle_difficulty"
                                value="<?php echo htmlspecialchars($dataRow['riddle_difficulty']); ?>" min="1" max="3"
                                required />
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">
                            <i class="fas fa-edit"></i> UPDATE
                        </button>
                    </form>
                </div>

                <!-- Include Font Awesome for the icon -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

            </main>
            <footer>
                <!-- place footer here -->
            </footer>
            <!-- Bootstrap JavaScript Libraries -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
                integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
                crossorigin="anonymous"></script>
        </body>

        </html>
        <?php


        if (isset($_POST['submit'])) {
            $riddle_id = $_POST['riddle_id'];
            $riddle_question = $_POST['riddle_question'];
            $choiceA = $_POST['choiceA'];
            $choiceB = $_POST['choiceB'];
            $choiceC = $_POST['choiceC'];
            $riddle_answer_RAW = $_POST['riddle_answer'];
            $riddle_points = $_POST['riddle_points'];
            $riddle_difficulty = $_POST['riddle_difficulty'];


            $choices = array(
                htmlspecialchars($choiceA),
                htmlspecialchars($choiceB),
                htmlspecialchars($choiceC)
            );


            $riddle_choices = json_encode($choices);

            $riddle_answer = $choices[$riddle_answer_RAW];

            $sql = "UPDATE `questions` SET `riddle_question`='$riddle_question',`riddle_choices`='$riddle_choices',`riddle_answer`='$riddle_answer',`riddle_points`='$riddle_points',`riddle_difficulty`='$riddle_difficulty' WHERE `riddle_id` = '$riddle_id'";
            $result = $conn->query($sql);

            if ($result) {

                $_SESSION['alert'] = [
                    'title' => 'Success!',
                    'text' => 'Riddle Updated Succesfully.',
                    'icon' => 'success',
                    'redirect' => 'index.php'
                ];

                header("Location: index.php");
                exit;
            }


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