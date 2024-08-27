<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox with Quantity Example</title>
</head>
<body>
    <form action="process.php" method="post">
        <label>
            <input type="checkbox" name="service[apple][checked]" value="1"> Apple
            <input type="text" name="service[apple][quantity]" placeholder="Quantity">
        </label>
        <br>
        <label>
            <input type="checkbox" name="service[banana][checked]" value="1"> Banana
            <input type="text" name="service[banana][quantity]" placeholder="Quantity">
        </label>
        <br>
        <label>
            <input type="checkbox" name="service[cherry][checked]" value="1"> Cherry
            <input type="text" name="service[cherry][quantity]" placeholder="Quantity">
        </label>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
