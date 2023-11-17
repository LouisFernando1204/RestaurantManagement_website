<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#"><b>Puede Resto</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <?php
                if (isset($_SESSION['login']) == true) {
                    ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="home.php">Home</a>
                        </li>
                        <?php if (isset($_SESSION['actors_name']) == true) {
                            if ($_SESSION['actors_name'] == 'cashier' || $_SESSION['actors_name'] == 'manager' || $_SESSION['actors_name'] == 'chef' || $_SESSION['actors_name'] == 'chef assistant') {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Report
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        if ($_SESSION['actors_name'] == 'cashier' || $_SESSION['actors_name'] == 'manager') {
                                            ?>
                                            <li>
                                                <a class="dropdown-item" href="paymentreport.php">Payment Report</a>
                                            </li>
                                        <?php }
                                        if ($_SESSION['actors_name'] == 'chef' || $_SESSION['actors_name'] == 'chef assistant' || $_SESSION['actors_name'] == 'manager') {
                                            ?>
                                            <li>
                                                <a class="dropdown-item" href="kitchenreport.php">Kitchen Report</a>
                                            </li>
                                        <?php }
                                        if ($_SESSION['actors_name'] == 'manager') {
                                            ?>
                                            <li>
                                                <a class="dropdown-item" href="sellingreport.php">Selling Report</a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            if ($_SESSION['actors_name'] == 'manager' || $_SESSION['actors_name'] == 'waitress') {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="CRUDevent.php">Event Data</a>
                                </li>
                            <?php }
                            if ($_SESSION['actors_name'] == 'admin') {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="CRUDfood.php">Food Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="CRUDusers.php">User Data</a>
                                </li>
                            <?php } else {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="food.php">Food Menu</a>
                                </li>
                            <?php }
                        } ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="logout.php">Logout</a>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" action="" method="post">
                        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="keyword"
                            id="keyword">
                        <input type="submit" class="btn btn-outline-success" value="Search" name="search">
                    </form>
                <?php } ?>

            </div>
        </div>
    </nav>
</body>

</html>