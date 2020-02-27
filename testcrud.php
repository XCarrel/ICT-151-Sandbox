<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/
require_once "crud.php";

function testGetAllFilmMakers()
{
    echo "Test unitaire de la fonction getAllItems : ";
    $items = getAllFilmMakers();

    if (count($items) == 4)
    {
        echo 'OK !!!';
    }
    else
    {
        echo 'BUG !!!';
    }
    echo "\n";
}

function testGetFilmMaker($id)
{
    echo "Test unitaire de la fonction getItem : ";
    $item = getFilmMaker(3);
    if ($item['firstname'] == 'Luc-Olivier')
    {
        echo 'OK !!!';
    }
    else
    {
        echo 'BUG !!!';
    }
    echo "\n";
}

function testGetFilmMakerByName($name)
{
    echo "Test unitaire de la fonction getFilmMakerName : ";
    $item = getFilmMakerByName('Chamblon');
    if ($item['id'] == 3)
    {
        echo 'OK !!!';
    }
    else
    {
        echo '### BUG ###';
    }
    echo "\n";
}

function testUpdateFilmMaker($filmMaker)
{
    echo "Test unitaire de la fonction updateFilmMaker : ";
    $item = getFilmMakerByName('Chamblon');
    $id = $item['id']; // se souvenir de l'id pour comparer
    $item['firstname'] = 'Gérard';
    $item['lastname'] = 'Menfain';
    updateFilmMaker($item);
    $readback = getFilmMaker($id);
    if (($readback['firstname'] == 'Gérard') && ($readback['lastname'] == 'Menfain'))
    {
        echo 'OK !!!';
    }
    else
    {
        echo '### BUG ###';
    }
    echo "\n";
}


// ############################## Tests unitaires ####################

// Recharger la base de données pour être sûr à 100% des données de test

require ".const.php";
$cmd = "mysql -u $user -p$pass < Restore-MCU-PO-Final.sql";
exec($cmd);

testGetFilmMaker();
testGetFilmMakerByName();
testGetAllFilmMakers();
testUpdateFilmMaker();
