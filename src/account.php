<?php include '../scripts/database/secure-login.php' ?>
<?php include '../scripts/database/DB-connect.php' ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <?php include '../scripts/functions/functions.php' ?>
    <?php include '../common/meta.php' ?>
    <title>SugarBox&co. | Account</title>
</head>

<style>
    /* div {
        border: 1px solid black;
    } */
</style>

<body class="bg-light <?php if ($_SESSION['functions']['toggleCart'] || $_SESSION['functions']['toggleOptions'] || $_SESSION['functions']['toggleSearch']) echo 'overflow-hidden' ?>">
    
    <!-- Navbar -->
    <?php include '../common/navbar.php' ?>

    <div class="container my-5">
        <div class="row justify-content-center align-items-center flex-column">
            <div class="col">
                <h2 class="text-center text-titleColor">PROFILE</h2>
            </div>
            <div class="col-4 text-center mt-n3">
                <img class="img-fluid" src="../assets/leaves.svg" draggable="false" alt="">
            </div>
        </div>
    </div>

    <div class="mx-6 mb-4">
        <div class="container-fluid">
            <div class="row gap-4">
                <div class="col-lg bg-section rounded-1 p-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="text-titleColor">Contact Details</h3>
                        <form action="" method="post">
                        <?php if (!isset($_POST["editContact"])) { ?>
                            <input class="btn fs-5 text-subheading p-0" name="editContact" type="submit" value="EDIT">
                        <?php } else { ?>
                            <input class="btn fs-5 text-subheading p-0" name="cancelEditContact" type="submit" value="CANCEL">
                        <?php } ?>
                        </form>
                        <?php if (isset($_POST["cancelEditContact"])) unset($_POST["editContact"]) ?>
                    </div>
                    <hr class="bg-content mb-4 mt-2">
                    <?php if (!isset($_POST["editContact"])) { ?>
                        <p class="text-content fw-bolder">Full Name: &nbsp;<span class="text-content fw-bold"><?php echo $_SESSION["customer"]["fname"] . " " . $_SESSION["customer"]["lname"] ?></span></p>
                        <p class="text-content fw-bolder">Contact Number: &nbsp;<span class="text-content fw-bold"><?php echo $_SESSION["customer"]["contact"] ?></span></p>
                        <p class="text-content fw-bolder">Address: &nbsp;<span class="text-content fw-bold"><?php echo $_SESSION["customer"]["address"] ?></span></p>
                    <?php } else { ?>
                        <form action="../scripts/database/client-crud.php" method="post">
                            <p class="text-content fw-bolder">First Name: <input class="form-control bg-section2 border-0 mt-2" type="text" name="fname" value="<?php echo $_SESSION["customer"]["fname"] ?>"></p>
                            <p class="text-content fw-bolder">Last Name: <input class="form-control bg-section2 border-0 mt-2" type="text" name="lname" value="<?php echo $_SESSION["customer"]["lname"] ?>"></p>
                            <p class="text-content fw-bolder">Contact Number: <input class="form-control bg-section2 border-0 mt-2" type="number" name="contact" value="<?php echo $_SESSION["customer"]["contact"] ?>"></p>
                            <p class="text-content fw-bolder">Address: <input class="form-control bg-section2 border-0 mt-2" type="text" name="address" value="<?php echo $_SESSION["customer"]["address"] ?>"></p>
                            <div class="text-center">
                                <input class="btn btn-titleColor text-light mt-3 col-3" type="submit" name="updateContact" value="Save">
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="col-lg bg-section rounded-1 p-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="text-titleColor">Account Details</h3>
                        <form action="" method="post">
                        <?php if (!isset($_POST["editAccount"])) { ?>
                            <input class="btn fs-5 text-subheading p-0" name="editAccount" type="submit" value="EDIT">
                        <?php } else { ?>
                            <input class="btn fs-5 text-subheading p-0" name="cancelEditAccount" type="submit" value="CANCEL">
                        <?php } ?>
                        </form>
                    </div>
                    <hr class="bg-content mb-4 mt-2">
                    <?php if (!isset($_POST["editAccount"])) { ?>
                        <p class="text-content fw-bolder">Username: &nbsp;<span class="text-content fw-bold"><?php echo $_SESSION['user']['accUsername'] ?></span></p>
                        <p class="text-content fw-bolder">Password: &nbsp;<span class="text-content fw-bold font-monospace"><?php for ($i = 0; $i < strlen(getPassword()); $i++) echo '*' ?></span></p>
                        <a href="#" class="text-decoration-none"><p class="text-danger fw-bold">Delete Account</p></a>
                    <?php } else { ?>
                        <form action="../scripts/database/client-crud.php" method="post">
                            <p class="text-content fw-bolder">Username: <input class="form-control bg-section2 border-0 mt-2" type="text" name="username" value="<?php echo $_SESSION['user']['accUsername'] ?>"></p>
                            <p class="text-content fw-bolder mb-2">Password:</p>
                            <div class="input-group mb-3">
                                <input class="form-control bg-section2 border-0 font-monospace" disabled type="password" name="password" id="password" value="<?php echo getPassword() ?>">
                                <button class="btn btn-section2 text-subheading" type="button" onclick="showPass('password', this)">Show</button>
                            </div>
                            <p class="text-content fw-bolder mb-2">New Password:</p>
                            <div class="input-group mb-3">
                                <input class="form-control bg-section2 border-0 font-monospace" type="password" name="newPassword" id="newPassword">
                                <button class="btn btn-section2 text-subheading" type="button" onclick="showPass('newPassword', this)">Show</button>
                            </div>
                            <p class="text-content fw-bolder mb-2">Re-enter Password:</p>
                            <div class="input-group mb-3">
                                <input class="form-control bg-section2 border-0 font-monospace" type="password" name="valPassword" id="valPassword">
                                <button class="btn btn-section2 text-subheading" type="button" onclick="showPass('valPassword', this)">Show</button>
                            </div>
                            <div class="text-center">
                                <input class="btn btn-titleColor text-light mt-3 col-3" type="submit" name="updateAccount" value="Save">
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mx-6 mb-6">
        <a id="orderHistory"></a>
        <div class="bg-section rounded-1 p-5" id="orderHistory">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="text-titleColor">Order History</h3>
                <form action="" method="post">
                    <input class="btn fs-5 text-subheading p-0" name="expandHistory" type="submit" value="SEE ALL">
                </form>
            </div>
            <hr class="bg-content mb-4 mt-2">
            <?php $orders = getOrders() ?>
            <?php foreach ($orders as $order) { ?>
                <!-- Order -->
                <div class="d-flex justify-content-between bg-section2 rounded-2 p-3 mb-3 text-content">
                    <div>
                        <?php echo date('D d F, Y', strtotime($order['Order_Placement_Date'])) ?>
                    </div>
                    <div class="<?php 
                        switch ($order['Order_Status']) {
                            case 'Pending': echo "text-titleColor"; break;
                            case 'In progress': echo "text-info"; break;
                            case 'Delivering':
                            case 'Ready for pick-up': echo "text-warning"; break;
                            case 'Cancelled':
                            case 'Delivery failed': echo "text-danger"; break;
                            case 'Claimed': echo "text-success"; break;
                        }
                    ?>">
                        <?php echo $order['Order_Status'] ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../common/footer.php' ?>

    <?php
        /**
         * Returns the password of the authorized user.
         * @return string The password of the authorized user.
         */
        function getPassword() {
            $conn = db_connect();
            $accID = $_SESSION["user"]["accID"];

            $query = "SELECT `Acc_Password` FROM `accounts` WHERE `Account_ID`='$accID' LIMIT 1";
            $result = mysqli_query($conn, $query);
            $password = mysqli_fetch_array($result);

            mysqli_close($conn);
            return $password["Acc_Password"];
        }

        /**
         * Returns all order history of the customer.
         * @return array The order history of the customer.
         */
        function getOrders() {
            $conn = db_connect();
            $accID = $_SESSION["user"]["accID"];

            $query = "SELECT * FROM `orders` WHERE `Cust_ID`='$accID' 
                        ORDER BY `Order_Placement_Date` DESC LIMIT 5";
            $result = mysqli_query($conn, $query);

            $orders = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[] = $row;
            }

            mysqli_close($conn);
            return $orders;
        }
    ?>

    <script>
        function showPass(input = "", btn) {
            const x = document.getElementById(input);
            if (x.type === "password") {
                x.type = "text";
                btn.innerHTML = "Hide";
            } else {
                x.type = "password";
                btn.innerHTML = "Show";
            }
        }
    </script>
</body>
</html>
