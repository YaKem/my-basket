<?php

if(session_status() === 'PHP_SESSION_NONE') {
    session_start();
}

include 'function.php';
echo $_SERVER['REQUEST_METHOD'];
if(!empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price'])) {
    addItem($_POST['name'], $_POST['quantity'], $_POST['price']);
}


if(!empty($_GET['action']) && !empty($_GET['id'])) { 
    if($_GET['action'] === 'delete') {        
        removeItem($_GET['id']);
    } else if($_GET['action'] === 'empty') {
        removeBasket('basket');
    }
}

var_dump($_SESSION['basket']);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="./css/style.css" />
    <style>
        ul {
            list-style-type: none;
            margin-left: 0;
        }
        fieldset {
            width: 200px;
            padding: 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <?php if(!empty($_SESSION['basket'])): ?>
        <table border=1>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>            
            </thead>
            <tbody>        
                <?php for($i = 0;  $i < count($_SESSION['basket']); $i++): ?>
                    <tr>
                        <td><?= $_SESSION['basket'][$i]['name'] ?></td>
                        <td><?= $_SESSION['basket'][$i]['quantity'] ?></td>
                        <td><?= $_SESSION['basket'][$i]['price'] ?></td>
                        <td><a href="index.php?action=delete&id=<?= $i ?>">Delete</a></td>
                    </tr>
                <?php endfor ?>
            </tbody> 
            <tfoot>
                <tr>
                    <td colspan="4">
                        <a href="index.php?action=empty">Vider</a>
                    </td>
                </tr>
            </tfoot>  
        </table>
    <?php else: ?>
        <p>Basket vide</p>
    <?php endif ?>
    <form action="index.php" method="post">
        <fieldset>
            <ul>
                <li>
                    <label for="name">Nom: </label>
                    <input id="name" type="text" name="name" />
                </li>
                <li>
                    <label for="qty">Quantité: </label>
                    <input id="qty" type="text" name="quantity" />
                </li>
                <li>
                    <label for="prx">Prix: </label>
                    <input id="prx" type="text" name="price" />
                </li>
                <li>
                    <input type="submit" value="Ajouter" />
                </li>
            </ul>
        </fieldset>    
    </form>
</body>
</html>



