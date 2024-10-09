<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
    </style>
</head>
<body>
    <h1>500</h1>
    <?php if(isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <p>Oops! Parece que ha habido algún problema.</p>
    <p><a href="/">Go back to the homepage</a></p>
</body>
</html>