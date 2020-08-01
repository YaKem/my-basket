<?php

session_start();

include 'function.php';

if(isset($_SESSION['input'])) {
    unset($_SESSION['input']);
    unset($id);
}

if(!empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price'])) {
    addItem($_POST['name'], $_POST['quantity'], $_POST['price'], $_POST['id']);
}

if(!empty($_GET['action'])) {
    if($_GET['action'] == 'modify' && isset($_GET['id'])) {
        $id = $_GET['id'];

        setInputVal('name', $id);
        setInputVal('quantity', $id);
        setInputVal('price', $id);

    } else if($_GET['action'] == 'delete' && isset($_GET['id'])) {      
        removeItem($_GET['id']);
    } else if($_GET['action'] == 'empty') {
        removeBasket();
    }
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <title>My PHP Basket</title>
    <script src="https://kit.fontawesome.com/ac5628c3f3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
    <div class="container">       
        <?php if(!empty($_SESSION['basket'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>            
                </thead>
                <tbody>        
                    <?php for($i = 0;  $i < count($_SESSION['basket']); $i++): ?>
                        <tr>
                            <td><?= $_SESSION['basket'][$i]['name'] ?></td>
                            <td><?= $_SESSION['basket'][$i]['quantity'] ?></td>
                            <td><?= $_SESSION['basket'][$i]['price'] ?></td>
                            <td><?= $_SESSION['basket'][$i]['quantity'] * $_SESSION['basket'][$i]['price'] ?>€</td>
                            <td>
                                <a href="index.php?action=modify&id=<?= $i ?>"><i class="fa fa-pen"></i></a>
                                <a href="index.php?action=delete&id=<?= $i ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endfor ?>
                </tbody> 
                <tfoot>
                    <tr>
                        <td>
                            <a href="index.php?action=empty"><i class="fa fa-recycle"></i></a>
                        </td>
                        <td colspan="4">
                            Total: <?= getTotal() ?>€
                        </td>
                    </tr>
                </tfoot>  
            </table>
        <?php else: ?>
            <div id="msg">
                <p>Basket vide</p>
            </div>
        <?php endif ?>
        <form action="index.php" method="post">
            <fieldset>
                <ul>
                    <input type="hidden" name="id" value="<?= $id ?? '' ?>">
                    <li>
                        <label for="name">Nom: </label>
                        <input id="name" type="text" name="name" value="<?= $_SESSION['input']['name'] ?? '' ?>" />
                    </li>
                    <li>
                        <label for="qty">Quantité: </label>
                        <input id="qty" type="text" name="quantity" value="<?= $_SESSION['input']['quantity'] ?? '' ?>" />
                    </li>
                    <li>
                        <label for="prx">Prix: </label>
                        <input id="prx" type="text" name="price" value="<?= $_SESSION['input']['price'] ?? '' ?>" />
                    </li>
                    <li>
                        <input type="submit" value="Ajouter" />
                    </li>
                </ul>
            </fieldset>    
        </form>
    </div>
</body>
</html>



