<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Image Upload</title>
    <style>
        /* styles.css */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        .image-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            width: 150px;
            text-align: center;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: auto;
            max-height: 150px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="images">Choose Images</label>
        <input type="file" name="images[]" id="images" multiple accept="image/*">
        <button type="submit" name="submit">Upload Images</button>
    </form>

    <!-- This section will display the uploaded images -->
    <div class="image-cards">
        <?php
        include 'fetch_images.php';  // We will fetch images here from the database
        ?>
    </div>
</body>

</html>

 



<!-- 


        .card {
            width: 150px;
            text-align: center;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: auto;
            max-height: 150px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="images">Choose Images</label>
        <input type="file" name="images[]" id="images" multiple accept="image/*">
        <button type="submit" name="submit">Upload Images</button>
    </form>

    This section will display the uploaded images  
    <div class="image-cards">
  




 





-->