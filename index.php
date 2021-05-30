<?php

    $insert = false;
    $delete = false;
    //creating connection with the datgabse

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "notemaking";

    $conn = mysqli_connect($servername,$username,$password,$database);
    if(!$conn)
    {
        die("Sorry! There was a server error");
    }
    if(isset($_GET['delete']))
    {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `notemaking` WHERE `sno` = $sno";
        $result = mysqli_query($conn,$sql);
        $delete = true;
    }
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "INSERT INTO `notemaking` (`title`, `description`) VALUES ('$title', '$description')";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            $insert = true;
        }
    }


?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Note It</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Note It</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php

        if($insert)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your note has been added successfully!.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        if($delete)
        {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your note has been deleted successfully!.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }

    ?>
    <div class="container my-5">
        <h2>Add a Note</h2>
        <form action="/notemakingapp/index.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="description"
                        name="description" style="height: 100px"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Add Note</button>
        </form>
        <div class="container my-3">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

$sql = "SELECT * FROM `notemaking`";
$result = mysqli_query($conn,$sql);
if($result)
{
    $no = 0;
    while($row = mysqli_fetch_assoc($result))
    {
        $no = $no +1;
        echo "<tr>
        <th scope='row'>".$no."</th>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>
        <td><button type='button' class='btn btn-sm btn-outline-danger delete' id=d".$row['sno'].">Delete</button></td>
      </tr>";
    }
}

?>

            </tbody>
        </table>
        </div>

    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script>

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                console.log("delete", );
                sno = e.target.id.substr(1, );
                if(confirm("Are you sure to delete this note?"))
                {
                    console.log("YES");
                    window.location = `/notemakingapp/index.php?delete=${sno}`;
                }
                else
                {
                    console.log("no");
                }
            })
        })

    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>