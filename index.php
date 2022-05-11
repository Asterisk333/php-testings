<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase in PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                        {
                            echo '
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hey!</strong> '.$_SESSION['status'].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            ';
                            unset($_SESSION['status']);
                        }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4>Contact Details - Retrieve/Get/Fetch Data from Firebase (Datbase) in PHP</h4>
                                </div>
                                <div class="col-md-4 text-right">
                                    <?php
                                        include('includes/dbcon.php');

                                        $ref = "contact";
                                        $totaldata = $database->getReference($ref)->getSnapshot()->numChildren();
                                    ?>
                                    <h5 class="bg-primary px-3 text-center py-2 text-white">Total Record Inserted: <?php echo $totaldata ?></h5>
                                    <form action="code.php" method="POST">
                                        <button type="submit" name="reset_data" class="btn btn-danger">Clear Data</button>
                                        <a href="insert.php" class="btn btn-primary ml-3">Add</a>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php
                                        include('includes/dbcon.php');

                                        $ref = "contact";
                                        $getdata = $database->getReference($ref)->getValue();
                                        $i = 0;
                                        if($getdata > 0)
                                        {
                                            foreach($getdata as $key => $row)
                                            {
                                                $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td>
                                                <a href="edit.php?token=<?php echo $key; ?>" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="ref_token_delete" value="<?php echo $key; ?>">
                                                    <button type="submit" name="delete_data" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr class="text-center">
                                                <td colspan="6">DATA NOT THERE IN DATABASE</td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>
    <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-analytics.js"></script>
    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-firestore.js"></script>
</body>
</html>
