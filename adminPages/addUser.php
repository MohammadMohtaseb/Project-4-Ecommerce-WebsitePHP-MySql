<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../account (1).php");
    exit();
}

function getFirstTwoWords($string)
{
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, 2));
}

$firstTwoWords = getFirstTwoWords($_SESSION['user_name']);
include '../connection.php';

$name = '';
$email = '';
$password = '';
$role_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $role_id = $conn->real_escape_string($_POST['role_id']);

    $sql = "INSERT INTO users (username, email, password, role_id) VALUES ('$name', '$email', '$password', $role_id)";
    if ($conn->query($sql) === TRUE) {
        header("Location: manageUser.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="manageStyle.css">
    <style>
        img {
            margin-left: 20px;
        }

        hr {
            margin-left: 20px;
            margin-right: 20px;
            color: white;
            border-color: white
        }

        ul {
            color: #3d62ff;
        }

        .sidebarItems {
            font-weight: bolder;
            color: #3d62ff;
        }

        .card>h3,
        .card>p {
            color: #2943b1;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav style="padding:0; background-color: #8ba1fd61;" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <img style="margin-left: 20px;" src="../dist/images/Logo.png" alt="">
                    <hr style="margin-left: 20px; margin-right: 20px; color:white ;border-color:white">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a style="color: #2943b1;" class="sidebarItems" class="nav-link active" href="dashboard.php">
                                <i class="fa fa-cloud"></i>
                                Main dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="background-color: #F1F0F0; color: #2943b1;" class="sidebarItems" class="nav-link active" href="manageUser.php">
                                <i class="fa-solid fa-table-columns"></i>
                                Manage Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style=" color: #2943b1;" class="sidebarItems" class="nav-link" href="manageCategories.php">
                                <i class="fas fa-list"></i>
                                Manage Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="color: #2943b1;" class="sidebarItems" class="nav-link" href="manageProducts.php">
                                <i class="fas fa-boxes"></i>
                                Manage Products
                            </a>
                        </li>
                        <li lass="nav-item"><a style="color: #2943b1;" class="sidebarItems" class="nav-link" href="manageProductType.php"> <i class="fas fa-tags"></i> Manage Product Type</a></li>
                        <li lass="nav-item"><a style="color: #2943b1;" class="sidebarItems" class="nav-link" href="manageCoupons.php">
                                <i class="fas fa-ticket-alt"></i>
                                Manage Coupons
                            </a></li>
                        <li lass="nav-item"><a style="color: #2943b1;" class="sidebarItems" class="nav-link" href="manageOrders.php"> <i class="fas fa-shopping-cart"></i> Manage Orders</a></li>
                        <li lass="nav-item"><a style="color: #2943b1;" class="sidebarItems" class="nav-link" href="editAdmin.php"><i class="fas fa-user-shield"></i> Your Profile</a></li>
                        <li class="nav-item"><a style="color: #2943b1;" class="sidebarItems" class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 style="color: #3d62ff;" class="h2">Admin Dashboard</h1>
                    <p style="color: #3d62ff;" class="h5"><?php echo htmlspecialchars($firstTwoWords); ?></p>
                </div>

                <div class="container my-5">
                    <h2 style="color: #2943b1;">Add User</h2>
                    <form action="" method="post">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="username" value="" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" name="email" value="" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password" value="" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="role_id" required>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="offset-sm-3 col-sm-3 d-grid">
                                <button style="background-color: #2041c2d6; " type="submit" class="btn btn-primary">Add User</button>
                            </div>
                            <div class="col-sm-3 d-grid">
                                <a class="btn btn-outline-primary" href="manageUser.php" role="button">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Wwl5kL5MW/xyxF2YLVivBcc2xMMJ" crossorigin="anonymous"></script>
</body>

</html>