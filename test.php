<?php

// 1. VERIFIER SI IMAGE BIEN RECU

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        
    
    $error = 1;
    // 2. VERIFIER LA TAILLE D'IMAGE

    if ($_FILES['image']['size'] <= 3000000) {
        
        // 3. VERIFIER L'EXTENSION (TYPE DE FILE) 

        $informationsImage = pathinfo($_FILES['image']['name']);

        $extensionImage = $informationsImage['extension'];

        $extensionsArray = array('jpg', 'jpeg', 'png', 'gif'); 

        // COMPARER SI EXTENSION DE FILE ET EGALEMENT PRESENT DANS TABLEAU D'EXTENSION
        
        if(in_array($extensionImage, $extensionsArray)) 

        {
            // ENVOYER FICHIER

            $address = 'uploads/'.time().rand().rand() . '.' .$extensionImage;

            move_uploaded_file($_FILES['image']['tmp_name'], $address);

            $error = 0;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Hébergeur d'images gratuit</title>
</head>

<body>
    <div class="container">
        <h1>MyCloud</h1>    
        <?php
        if(isset($error) && $error == 0) {
            echo '<img src = "' .$address. '" id="image" />
            
            <input type="text" value="http://localhost/'.$address.'"/>';
        }elseif (isset($error) && $error == 1) {
            echo 'Votre image ne peut pas etre envoyée. Vérifiez sn extenssion et sa taille (maximum à 3 mo)';
        }


        ?>
        <p>Hebergeur Image</p>

        <div class="wrapper">

            <form method="POST" action="test.php" enctype="multipart/form-data">
                <input type="file" required name="image">
                <button type="submit">Héberger</button>
            </form>

        </div>
    </div>
</body>

</html>