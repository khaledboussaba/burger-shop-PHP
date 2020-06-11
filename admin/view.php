<?php

    require 'database.php';

    if (!empty($_GET['id'])) {
        $id = checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT i.id, i.name, i.description, i.price, i.image, c.name AS categoryName 
                                FROM items i LEFT JOIN categories c 
                                ON i.category = c.id
                                WHERE i.id = ?;
                            ');

    $statement->execute(array($id));

    $item = $statement->fetch();

    Database::disconnect();



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

                <div class="col-sm-6">
                    <h1><strong>Voir un item</strong></h1>
                    <br>
                    <form>
                        <div class="form-group">
                            <label>Nom:</label><?php echo ' '. $item['name']; ?>
                        </div>
                        <div class="form-group">
                            <label>Description:</label><?php echo ' '. $item['description']; ?>
                        </div>
                        <div class="form-group">
                            <label>Prix:</label><?php echo ' '. number_format((float)$item['price'], 2, '.', '') . ' €'; ?>
                        </div>
                        <div class="form-group">
                            <label>Catégorie:</label><?php echo ' '. $item['categoryName']; ?>
                        </div>
                        <div class="form-group">
                            <label>Image:</label><?php echo ' '. $item['image']; ?>
                        </div>
                    </form>
                    <br>
                    <div class="form-actions">
                        <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div>

               
                <div class="col-sm-6">
                    <div class="thumbnail site">
                        <img src="<?php echo '../images/' .  $item['image']; ?>" alt="...">
                        <div class="price"><?php echo number_format((float)$item['price'], 2, '.', '') . ' €'; ?></div>
                        <div class="caption">
                            <h4><?php echo $item['name']; ?></h4>
                            <p><?php echo ' '. $item['description']; ?></p>
                        </div>
                    </div>
                </div>
                
   
            </div>

        </div>

    </body>
</html>