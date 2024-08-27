<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Example</title>
</head>
<body>
    <form action="process.php" method="post">
        <label>
            <input type="checkbox" name="fruits[]" value="apple"> Apple
        </label>
        <br>
        <label>
            <input type="checkbox" name="fruits[]" value="banana"> Banana
        </label>
        <br>
        <label>
            <input type="checkbox" name="fruits[]" value="cherry"> Cherry
        </label>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
