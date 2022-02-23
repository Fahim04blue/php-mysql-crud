<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'process.php';?>

    <?php
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
echo $_SESSION['message'];
unset($_SESSION['message']);
?>
    </div>
    <?php endif;?>
    <div class="container">
        <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <div class="form-group mt-2">
                    <input type="text" class="form-control"  name="name" value="<?php echo $topic_name; ?>" placeholder="Topic Name">
                </div>
                <div class="form-group mt-2">
                    <input type="text"  class="form-control" name="details"  value="<?php echo $details; ?>" placeholder="Topic Details">
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                </div>
            </form>
        </div>
        <?php
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
$result = $mysqli->query("select * from todo") or die($mysqli->error)
?>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Topic Name</th>
                        <th scope="col">Details</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['topic_name'] ?></td>
                    <td><?php echo $row['details'] ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>" class='btn btn-info'>Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" class='btn btn-danger'>Delete</a>
                    </td>
                </tr>
                <?php endwhile;?>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>


</html>