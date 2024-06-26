<?php include("../config/conn-database.php");

$admin_info = $_SESSION["admin_info"];

if (isset($_POST["logout_admin"])) {
    unset($_SESSION["admin_info"]);
    unset($_SESSION["login_admin"]);
    unset($_SESSION["sign_up_admin"]);
    // session_unset(); 
    // session_destroy(); 
    header("Location: index.php");
    exit();
}

$admin_id = $admin_info['id'];

$sql = "SELECT * FROM admins WHERE id = $admin_id"; // Filter by user ID
$result = $conn->query($sql);

if ($result === false) {
    die("Error in SQL query: " . $conn->error);
}
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    // Handle the case when no rows are found
    echo "No users found";
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .Btn {
            --black: #000000;
            --ch-black: #141414;
            --eer-black: #1b1b1b;
            --night-rider: #2e2e2e;
            --white: #ffffff;
            --af-white: #f3f3f3;
            --ch-white: #e1e1e1;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition-duration: .3s;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
            background-color: var(--af-white);
            margin-top: 20px;

        }

        /* plus sign */
        .sign {
            width: 100%;
            transition-duration: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sign svg {
            width: 17px;
        }

        .sign svg path {
            fill: var(--night-rider);
        }

        /* text */
        .text {
            position: absolute;
            right: 0%;
            width: 0%;
            opacity: 0;
            color: var(--night-rider);
            font-size: 1.2em;
            font-weight: 600;
            transition-duration: .3s;
        }

        /* hover effect on button width */
        .Btn:hover {
            width: 125px;
            border-radius: 5px;
            transition-duration: .3s;
        }

        .Btn:hover .sign {
            width: 30%;
            transition-duration: .3s;
            padding-left: 20px;
        }

        /* hover effect button's text */
        .Btn:hover .text {
            opacity: 1;
            width: 70%;
            transition-duration: .3s;
            padding-right: 10px;
        }

        /* button click effect*/
        .Btn:active {
            transform: translate(2px, 2px);
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        include("navbar.php");
        ?>

        <div class="view-admin">

            <div class="user-informations">

                <table class="table-info">
                    <thead>
                        <tr>
                            <td class="title-Info">Admin Info</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-info">
                            <td>
                                <label for="">Name : </label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $row['name']; ?>" placeholder="No Name" class="textInput">
                            </td>
                            <td>
                                <button type="button">Update</button>
                            </td>
                        </tr>
                        <tr class="data-info">
                            <td>
                                <label for="">Email :</label>
                            </td>
                            <td>
                                <input type="email" name="email" value="<?php echo $row['email']; ?>" placeholder="No email" class="textInput">
                            </td>
                            <td>
                                <button type="button">Update</button>
                            </td>
                        </tr>
                        <tr class="data-info">
                            <td>
                                <label for="">Password :</label>
                            </td>
                            <td>
                                <input type="password" name="password" value="<?php echo $row['password']; ?>" placeholder="No password" class="textInput" id="passwordField" onclick="togglePasswordVisibility()">
                            </td>
                            <td>
                                <button type="button">Update</button>
                            </td>
                        </tr>
                        <script>
                            function togglePasswordVisibility() {
                                var passwordField = document.getElementById("passwordField");
                                if (passwordField.type === "password") {
                                    passwordField.type = "text";
                                } else {
                                    passwordField.type = "password";
                                }
                            }
                        </script>
                        <tr class="data-info">
                            <td>
                                <label for="">Phone :</label>
                            </td>
                            <td>
                                <input type="tel" name="phone" value="<?php echo  $row['mobile'];  ?>" placeholder="No number" class="textInput">
                            </td>
                            <td>
                                <button type="button">Update</button>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <form method="post" action="">
                    <button type="submit" name="logout_admin" class="Btn" style="float: right; margin-right: 50px;">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <div class="text">Logout</div>
                    </button>
                </form>

            </div>
        </div>
    </div>

</body>

</html>