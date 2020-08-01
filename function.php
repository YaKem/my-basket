<?php

function createBasket() {
    if(!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];   
    }
    return true;
}

function addItem($name, $quantity, $price, $id = null) {
    if(createBasket()) {
        if($id == null) {
            $res = false;
            for($i = 0; $i < count($_SESSION['basket']); $i++) {
                if($_SESSION['basket'][$i]['name'] == $name && $_SESSION['basket'][$i]['price'] == $price) {
                    $_SESSION['basket'][$i]['quantity'] += $quantity;
                    $res = true;
                }
            }
            if($res != true) {
                $_SESSION['basket'][] = [
                    'name'     => $name,
                    'quantity' => $quantity,
                    'price'    => $price
                ];
            }
        } else {
            if($_SESSION['basket'][$id]['name'] != $name) {
                $_SESSION['basket'][$id]['name'] = $name;
            }
            if($_SESSION['basket'][$id]['quantity'] != $quantity) {
                $_SESSION['basket'][$id]['quantity'] = $quantity;
            }
            if($_SESSION['basket'][$id]['price'] != $price) {
                $_SESSION['basket'][$id]['price'] = $price;
            }
        }
    }
}

function removeItem($id) {
    if(createBasket()) {
        
        if(array_key_exists(intval($id), $_SESSION['basket'])) {
            // var_dump($_SESSION['basket']);
            $length = count($_SESSION['basket']);
            
            if($length == 1) {
    
                $_SESSION['basket'] = [];
    
            } else {
    
                $tmp = [];
    
                for($i = 0; $i < $length; $i++){
                    echo $i;
                    if($i != $id) {
                        $tmp[] = $_SESSION['basket'][$i];
                    }
                }
    
                $_SESSION['basket'] = $tmp;
                unset($tmp);    
            }
        }   
    }      
}

function removeBasket() {
    unset($_SESSION['basket']);
}

function getTotal() {
    $total = 0;
    for($i = 0; $i < count($_SESSION['basket']); $i++) {
        $total += $_SESSION['basket'][$i]['quantity'] * $_SESSION['basket'][$i]['price'];
    }

    return $total;
}

function setInputVal($name, $id) {
    $_SESSION['input'][$name] = $_SESSION['basket'][$id][$name];
}

?>