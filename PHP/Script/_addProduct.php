<?php
if(isset($_POST['step1'])){
    $datas = array();
    $name = htmlspecialchars(trim($_POST['name']));
    $desc = htmlspecialchars(trim($_POST['desc']));
    $price = htmlspecialchars(trim($_POST['price']));
    $dj = htmlspecialchars(trim($_POST['dj']));
    $correct = true;
    //check if the Full Name format is correct (letter within 2 and 5 char)
    if(!preg_match('/^[a-zA-Z0-9 ]{5,32}$/', $name)) {
        $correct = false;
        echo '<div class="alert alert-danger" role="alert"><strong>Name!</strong> 5 - 32 letters, numbers & spaces only</div>';
    }
    //check if the Full Name format is correct (letter within 2 and 5 char)
    if(!preg_match('/^[0-9]+((\.)?[0-9]+)?$/', $price)) {
        $correct = false;
        echo '<div class="alert alert-danger" role="alert"><strong>Price!</strong> Wrong format</div>';
    }
    if(strlen($desc) < 6 || strlen($desc) > 200){
        $correct = false;
        echo '<div class="alert alert-danger" role="alert"><strong>Description!</strong> 6 - 200 characters</div>';
    }
    //file check
    $target_dir = "images/equip/";
    $target_file = $target_dir . basename($_FILES["pic"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["pic"]["tmp_name"]);
    if($check == false) {
        $correct = false;
        echo "File is an image - " . $check["mime"] . ".";
    }
    // Check if file already exists
    // if (file_exists($target_file)) {
    //     // $correct = false;
    //     echo "Sorry, file already exists.";
    // }
    // Check file size
    if ($_FILES["pic"]["size"] > 2200000) {
        $correct = false;
        echo "Sorry, your file is too large. > 2Mb";
    }
    // Allow certain file formats
    if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg" ) {
        $correct = false;
        echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    }
    //if all is alright ($correct === true) we insert the value
    if($correct){
        $data = array( $name, $desc, $price, $dj );
        $equ = $db->prepare('INSERT INTO equipments (name, description, price, dj, creation) VALUES (?,?,?,?,NOW())');
        if($equ->execute($data)){
            $last = $db->lastInsertId();
            $n = 'eq_' . $last . '.jpg';
            if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_dir . $n)) {
                echo '<div class="alert alert-success" role="alert"><strong>Success!</strong> equipement added</div>';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
if(isset($_POST['update'])){
    $datas = array();
    $name = htmlspecialchars(trim($_POST['name']));
    $desc = htmlspecialchars(trim($_POST['desc']));
    $price = htmlspecialchars(trim($_POST['price']));
    $dj = htmlspecialchars(trim($_POST['dj']));
    $correct = true;
    //check if the Full Name format is correct (letter within 2 and 5 char)
    if(!preg_match('/^[a-zA-Z0-9 ]{5,32}$/', $name)) {
        $correct = false;
        echo '<div class="alert alert-danger" role="alert"><strong>Name!</strong> 5 - 32 letters, numbers & spaces only</div>';
    }
    //check if the Full Name format is correct (letter within 2 and 5 char)
    if(!preg_match('/^[0-9]+((\.)?[0-9]+)?$/', $price)) {
        $correct = false;
        echo '<div class="alert alert-danger" role="alert"><strong>Price!</strong> Wrong format</div>';
    }
    if(strlen($desc) < 6 || strlen($desc) > 200){
        $correct = false;
        echo '<div class="alert alert-danger" role="alert"><strong>Description!</strong> 6 - 200 characters</div>';
    }
    //if all is alright ($correct === true) we insert the value
    if($correct){
        $data = array( $name, $desc, $price, $dj, $_GET['id'] );
        $equ = $db->prepare('UPDATE equipments SET name = ?, description = ?, price = ?, dj = ? WHERE id = ?');
        if($equ->execute($data)){
            if(!empty($_FILES['pic']['name'])){
                $last = $_GET['id'];
                //file check
                $target_dir = "images/equip/";
                $target_file = $target_dir . basename($_FILES["pic"]["name"]);
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["pic"]["tmp_name"]);
                if($check == false) {
                    $correct = false;
                    echo "File is an image - " . $check["mime"] . ".";
                }
                // Check file size
                if ($_FILES["pic"]["size"] > 2200000) {
                    $correct = false;
                    echo "Sorry, your file is too large. > 2Mb";
                }
                // Allow certain file formats
                if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg" ) {
                    $correct = false;
                    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
                }
                $n = 'eq_' . $last . '.jpg';
                if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_dir . $n)) {
                    echo '<div class="alert alert-success" role="alert"><strong>Success!</strong> equipement updated with picture</div>';
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            else {
                echo '<div class="alert alert-success" role="alert"><strong>Success!</strong> equipement updated</div>';
            }
        }
    }
}
