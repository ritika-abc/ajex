<?php
// image is a logo
ob_start();
include_once "include1/header.php";

// form 1
include "config.php";
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}

$sql = "SELECT* FROM `user` WHERE `user_id`='$user_id'";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query)) {
    // to select all the data
    $user_phone = $row['user_phone'];
    $company_name = $row['company_name'];
    $company_address = $row['company_address'];
    $user_website = $row['user_website'];
    $state = $row['state'];
    $pincode = $row['pincode'];
    $gst = $row['gst'];
    $iec_code = $row['iec_code'];
    $type = $row['type'];
    $product_name = $row['product_name'];
    $image = $row['image'];
    $country_name = $row['country_name'];
    // item
    $item1 = $row['item1'];
    $item2 = $row['item2'];
    $item3 = $row['item3'];
}
?>

<?php
// update logic
include "config.php";
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}

if (isset($_POST['submit'])) {

    // Collect form data
    $user_phone = trim($_POST['user_phone']);
    $company_name = trim($_POST['company_name']);
    $company_address = trim($_POST['company_address']);
    $user_website = trim($_POST['user_website']);
    $state = trim($_POST['state']);
    $pincode = trim($_POST['pincode']);
    $gst = trim($_POST['gst']);
    $iec_code = trim($_POST['iec_code']);
    $type = trim($_POST['type']);
    $product_name = trim($_POST['product_name']);
    $country_name = trim($_POST['country_name']);

    // item
    $item1 = trim($_POST['item1']);
    $item2 = trim($_POST['item2']);
    $item3 = trim($_POST['item3']);

    // Check if any required field is empty
    if (empty($product_name)   ) {
        echo "<a href='profile-view.php'><h1 class='mt-5'>All fields are required. <small>Click Here</small></h1></a>";
        exit;
    }

     
    // Allowed image extensions
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    
    // Initialize the image path to be the current one in the database (if no new image is uploaded)
    $image_path = ""; 
    
    // Get the file extension for image validation
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    
        // Check if the uploaded file has a valid extension
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Error: Invalid image format. Only .jpg, .jpeg, and .png files are allowed.";
            exit;
        }
    
        // Check the image size (e.g., limit to 5MB)
        if ($_FILES["image"]["size"] > 5 * 1024 * 1024) { // 5MB limit
            echo "Error: The image is too large. Maximum size is 5MB.";
            exit;
        }
    
        // Check the image dimensions (e.g., limit to 1500x1500 pixels)
        list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
    
        $max_width = 1500;
        $max_height = 1500;
    
        if ($width > $max_width || $height > $max_height) {
            echo "Error: The image is too large. Maximum dimensions are 1500x1500 pixels.";
            exit;
        }
    
        // Generate a unique name for the image
        $image_name = time() . "_" . $_FILES["image"]["name"];
        $image_path = "logo/" . $image_name;  // Path to store the image
    
        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES["image"]['tmp_name'], $image_path)) {
            echo "Error uploading the image.";
            exit;
        }
    }
    
    // If no image was uploaded, $image_path will remain an empty string, and we shouldn't update the image field
    if ($_FILES["image"]["error"] != UPLOAD_ERR_OK) {
        // If no new image is uploaded, you should keep the existing image
        // Fetch the current image path from the database first if necessary
        $sql1 = "SELECT `image` FROM `user` WHERE `user_id`='$user_id'";
        $result = mysqli_query($con, $sql1);
        if ($result) {
            $user_data = mysqli_fetch_assoc($result);
            $image_path = $user_data['image'];  // Keep the old image if no new image is uploaded
        }
    }
    
    // Now update the user's profile in the database
    $sql1 = "UPDATE `user` SET 
                `user_phone`='$user_phone',
                `company_name`='$company_name',
                `company_address`='$company_address',
                `user_website`='$user_website',
                `state`='$state', 
                `pincode`='$pincode',
                `product_name`='$product_name',
                `gst`='$gst',
                `iec_code`='$iec_code',
                `type`='$type',
                `country_name`='$country_name',
                `item1`='$item1',
                `item2`='$item2',
                `item3`='$item3',
                `image`='$image_path'  -- This will only update if a new image is uploaded or use the old one
            WHERE `user_id`='$user_id'";
    
    // Execute the SQL query
    $query1 = mysqli_query($con, $sql1);
    if ($query1) {
        header("Location: profile-view.php");
    } else {
        echo "Failed to update profile.";
    }
     
    
    
}
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard </h2>

                </div>

            </div>
        </div>
        <?php
        include "nav.php"; ?>
        <div class=" ">
            <div class="row">
                <div class="col-md-12">
                    <div class="progress_bar">
                        <!-- Skill Bars -->
                        <span class="skill" style="width:73%;">Your Profile Status <span class="info_valume">73%</span></span>
                        <div class="progress skill-bar ">
                            <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row   graph">
                <div class="col-lg-12 ">
                    <div class="dash_blog">
                        <div class="dash_blog_inner">
                            <div class="dash_head">
                                <h3><span><i class="fa fa-user yellow_color"></i> Edit Your Profile</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
                            </div>

                            <div class="task_list_main">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="container-fluid task_list_view">
                                        <div class="list_cont bg-light">
                                            <h5>Update Your Company Details</h5>
                                        </div>
                                        <div class="row ">
                                            <div class="col-lg-6 my-3  ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Your Website*</label>
                                                    <input type="text" name="user_website" value="<?php echo $user_website; ?>" class="form-control" placeholder="Your Website">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Main Primary Business*</label>
                                                    <select name="type" class="form-control" id="">
                                                        <option value="">----- Select Primary Business -----</option>
                                                        <option value="exporter" <?php if ($type == 'exporter') echo "selected"; ?>>Exporter</option>
                                                        <option value="supplier" <?php if ($type == 'supplier') echo "selected"; ?>>Supplier</option>
                                                        <option value="manufacturer" <?php if ($type == 'manufacturer') echo "selected"; ?>>Manufacturer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  ">
                                            <div class="col-lg-6 my-3  ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Company Name*</label>
                                                    <input type="text" value="<?php echo $company_name; ?>" name="company_name" class="form-control" placeholder="Company Name*">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Company's Logo*</label>
                                                    <div class="d-flex">
                                                        <input type="file" name="image" value="<?php echo $image; ?>" class="form-control w-50" placeholder="Company's Logo">
                                                        <img src="<?php echo $image ?>" height="auto" width="30%" alt="<?php echo $image ?>">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row    ">
                                            <div class="col-lg-6 my-3  ">
                                                <div class="">
                                                    <label for="" class=" text-danger">GST Details*</label>
                                                    <input type="text" name="gst" value="<?php echo $gst; ?>" class="form-control" placeholder="GST Details*">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">IEC Details*</label>
                                                    <input type="text" name="iec_code" value="<?php echo $iec_code; ?>" class="form-control" placeholder="IEC Details*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row    ">
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Select Country* </label>
                                                    <select name="country_name" class="form-control py-2" size="" id="">
                                                        <option value="">----- SELECT-----</option>

                                                        <option <?php if ($country_name == 'Albania') echo "selected"; ?> value="Albania">Albania</option>
                                                        <option <?php if ($country_name == 'Algeria') echo "selected"; ?> value="Algeria">Algeria</option>
                                                        <option <?php if ($country_name == 'Andorra') echo "selected"; ?> value="Andorra">Andorra</option>
                                                        <option <?php if ($country_name == 'Angola') echo "selected"; ?> value="Angola">Angola</option>
                                                        <option <?php if ($country_name == 'Antigua and Barbuda') echo "selected"; ?> value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                        <option <?php if ($country_name == 'Argentina') echo "selected"; ?> value="Argentina">Argentina</option>
                                                        <option <?php if ($country_name == 'Armenia') echo "selected"; ?> value="Armenia">Armenia</option>
                                                        <option <?php if ($country_name == 'Australia') echo "selected"; ?> value="Australia">Australia</option>
                                                        <option <?php if ($country_name == 'Austria') echo "selected"; ?> value="Austria">Austria</option>
                                                        <option <?php if ($country_name == 'Azerbaijan') echo "selected"; ?> value="Azerbaijan">Azerbaijan</option>
                                                        <option <?php if ($country_name == 'Bahamas') echo "selected"; ?> value="Bahamas">Bahamas</option>
                                                        <option <?php if ($country_name == 'Bahrain') echo "selected"; ?> value="Bahrain">Bahrain</option>
                                                        <option <?php if ($country_name == 'Bangladesh') echo "selected"; ?> value="Bangladesh">Bangladesh</option>
                                                        <option <?php if ($country_name == 'Barbados') echo "selected"; ?> value="Barbados">Barbados</option>
                                                        <option <?php if ($country_name == 'Belarus') echo "selected"; ?> value="Belarus">Belarus</option>
                                                        <option <?php if ($country_name == 'Belgium') echo "selected"; ?> value="Belgium">Belgium</option>
                                                        <option <?php if ($country_name == 'Belize') echo "selected"; ?> value="Belize">Belize</option>
                                                        <option <?php if ($country_name == 'Benin') echo "selected"; ?> value="Benin">Benin</option>
                                                        <option <?php if ($country_name == 'Bhutan') echo "selected"; ?> value="Bhutan">Bhutan</option>
                                                        <option <?php if ($country_name == 'Bolivia') echo "selected"; ?> value="Bolivia">Bolivia</option>
                                                        <option <?php if ($country_name == 'Bosnia and Herzegovina') echo "selected"; ?> value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                        <option <?php if ($country_name == 'Botswana') echo "selected"; ?> value="Botswana">Botswana</option>
                                                        <option <?php if ($country_name == 'Brazil') echo "selected"; ?> value="Brazil">Brazil</option>
                                                        <option <?php if ($country_name == 'Brunei') echo "selected"; ?> value="Brunei">Brunei</option>
                                                        <option <?php if ($country_name == 'Bulgaria') echo "selected"; ?> value="Bulgaria">Bulgaria</option>
                                                        <option <?php if ($country_name == 'Burkina Faso') echo "selected"; ?> value="Burkina Faso">Burkina Faso</option>
                                                        <option <?php if ($country_name == 'Burundi') echo "selected"; ?> value="Burundi">Burundi</option>
                                                        <option <?php if ($country_name == 'Cabo Verde') echo "selected"; ?> value="Cabo Verde">Cabo Verde</option>
                                                        <option <?php if ($country_name == 'Cambodia') echo "selected"; ?> value="Cambodia">Cambodia</option>
                                                        <option <?php if ($country_name == 'Cameroon') echo "selected"; ?> value="Cameroon">Cameroon</option>
                                                        <option <?php if ($country_name == 'Canada') echo "selected"; ?> value="Canada">Canada</option>
                                                        <option <?php if ($country_name == 'Central African Republic') echo "selected"; ?> value="Central African Republic">Central African Republic</option>
                                                        <option <?php if ($country_name == 'Chad') echo "selected"; ?> value="Chad">Chad</option>
                                                        <option <?php if ($country_name == 'Chile') echo "selected"; ?> value="Chile">Chile</option>
                                                        <option <?php if ($country_name == 'China') echo "selected"; ?> value="China">China</option>
                                                        <option <?php if ($country_name == 'Colombia') echo "selected"; ?> value="Colombia">Colombia</option>
                                                        <option <?php if ($country_name == 'Comoros') echo "selected"; ?> value="Comoros">Comoros</option>
                                                        <option <?php if ($country_name == 'Congo') echo "selected"; ?> value="Congo">Congo</option>
                                                        <option <?php if ($country_name == 'Costa Rica') echo "selected"; ?> value="Costa Rica">Costa Rica</option>
                                                        <option <?php if ($country_name == 'Croatia') echo "selected"; ?> value="Croatia">Croatia</option>
                                                        <option <?php if ($country_name == 'Cuba') echo "selected"; ?> value="Cuba">Cuba</option>
                                                        <option <?php if ($country_name == 'Cyprus') echo "selected"; ?> value="Cyprus">Cyprus</option>
                                                        <option <?php if ($country_name == 'Czech Republic') echo "selected"; ?> value="Czech Republic">Czech Republic</option>
                                                        <option <?php if ($country_name == 'Denmark') echo "selected"; ?> value="Denmark">Denmark</option>
                                                        <option <?php if ($country_name == 'Djibouti') echo "selected"; ?> value="Djibouti">Djibouti</option>
                                                        <option <?php if ($country_name == 'Dominica') echo "selected"; ?> value="Dominica">Dominica</option>
                                                        <option <?php if ($country_name == 'Dominican Republic') echo "selected"; ?> value="Dominican Republic">Dominican Republic</option>
                                                        <option <?php if ($country_name == 'Ecuador') echo "selected"; ?> value="Ecuador">Ecuador</option>
                                                        <option <?php if ($country_name == 'Egypt') echo "selected"; ?> value="Egypt">Egypt</option>
                                                        <option <?php if ($country_name == 'El Salvador') echo "selected"; ?> value="El Salvador">El Salvador</option>
                                                        <option <?php if ($country_name == 'Equatorial Guinea') echo "selected"; ?> value="Equatorial Guinea">Equatorial Guinea</option>
                                                        <option <?php if ($country_name == 'Eritrea') echo "selected"; ?> value="Eritrea">Eritrea</option>
                                                        <option <?php if ($country_name == 'Estonia') echo "selected"; ?> value="Estonia">Estonia</option>
                                                        <option <?php if ($country_name == 'Eswatini') echo "selected"; ?> value="Eswatini">Eswatini</option>
                                                        <option <?php if ($country_name == 'Ethiopia') echo "selected"; ?> value="Ethiopia">Ethiopia</option>
                                                        <option <?php if ($country_name == 'Fiji') echo "selected"; ?> value="Fiji">Fiji</option>
                                                        <option <?php if ($country_name == 'Finland') echo "selected"; ?> value="Finland">Finland</option>
                                                        <option <?php if ($country_name == 'France') echo "selected"; ?> value="France">France</option>
                                                        <option <?php if ($country_name == 'Gabon') echo "selected"; ?> value="Gabon">Gabon</option>
                                                        <option <?php if ($country_name == 'Gambia') echo "selected"; ?> value="Gambia">Gambia</option>
                                                        <option <?php if ($country_name == 'Georgia') echo "selected"; ?> value="Georgia">Georgia</option>
                                                        <option <?php if ($country_name == 'Germany') echo "selected"; ?> value="Germany">Germany</option>
                                                        <option <?php if ($country_name == 'Ghana') echo "selected"; ?> value="Ghana">Ghana</option>
                                                        <option <?php if ($country_name == 'Greece') echo "selected"; ?> value="Greece">Greece</option>
                                                        <option <?php if ($country_name == 'Grenada') echo "selected"; ?> value="Grenada">Grenada</option>
                                                        <option <?php if ($country_name == 'Guatemala') echo "selected"; ?> value="Guatemala">Guatemala</option>
                                                        <option <?php if ($country_name == 'Guinea') echo "selected"; ?> value="Guinea">Guinea</option>
                                                        <option <?php if ($country_name == 'Guinea-Bissau') echo "selected"; ?> value="Guinea-Bissau">Guinea-Bissau</option>
                                                        <option <?php if ($country_name == 'Guyana') echo "selected"; ?> value="Guyana">Guyana</option>
                                                        <option <?php if ($country_name == 'Haiti') echo "selected"; ?> value="Haiti">Haiti</option>
                                                        <option <?php if ($country_name == 'Honduras') echo "selected"; ?> value="Honduras">Honduras</option>
                                                        <option <?php if ($country_name == 'Hungary') echo "selected"; ?> value="Hungary">Hungary</option>
                                                        <option <?php if ($country_name == 'Iceland') echo "selected"; ?> value="Iceland">Iceland</option>
                                                        <option <?php if ($country_name == 'India') echo "selected"; ?> value="India">India</option>
                                                        <option <?php if ($country_name == 'Indonesia') echo "selected"; ?> value="Indonesia">Indonesia</option>
                                                        <option <?php if ($country_name == 'Iran') echo "selected"; ?> value="Iran">Iran</option>
                                                        <option <?php if ($country_name == 'Iraq') echo "selected"; ?> value="Iraq">Iraq</option>
                                                        <option <?php if ($country_name == 'Ireland') echo "selected"; ?> value="Ireland">Ireland</option>
                                                        <option <?php if ($country_name == 'Israel') echo "selected"; ?> value="Israel">Israel</option>
                                                        <option <?php if ($country_name == 'Italy') echo "selected"; ?> value="Italy">Italy</option>
                                                        <option <?php if ($country_name == 'Jamaica') echo "selected"; ?> value="Jamaica">Jamaica</option>
                                                        <option <?php if ($country_name == 'Japan') echo "selected"; ?> value="Japan">Japan</option>
                                                        <option <?php if ($country_name == 'Jordan') echo "selected"; ?> value="Jordan">Jordan</option>
                                                        <option <?php if ($country_name == 'Kazakhstan') echo "selected"; ?> value="Kazakhstan">Kazakhstan</option>
                                                        <option <?php if ($country_name == 'Kenya') echo "selected"; ?> value="Kenya">Kenya</option>
                                                        <option <?php if ($country_name == 'Kiribati') echo "selected"; ?> value="Kiribati">Kiribati</option>
                                                        <option <?php if ($country_name == 'Korea, North') echo "selected"; ?> value="Korea, North">Korea, North</option>
                                                        <option <?php if ($country_name == 'Korea, South') echo "selected"; ?> value="Korea, South">Korea, South</option>
                                                        <option <?php if ($country_name == 'Kosovo') echo "selected"; ?> value="Kosovo">Kosovo</option>
                                                        <option <?php if ($country_name == 'Kuwait') echo "selected"; ?> value="Kuwait">Kuwait</option>
                                                        <option <?php if ($country_name == 'Kyrgyzstan') echo "selected"; ?> value="Kyrgyzstan">Kyrgyzstan</option>
                                                        <option <?php if ($country_name == 'Laos') echo "selected"; ?> value="Laos">Laos</option>
                                                        <option <?php if ($country_name == 'Latvia') echo "selected"; ?> value="Latvia">Latvia</option>
                                                        <option <?php if ($country_name == 'Lebanon') echo "selected"; ?> value="Lebanon">Lebanon</option>
                                                        <option <?php if ($country_name == 'Lesotho') echo "selected"; ?> value="Lesotho">Lesotho</option>
                                                        <option <?php if ($country_name == 'Liberia') echo "selected"; ?> value="Liberia">Liberia</option>
                                                        <option <?php if ($country_name == 'Libya') echo "selected"; ?> value="Libya">Libya</option>
                                                        <option <?php if ($country_name == 'Liechtenstein') echo "selected"; ?> value="Liechtenstein">Liechtenstein</option>
                                                        <option <?php if ($country_name == 'Lithuania') echo "selected"; ?> value="Lithuania">Lithuania</option>
                                                        <option <?php if ($country_name == 'Luxembourg') echo "selected"; ?> value="Luxembourg">Luxembourg</option>
                                                        <option <?php if ($country_name == 'Madagascar') echo "selected"; ?> value="Madagascar">Madagascar</option>
                                                        <option <?php if ($country_name == 'Malawi') echo "selected"; ?> value="Malawi">Malawi</option>
                                                        <option <?php if ($country_name == 'Malaysia') echo "selected"; ?> value="Malaysia">Malaysia</option>
                                                        <option <?php if ($country_name == 'Maldives') echo "selected"; ?> value="Maldives">Maldives</option>
                                                        <option <?php if ($country_name == 'Mali') echo "selected"; ?> value="Mali">Mali</option>
                                                        <option <?php if ($country_name == 'Malta') echo "selected"; ?> value="Malta">Malta</option>
                                                        <option <?php if ($country_name == 'Marshall Islands') echo "selected"; ?> value="Marshall Islands">Marshall Islands</option>
                                                        <option <?php if ($country_name == 'Mauritania') echo "selected"; ?> value="Mauritania">Mauritania</option>
                                                        <option <?php if ($country_name == 'Mauritius') echo "selected"; ?> value="Mauritius">Mauritius</option>
                                                        <option <?php if ($country_name == 'Mexico') echo "selected"; ?> value="Mexico">Mexico</option>
                                                        <option <?php if ($country_name == 'Micronesia') echo "selected"; ?> value="Micronesia">Micronesia</option>
                                                        <option <?php if ($country_name == 'Moldova') echo "selected"; ?> value="Moldova">Moldova</option>
                                                        <option <?php if ($country_name == 'Monaco') echo "selected"; ?> value="Monaco">Monaco</option>
                                                        <option <?php if ($country_name == 'Mongolia') echo "selected"; ?> value="Mongolia">Mongolia</option>
                                                        <option <?php if ($country_name == 'Montenegro') echo "selected"; ?> value="Montenegro">Montenegro</option>
                                                        <option <?php if ($country_name == 'Morocco') echo "selected"; ?> value="Morocco">Morocco</option>
                                                        <option <?php if ($country_name == 'Mozambique') echo "selected"; ?> value="Mozambique">Mozambique</option>
                                                        <option <?php if ($country_name == 'Myanmar') echo "selected"; ?> value="Myanmar">Myanmar</option>
                                                        <option <?php if ($country_name == 'Namibia') echo "selected"; ?> value="Namibia">Namibia</option>
                                                        <option <?php if ($country_name == 'Nauru') echo "selected"; ?> value="Nauru">Nauru</option>
                                                        <option <?php if ($country_name == 'Nepal') echo "selected"; ?> value="Nepal">Nepal</option>
                                                        <option <?php if ($country_name == 'Netherlands') echo "selected"; ?> value="Netherlands">Netherlands</option>
                                                        <option <?php if ($country_name == 'New Zealand') echo "selected"; ?> value="New Zealand">New Zealand</option>
                                                        <option <?php if ($country_name == 'Nicaragua') echo "selected"; ?> value="Nicaragua">Nicaragua</option>
                                                        <option <?php if ($country_name == 'Niger') echo "selected"; ?> value="Niger">Niger</option>
                                                        <option <?php if ($country_name == 'Nigeria') echo "selected"; ?> value="Nigeria">Nigeria</option>
                                                        <option <?php if ($country_name == 'North Macedonia') echo "selected"; ?> value="North Macedonia">North Macedonia</option>
                                                        <option <?php if ($country_name == 'Norway') echo "selected"; ?> value="Norway">Norway</option>
                                                        <option <?php if ($country_name == 'Oman') echo "selected"; ?> value="Oman">Oman</option>
                                                        <option <?php if ($country_name == 'Pakistan') echo "selected"; ?> value="Pakistan">Pakistan</option>
                                                        <option <?php if ($country_name == 'Palau') echo "selected"; ?> value="Palau">Palau</option>
                                                        <option <?php if ($country_name == 'Palestine') echo "selected"; ?> value="Palestine">Palestine</option>
                                                        <option <?php if ($country_name == 'Panama') echo "selected"; ?> value="Panama">Panama</option>
                                                        <option <?php if ($country_name == 'Papua New Guinea') echo "selected"; ?> value="Papua New Guinea">Papua New Guinea</option>
                                                        <option <?php if ($country_name == 'Paraguay') echo "selected"; ?> value="Paraguay">Paraguay</option>
                                                        <option <?php if ($country_name == 'Peru') echo "selected"; ?> value="Peru">Peru</option>
                                                        <option <?php if ($country_name == 'Philippines') echo "selected"; ?> value="Philippines">Philippines</option>
                                                        <option <?php if ($country_name == 'Poland') echo "selected"; ?> value="Poland">Poland</option>
                                                        <option <?php if ($country_name == 'Portugal') echo "selected"; ?> value="Portugal">Portugal</option>
                                                        <option <?php if ($country_name == 'Qatar') echo "selected"; ?> value="Qatar">Qatar</option>
                                                        <option <?php if ($country_name == 'Romania') echo "selected"; ?> value="Romania">Romania</option>
                                                        <option <?php if ($country_name == 'Russia') echo "selected"; ?> value="Russia">Russia</option>
                                                        <option <?php if ($country_name == 'Rwanda') echo "selected"; ?> value="Rwanda">Rwanda</option>
                                                        <option <?php if ($country_name == 'Saint Kitts and Nevis') echo "selected"; ?> value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                        <option <?php if ($country_name == 'Saint Lucia') echo "selected"; ?> value="Saint Lucia">Saint Lucia</option>
                                                        <option <?php if ($country_name == 'Saint Vincent and the Grenadines') echo "selected"; ?> value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                        <option <?php if ($country_name == 'Samoa') echo "selected"; ?> value="Samoa">Samoa</option>
                                                        <option <?php if ($country_name == 'San Marino') echo "selected"; ?> value="San Marino">San Marino</option>
                                                        <option <?php if ($country_name == 'Sao Tome and Principe') echo "selected"; ?> value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                        <option <?php if ($country_name == 'Saudi Arabia') echo "selected"; ?> value="Saudi Arabia">Saudi Arabia</option>
                                                        <option <?php if ($country_name == 'Senegal') echo "selected"; ?> value="Senegal">Senegal</option>
                                                        <option <?php if ($country_name == 'Serbia') echo "selected"; ?> value="Serbia">Serbia</option>
                                                        <option <?php if ($country_name == 'Seychelles') echo "selected"; ?> value="Seychelles">Seychelles</option>
                                                        <option <?php if ($country_name == 'Sierra Leone') echo "selected"; ?> value="Sierra Leone">Sierra Leone</option>
                                                        <option <?php if ($country_name == 'Singapore') echo "selected"; ?> value="Singapore">Singapore</option>
                                                        <option <?php if ($country_name == 'Slovakia') echo "selected"; ?> value="Slovakia">Slovakia</option>
                                                        <option <?php if ($country_name == 'Slovenia') echo "selected"; ?> value="Slovenia">Slovenia</option>
                                                        <option <?php if ($country_name == 'Solomon Islands') echo "selected"; ?> value="Solomon Islands">Solomon Islands</option>
                                                        <option <?php if ($country_name == 'Somalia') echo "selected"; ?> value="Somalia">Somalia</option>
                                                        <option <?php if ($country_name == 'South Africa') echo "selected"; ?> value="South Africa">South Africa</option>
                                                        <option <?php if ($country_name == 'South Sudan') echo "selected"; ?> value="South Sudan">South Sudan</option>
                                                        <option <?php if ($country_name == 'Spain') echo "selected"; ?> value="Spain">Spain</option>
                                                        <option <?php if ($country_name == 'Sri Lanka') echo "selected"; ?> value="Sri Lanka">Sri Lanka</option>
                                                        <option <?php if ($country_name == 'Sudan') echo "selected"; ?> value="Sudan">Sudan</option>
                                                        <option <?php if ($country_name == 'Suriname') echo "selected"; ?> value="Suriname">Suriname</option>
                                                        <option <?php if ($country_name == 'Sweden') echo "selected"; ?> value="Sweden">Sweden</option>
                                                        <option <?php if ($country_name == 'Switzerland') echo "selected"; ?> value="Switzerland">Switzerland</option>
                                                        <option <?php if ($country_name == 'Syria') echo "selected"; ?> value="Syria">Syria</option>
                                                        <option <?php if ($country_name == 'Taiwan') echo "selected"; ?> value="Taiwan">Taiwan</option>
                                                        <option <?php if ($country_name == 'Tajikistan') echo "selected"; ?> value="Tajikistan">Tajikistan</option>
                                                        <option <?php if ($country_name == 'Tanzania') echo "selected"; ?> value="Tanzania">Tanzania</option>
                                                        <option <?php if ($country_name == 'Thailand') echo "selected"; ?> value="Thailand">Thailand</option>
                                                        <option <?php if ($country_name == 'Timor-Leste') echo "selected"; ?> value="Timor-Leste">Timor-Leste</option>
                                                        <option <?php if ($country_name == 'Togo') echo "selected"; ?> value="Togo">Togo</option>
                                                        <option <?php if ($country_name == 'Tonga') echo "selected"; ?> value="Tonga">Tonga</option>
                                                        <option <?php if ($country_name == 'Trinidad and Tobago') echo "selected"; ?> value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                        <option <?php if ($country_name == 'Tunisia') echo "selected"; ?> value="Tunisia">Tunisia</option>
                                                        <option <?php if ($country_name == 'Turkey') echo "selected"; ?> value="Turkey">Turkey</option>
                                                        <option <?php if ($country_name == 'Turkmenistan') echo "selected"; ?> value="Turkmenistan">Turkmenistan</option>
                                                        <option <?php if ($country_name == 'Tuvalu') echo "selected"; ?> value="Tuvalu">Tuvalu</option>
                                                        <option <?php if ($country_name == 'Uganda') echo "selected"; ?> value="Uganda">Uganda</option>
                                                        <option <?php if ($country_name == 'Ukraine') echo "selected"; ?> value="Ukraine">Ukraine</option>
                                                        <option <?php if ($country_name == 'United Arab Emirates') echo "selected"; ?> value="United Arab Emirates">United Arab Emirates</option>
                                                        <option <?php if ($country_name == 'United Kingdom') echo "selected"; ?> value="United Kingdom">United Kingdom</option>
                                                        <option <?php if ($country_name == 'United States') echo "selected"; ?> value="United States">United States</option>
                                                        <option <?php if ($country_name == 'Uruguay') echo "selected"; ?> value="Uruguay">Uruguay</option>
                                                        <option <?php if ($country_name == 'Uzbekistan') echo "selected"; ?> value="Uzbekistan">Uzbekistan</option>
                                                        <option <?php if ($country_name == 'Vanuatu') echo "selected"; ?> value="Vanuatu">Vanuatu</option>
                                                        <option <?php if ($country_name == 'Vatican City') echo "selected"; ?> value="Vatican City">Vatican City</option>
                                                        <option <?php if ($country_name == 'Venezuela') echo "selected"; ?> value="Venezuela">Venezuela</option>
                                                        <option <?php if ($country_name == 'Vietnam') echo "selected"; ?> value="Vietnam">Vietnam</option>
                                                        <option <?php if ($country_name == 'Yemen') echo "selected"; ?> value="Yemen">Yemen</option>
                                                        <option <?php if ($country_name == 'Zambia') echo "selected"; ?> value="Zambia">Zambia</option>
                                                        <option <?php if ($country_name == 'Zimbabwe') echo "selected"; ?> value="Zimbabwe">Zimbabwe</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Select State*</label>
                                                    <select name="state" class="form-control py-2" size="" id="">
                                                        <option value="">----- SELECT-----</option>
                                                        <option value="Andhra Pradesh" <?php if ($state == 'Andhra Pradesh') echo "selected"; ?>>Andhra Pradesh</option>
                                                        <option value="Arunachal Pradesh" <?php if ($state == 'Arunachal Pradesh') echo "selected"; ?>>Arunachal Pradesh</option>
                                                        <option value="Assam" <?php if ($state == 'Assam') echo "selected"; ?>>Assam</option>
                                                        <option value="Bihar" <?php if ($state == 'Bihar') echo "selected"; ?>>Bihar</option>
                                                        <option value="Chhattisgarh" <?php if ($state == 'Chhattisgarh') echo "selected"; ?>>Chhattisgarh</option>
                                                        <option value="Goa" <?php if ($state == 'Goa') echo "selected"; ?>>Goa</option>
                                                        <option value="Gujarat" <?php if ($state == 'Gujarat') echo "selected"; ?>>Gujarat</option>
                                                        <option value="Haryana" <?php if ($state == 'Haryana') echo "selected"; ?>>Haryana</option>
                                                        <option value="Himachal Pradesh" <?php if ($state == 'Himachal Pradesh') echo "selected"; ?>>Himachal Pradesh</option>
                                                        <option value="Jharkhand" <?php if ($state == 'Jharkhand') echo "selected"; ?>>Jharkhand</option>
                                                        <option value="Karnataka" <?php if ($state == 'Karnataka') echo "selected"; ?>>Karnataka</option>
                                                        <option value="Kerala" <?php if ($state == 'Kerala') echo "selected"; ?>>Kerala</option>
                                                        <option value="Madhya Pradesh" <?php if ($state == 'Madhya Pradesh') echo "selected"; ?>>Madhya Pradesh</option>
                                                        <option value="Maharashtra" <?php if ($state == 'Maharashtra') echo "selected"; ?>>Maharashtra</option>
                                                        <option value="Manipur" <?php if ($state == 'Manipur') echo "selected"; ?>>Manipur</option>
                                                        <option value="Meghalaya" <?php if ($state == 'Meghalaya') echo "selected"; ?>>Meghalaya</option>
                                                        <option value="Mizoram" <?php if ($state == 'Mizoram') echo "selected"; ?>>Mizoram</option>
                                                        <option value="Nagaland" <?php if ($state == 'Nagaland') echo "selected"; ?>>Nagaland</option>
                                                        <option value="Odisha" <?php if ($state == 'Odisha') echo "selected"; ?>>Odisha</option>
                                                        <option value="Punjab" <?php if ($state == 'Punjab') echo "selected"; ?>>Punjab</option>
                                                        <option value="Rajasthan" <?php if ($state == 'Rajasthan') echo "selected"; ?>>Rajasthan</option>
                                                        <option value="Sikkim" <?php if ($state == 'Sikkim') echo "selected"; ?>>Sikkim</option>
                                                        <option value="Tamil Nadu" <?php if ($state == 'Tamil Nadu') echo "selected"; ?>>Tamil Nadu</option>
                                                        <option value="Telangana" <?php if ($state == 'Telangana') echo "selected"; ?>>Telangana</option>
                                                        <option value="Tripura" <?php if ($state == 'Tripura') echo "selected"; ?>>Tripura</option>
                                                        <option value="Uttar Pradesh" <?php if ($state == 'Uttar Pradesh') echo "selected"; ?>>Uttar Pradesh</option>
                                                        <option value="Uttarakhand" <?php if ($state == 'Uttarakhand') echo "selected"; ?>>Uttarakhand</option>
                                                        <option value="West Bengal" <?php if ($state == 'West Bengal') echo "selected"; ?>>West Bengal</option>
                                                        <option value="Andaman and Nicobar Islands" <?php if ($state == 'Andaman and Nicobar Islands') echo "selected"; ?>>Andaman and Nicobar Islands</option>
                                                        <option value="Dadra and Nagar Haveli and Daman and Diu" <?php if ($state == 'Dadra and Nagar Haveli and Daman and Diu') echo "selected"; ?>>Dadra and Nagar Haveli and Daman and Diu</option>
                                                        <option value="Chandigarh" <?php if ($state == 'Chandigarh') echo "selected"; ?>>Chandigarh</option>
                                                        <option value="Jammu and Kashmir" <?php if ($state == 'Jammu and Kashmir') echo "selected"; ?>>Jammu and Kashmirh</option>
                                                        <option value="Ladakh" <?php if ($state == 'Ladakh') echo "selected"; ?>>Ladakh</option>
                                                        <option value="Lakshadweep" <?php if ($state == 'Lakshadweep') echo "selected"; ?>>Lakshadweep</option>
                                                        <option value="Puducherry" <?php if ($state == 'Puducherry') echo "selected"; ?>>Puducherry</option>
                                                        <option value="Delhi" <?php if ($state == 'Delhi') echo "selected"; ?>>Delhi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row    ">
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Phone Number* </label>
                                                    <input type="number" value="<?php echo $user_phone; ?>" name="user_phone" class="form-control" placeholder="Phone Number*">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Company Address*</label>
                                                    <input type="text" class="form-control" value="<?php echo $company_address; ?>" name="company_address" placeholder="Company Address*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row    ">
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Pincode* </label>
                                                    <input type="number" value="<?php echo $pincode; ?>" name="pincode" class="form-control" placeholder="Pincode*">
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="d-none">
                                        <div class="row    ">
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Enter Product / Service 1 Name*</label>
                                                    <input type="text" class="form-control" name="item1" value="1" require>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Enter Product / Service 2 Name*</label>
                                                    <input type="text" class="form-control" name="item2" value="1" require>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row    ">
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Enter Product / Service 3 Name*</label>
                                                    <input type="text" class="form-control" name="item3" value="1" require>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-3 ">
                                                <div class="">
                                                    <label for="" class=" text-danger">Enter Product / Service 4 Name*</label>
                                                    <input type="text" class="form-control" name="product_name" value="1" require>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="read_more">
                                            <div class="center"><input class="main_bt read_bt" type="submit" name="submit"> </div>
                                        </div>
                                    </div>

                                    <!-- details 2  profile-->

                                </form>
                            </div>
                            <!--  -->
                            <hr>
                            <div class="task_list_main mt-5">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="container-fluid task_list_view">
                                        <div class="list_cont bg-light">
                                            <h5>Add Your Service / Products</h5>
                                        </div>
                                        <div class="row ">
                                            <div class="col-lg-6 my-3   my-4">
                                                <div class="">
                                                    <label for="" class=" text-danger">Add Your Service / Products <b>(max 4 Products)</b></label>
                                                    <input type="text" name="product_name" value=" " class="form-control" placeholder="Add Your Service / Products">
                                                    <input type="hidden" name="email" value="<?php echo  $_SESSION["user_email"]; ?>" class="form-control" placeholder="Add Your Service / Products">
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <div class="row my-4">
                                                <div class="col-lg-8">
                                                    <?php
                                                include "update-service.php";
                                                ?>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="read_more">
                                            <div class="center"><input class="main_bt read_bt" type="submit" name="submit1"> </div>
                                        </div>
                                    </div>


                                </form>
                                <?php

                                include "profile.php";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php
include "include1/footer.php";
ob_end_flush();
?>



