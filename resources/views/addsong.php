<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDMA - Add song</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/register.css">
    </head>
    <body>
        <div class="container flex-center h-100">
            <form method="POST" action="" class="login-container">
                <a href="<?= route('index'); ?>" class="logo text-center">MDMA</a>
                <h1 class="text-center text-light">Upload song</h1>

                <div class="form-group">
                    <label>Upload your mp3 file</label>
                    <input type = "file" name="songfile" accept = ".mp3"/>
                </div>
                
                <div class="form-group">
                    <label>Song name</label>
                    <input type="text" name="songname" placeholder="Songname">
                </div>

                <div class="form-group">
                    <label>Artist</label>
                    <input type="text" name="artist" placeholder="Artist">
                </div>

                <div class="btn-right">
                    <button type="submit" class="btn btn-primary">Add song</button>
                </div>
            </form>
        </div>
    </body>
</html>