<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <?php
            $con = mysqli_connect("localhost", "root", "", "vistara_enterprises");
            $sel = "SELECT * from `cat` ";
            $q = mysqli_query($con, $sel);
            while ($row = mysqli_fetch_array($q)) {
                $cat_name =$row['cat_name'];

            ?>
                <div class="col-12">
                    <h1 class="h5"> <?php echo $row['cat_name'] ?></h1>
                    <div class="row">
                        <?php
                        $con1 = mysqli_connect("localhost", "root", "", "vistara_enterprises");
                        // $cat_name = $_GET['cat_name'];
                        $sel1 = "SELECT * from `pro` where `cat_name` ='$cat_name'";
                        $q1 = mysqli_query($con1, $sel1);
                        while ($row1 = mysqli_fetch_array($q1)) {

                        ?>
                            <div class="col-3 my-3">
                                <div class="p-5 bg-success">
                                    <h3 class="h6"><?php echo $row1['pro_name'] ?></h3>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>