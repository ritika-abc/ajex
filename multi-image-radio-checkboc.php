<?php
include "include/nav.php";
include "include/side.php";
?>

<?php
if (isset($_POST['submit']) && isset($_FILES['images'])) {
    // ✅ Database connection
    

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // ✅ Validation rules
    $max_file_size = 5 * 1024 * 1024; // 5MB
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $max_width = 1500;
    $max_height = 1500;

    // ✅ Get product details from the form
    $pro_name = $_POST['pro_name'];
    $content = $_POST['content'];
    $any_filter = $_POST['any_filter'];
    $price = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    $pro_slug = $_POST['pro_slug'];
    $inner_slug = $_POST['inner_slug'];
    $save_upto = $_POST['save_upto'];
    $cat_slug = $_POST['cat_slug'];
    $tag_number = $_POST['tag_number'];
    $regular_price = $_POST['regular_price'];

    // ✅ Convert checkbox arrays to comma-separated strings
    $size = isset($_POST['size']) ? implode(',', $_POST['size']) : '';
    $colour = isset($_POST['colour']) ? implode(',', $_POST['colour']) : '';
    $availability = isset($_POST['availability']) ? $_POST['availability'] : '';
    $status = isset($_POST['status']) ? implode(',', $_POST['status']) : '';

    // ✅ Array to hold uploaded image filenames
    $uploadedImages = [];

    // ✅ Loop through uploaded images
    $images = $_FILES['images'];
    $imageCount = count($images['name']);

    for ($i = 0; $i < $imageCount; $i++) {
        $imageName = basename($images['name'][$i]);
        $imageTmpName = $images['tmp_name'][$i];
        $imageSize = $images['size'][$i];
        $imageError = $images['error'][$i];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // ✅ Validate file
        if ($imageError === 0) {
            if (in_array($imageExtension, $allowed_extensions) && $imageSize <= $max_file_size) {
                list($width, $height) = getimagesize($imageTmpName);
                if ($width <= $max_width && $height <= $max_height) {
                    $imageNewName = uniqid('IMG_', true) . '.' . $imageExtension;
                    $imageUploadPath = 'uploads/' . $imageNewName;

                    if (move_uploaded_file($imageTmpName, $imageUploadPath)) {
                        $uploadedImages[] = $imageNewName;
                    }
                }
            }
        }
    }

    // ✅ If at least one image uploaded, insert product
    if (!empty($uploadedImages)) {
        // Convert image filenames array to JSON
        $imagesJson = json_encode($uploadedImages);

        // ✅ Insert one product row with all data
        $stmt = $con->prepare("INSERT INTO product 
            (pro_name, images, content, size, colour, availability, any_filter, price, discount_price, pro_slug, inner_slug, cat_slug, save_upto, tag_number, status, regular_price) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ssssssssssssssss",
            $pro_name,
            $imagesJson,
            $content,
            $size,
            $colour,
            $availability,
            $any_filter,
            $price,
            $discount_price,
            $pro_slug,
            $inner_slug,
            $cat_slug,
            $save_upto,
            $tag_number,
            $status,
            $regular_price
        );

        $stmt->execute();
        $stmt->close();
    }

    $con->close();
    // Optional redirect
    header("Location: add-product.php");
 
}
?>




