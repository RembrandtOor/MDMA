<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDMA - settings</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/playlist.css">

</head>

<body>
    <div class="container flex-center h-100">
        <a href="<?= route('index'); ?>" class="logo text-center">MDMA</a>
        <h1 class="text-left text-light">Settings</h1>
        <div class="splitter"></div>
        <div>
            <input type="checkbox" id="setting1" name="setting1" checked>
            <label for="setting1">Setting 1<br>Explanation setting 1</label>
            <!--             <h5>Explanation setting1</h5> -->
        </div>
        <br>
        <div>
            <input type="checkbox" id="setting2" name="setting2" checked>
            <label for="setting2">Setting 2<br>Explanation setting 2</label>

        </div>
        <br>
        <div>
            <input type="checkbox" id="setting3" name="setting3" checked>
            <label for="setting3">Setting 3<br>Explanation setting 3</label>
        </div><br>
        <div>
            <input type="checkbox" id="setting4" name="setting4" checked>
            <label for="setting4">Setting 4<br>Explanation setting 4</label>
        </div>
        <br>
        <div>
            <input type="checkbox" id="setting5" name="setting5" checked>
            <label for="setting5">Setting 5<br>Explanation setting 5</label>
        </div>

        <br>

        <div>
            <form action="" method="post">
            <input type="submit" id="deleteAccount" name="DeleteUser" value="Delete Account">
            </form>
        </div>
    </div>
</body>

</html>