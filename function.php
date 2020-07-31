<?php

function createBasket() {
    if(!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];   
    }
    return true;
}

function addItem($name, $quantity, $price, $id = null) {
    if(createBasket()) {
        if(array_key_exists($id, $_SESSION['basket'])) {
            $_SESSION['basket'][$id]['quantity']++;
        } else {
            $_SESSION['basket'][] = ['name' => $name, 'quantity' => $quantity, 'price' => $price];
        }
    }
}

function removeItem($id) {
    if(createBasket()) {
        $length = count($_SESSION['basket']);
        $tmp = [];
    
        for($i = 0; $i < $length; $i++){
            if($i !== $id) {
                $tmp[] = $_SESSION['basket'][$i];
            }
        }
        
        $_SESSION['basket'] = $tmp;
    
        unset($tmp);    
    }      
}

function removeBasket($name) {
    unset($_SESSION[$name]);
}

?>