<?php

    require 'database.php';

    if (!empty($_GET['id'])) {
        $id = checkInput($_GET['id']);
    }

    if (!empty($_POST)) {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM items WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
    }

    function checkInput($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcom to your Burger Shop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>

        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span> Burger Shop Admin <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        
        <div class="container admin">

            <div class="row">

                <h1><strong>Supprimer un item</strong></h1>
                <br>
                <form class="form" role="form" method="post" action="delete.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <p class="alert alert-warning">Êtes-vous sûr de vouloir supprimer l'item ?</p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Oui</button>
                        <a href="index.php" class="btn btn-default">Non</a>
                    </div>   
                </form>

            </div>

        </div>

    </body>
</html>