<!-- ==================================================== -->
<!-- Start right Content here -->
<!-- ==================================================== -->
<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">

            <form method="post" enctype="multipart/form-data">


                <div class="col-xl-12  ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Product Photo</h4>
                        </div>
                        <div class="card-body ">
                            <!-- File Upload -->

                            <div class="dz-message needsclick">

                                <h3 class=" "> <span class="text-primary">Click to browse</span></h3>
                                <span class="text-muted fs-13">
                                    (1500 X 1500) Less than or Equal 5MB recommended. PNG, JPG and JPEG files are allowed
                                </span>
                            </div>
                            <input type="file" name="images[]" accept="image/*" multiple class="form-control">

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Product Name</label>
                                        <input type="text" id="product-name" name="pro_name" class="form-control" placeholder="Items Name">
                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">More filters</label>
                                        <input type="text" id="product-name" name="any_filter" class="form-control" placeholder="Items Name">
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="simpleinput" class="form-label">Choose Category</label>
                                    <select class="form-control" data-choices name="cat_slug" required id="choices-single-default">


                                        <?php
                                        $sel = "SELECT * from `cat`";
                                        $q = mysqli_query($con, $sel);
                                        while ($row = mysqli_fetch_array($q)) {
                                            $cat_name = $row['cat_name'];
                                            $cat_slg = strtolower(str_replace(' ', '-', $cat_name))
                                        ?>
                                            <option value="<?php echo $cat_slg ?>"><span class="text-capitalize"><?php echo $row['cat_name'] ?></span></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="simpleinput" class="form-label">Choose Sub-Category</label>
                                    <select class="form-control" data-choices name="inner_slug" required id="choices-single-default">


                                        <?php
                                        $sel = "SELECT * from `sub_cat`";
                                        $q = mysqli_query($con, $sel);
                                        while ($row = mysqli_fetch_array($q)) {
                                            $sub_name = $row['sub_name'];
                                            $sub_slg_name = strtolower(str_replace(' ', '-', $sub_name))
                                        ?>
                                            <option value="<?php echo $sub_slg_name ?>"><span class="text-capitalize"><?php echo $row['sub_name'] ?></span></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <div class="mt-3">
                                        <h5 class="text-dark fw-medium">Size :</h5>
                                        <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                            <input type="checkbox" class="btn-check" id="size-xs1" value="XS" name="size[]">
                                            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="size-xs1">XS</label>

                                            <input type="checkbox" class="btn-check" id="size-s1" value="S" name="size[]">
                                            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="size-s1">S</label>

                                            <input type="checkbox" class="btn-check" id="size-m1" value="M" name="size[]">
                                            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="size-m1">M</label>

                                            <input type="checkbox" class="btn-check" id="size-xl1" value="Xl" name="size[]">
                                            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="size-xl1">Xl</label>

                                            <input type="checkbox" class="btn-check" id="size-xxl1" value="XXL" name="size[]">
                                            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="size-xxl1">XXL</label>
                                            <input type="checkbox" class="btn-check" id="size-3xl1" value="3XL" name="size[]">
                                            <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="size-3xl1">3XL</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mt-3">
                                        <h5 class="text-dark fw-medium">Colors :</h5>
                                        <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                            <?php
                                            $a = 1;
                                            $sel = "SELECT * from `colour`";
                                            $q = mysqli_query($con, $sel);
                                            while ($row = mysqli_fetch_array($q)) {

                                            ?>
                                                <input type="checkbox" name="colour[]" value="<?php echo $row['colour'] ?>" class="btn-check" id="<?php echo $row['colour'] ?>">
                                                <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="<?php echo $row['colour'] ?>"> <i class="bx bxs-circle fs-18 text-dark"></i> <?php echo $row['colour'] ?></label>
                                            <?php $a++;
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Description</label>
                                        <textarea name="content" class="form-control bg-light-subtle" id="content" rows="7" placeholder="Short description about the product"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="product-id" class="form-label">Tag Number</label>
                                        <input type="number" name="tag_number" id="product-id" class="form-control" placeholder="#******">
                                    </div>


                                </div>
                                <div class="col-lg-4">
                                    <label for="" class="form-label">Availability</label>
                                    <div class="d-flex   gap-2">
                                        <input type="radio" class="form-check" id="In stock" value="In stock" name="availability">
                                        <label class="   d-flex justify-content-start align-items-center" for="In stock"><b>In stock</b></label>

                                    </div>
                                    <div class="d-flex mt-2 gap-2">

                                        <input type="radio" class="form-check" id="Out of stock " value="Out of stock" name="availability">
                                        <label class="   d-flex justify-content-start align-items-center" for="Out of stock "><b>Out of stock </b></label>


                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="" class="form-label">Status</label>
                                    <div class="d-flex   gap-2">
                                        <input type="checkbox" class="form-check" id="Sale" value="Sale" name="status[]">
                                        <label class="      d-flex justify-content-start align-items-center" for="Sale"><b>Sale</b></label>

                                    </div>
                                    <div class="d-flex mt-2 gap-2">

                                        <input type="checkbox" class="form-check" id="Best Selling" value="Best Selling" name="status[]">
                                        <label class=" -   d-flex justify-content-start align-items-center" for="Best Selling"><b>Best Selling</b></label>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pricing Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">

                                    <label for="product-price" class="form-label">Regular price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><small><del> Rs.599</del></small></span>
                                        <input type="number" name="regular_price" id="product-price" class="form-control" placeholder="199">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <label for="product-price" class="form-label"> Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                        <input type="number" name="price" id="product-price" class="form-control" placeholder="000">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <label for="product-discount" class="form-label">Discount</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class="bx bxs-discount"></i></span>
                                        <input type="number" id="product-discount" name="discount_price" class="form-control" placeholder="000">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <label for="product-tex" class="form-label">Save upto..</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><small>Save</small></span>
                                        <input type="text" id="product-tex" class="form-control" name="save_upto" placeholder="25%">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <label for="product-tex" class="form-label">pro_slug</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><small>pro_slug</small></span>
                                        <input type="text" id="product-tex" class="form-control" name="pro_slug">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <input type="submit" value="Create Product" name="submit" class="btn btn-outline-secondary w-100">

                            </div>
                            <div class="col-lg-2">
                                <input type="reset" class="btn btn-primary w-100">


                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Container Fluid -->

    <?php
    include "include/footer.php";

    ?>