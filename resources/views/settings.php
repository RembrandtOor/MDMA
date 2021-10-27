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
            <br>
            <input type="checkbox" id="setting1" name="setting1" checked>
            <label for="setting1">&nbsp Setting 1<br>Explanation setting 1</label>
            <br>
        </div>
        <div>
            <br>
            <input type="checkbox" id="setting2" name="setting2" checked>
            <label for="setting2">&nbsp Setting 2<br>Explanation setting 2</label>
            <br>
        </div>

        <div>
            <br>
            <input type="checkbox" id="setting3" name="setting3" checked>
            <label for="setting3">&nbsp Setting 3<br>Explanation setting 3</label>
            <br>
        </div>
        <div>
            <br>
            <input type="checkbox" id="setting4" name="setting4" checked>
            <label for="setting4">&nbsp Setting 4<br>Explanation setting 4</label>
            <br>
        </div>
        <div>
            <br>
            <input type="checkbox" id="setting5" name="setting5" checked>
            <label for="setting5">&nbsp Setting 5<br>Explanation setting 5</label>
            <br>
        </div>

        <div>
            <br>
            <label for="cars">Setting 6:</label>
            <br>

            <select name="settings_6" id="settings_6">
                <option value="option1">option 1</option>
                <option value="option2">option 2</option>
                <option value="option3">option 3</option>
                <option value="option4">option 4</option>
            </select>
            <br>
        </div>
        <div>
            <br>
            <br>
            <label for="setting4">&nbsp Setting 7 &nbsp &nbsp Explanation setting 7</label>
            <br>
            <input type="range" id="brightness-range" min="10" max="100" value="100" onchange="fun(this)">
        </div>
        <div class="btn-right">
            <a href="#" class="btn btn-primary btn-xS">Confirm</a>
        </div>

        <br>

        <div>
            <form action="" method="post">
            <input type="submit" class="btn btn-primary btn-xS" id="deleteAccount" name="DeleteUser" value="Delete Account">
            </form>
        </div>
    </div>
    
    <script src="<?= asset('js/main.js') ?>"></script>
</body>

</html>