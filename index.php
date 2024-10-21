<?php
session_start();
require 'conn.php';

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Riddle Game</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container mt-5">
            <h1 class="text-center">RIDDLE GAME ADMIN PAGE</h1>

            <div class="text-end mb-3">
                <a href="add_riddle.php" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Choices</th>
                            <th>Points</th>
                            <th>Difficulty</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['riddle_id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['riddle_question']); ?></td>
                                    <td><?php echo htmlspecialchars($row['riddle_answer']); ?></td>
                                    <td><?php echo htmlspecialchars($row['riddle_choices']); ?></td>
                                    <td><?php echo htmlspecialchars($row['riddle_points']); ?></td>
                                    <td><?php echo htmlspecialchars($row['riddle_difficulty']); ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="edit_riddle.php?id=<?php echo $row['riddle_id']; ?>"
                                                class="btn btn-warning me-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger"
                                                onclick="confirmDelete(<?php echo $row['riddle_id']; ?>); return false;"
                                                title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="text-center">No riddles found.</td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Include SweetAlert CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <!-- Include SweetAlert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function confirmDelete(riddleId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to delete_riddle.php with the riddle ID
                        window.location.href = 'delete_riddle.php?id=' + riddleId;
                    }
                });
            }
        </script>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['alert'])): ?>
                Swal.fire({
                    title: "<?php echo $_SESSION['alert']['title']; ?>",
                    text: "<?php echo $_SESSION['alert']['text']; ?>",
                    icon: "<?php echo $_SESSION['alert']['icon']; ?>",
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect after alert is closed
                        window.location.href = "<?php echo $_SESSION['alert']['redirect']; ?>";
                    }
                });
                <?php unset($_SESSION['alert']); // Clear the alert after showing it ?>
            <?php endif; ?>
        });
    </script>


    <script>
        function confirmDelete(riddleId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete_riddle.php with the riddle ID
                    window.location.href = 'delete_riddle.php?id=' + riddleId;
                }
            });
        }
    </script>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>