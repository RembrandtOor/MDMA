<?php

class Addsong {
    
    public $file;
    public $songname;
    public $artist;

    public function __construct($file, $songname, $artist) {

        $this->file = $file;
        $this->songname = $songname;
        $this->artist = $artist;
    }

    public function addsong($file, $songname, $artist) {
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";

            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO songs (file, songname, artist)
            VALUES (:file, :songname, :artist)");

            $stmt->bindParam(':file', $file);
            $stmt->bindParam(':songname', $songname);
            $stmt->bindParam(':artist', $artist);

            $stmt->execute();

            echo "New records created successfully";
            
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    
    }
}   

?>