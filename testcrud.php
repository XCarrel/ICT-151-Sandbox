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

    if (count($items) == 4) {
        echo 'OK !!!';
    } else {
        echo 'BUG !!!';
    }
    echo "\n";
}

function testGetFilmMaker()
{
    echo "Test unitaire de la fonction getItem : ";
    $item = getFilmMaker(3);
    if ($item['firstname'] == 'Luc-Olivier') {
        echo 'OK !!!';
    } else {
        echo 'BUG !!!';
    }
    echo "\n";
}

function testGetFilmMakerByName()
{
    echo "Test unitaire de la fonction getFilmMakerByName : ";
    $item = getFilmMakerByName('Chamblon');
    if ($item['id'] == 3) {
        echo 'OK !!!';
    } else {
        echo '### BUG ###';
    }
    echo "\n";
}

function testUpdateFilmMaker()
{
    echo "Test unitaire de la fonction updateFilmMaker : ";
    $item = getFilmMakerByName('Chamblon');
    $id = $item['id']; // se souvenir de l'id pour comparer
    $item['firstname'] = 'Gérard';
    $item['lastname'] = 'Menfain';
    updateFilmMaker($item);
    $readback = getFilmMaker($id);
    if (($readback['firstname'] == 'Gérard') && ($readback['lastname'] == 'Menfain')) {
        echo 'OK !!!';
    } else {
        echo '### BUG ###';
    }
    echo "\n";
}

function testCreateFilmMaker()
{
    echo "Test unitaire de la fonction createFilmMaker : ";
    $item = [
        'firstname' => 'Paulo',
        'lastname' => 'Gramm',
        'filmmakersnumber' => '54321',
        'birthname' => '1987-12-21',
        'nationality' => 'FR'
    ];
    $nfm = countFilmMakers();
    $newFilmMaker = createFilmMaker($item);
    if (countFilmMakers() == $nfm + 1) {
        $readback = getFilmMaker($newFilmMaker['id']);
        if (($readback['firstname'] == 'Paulo') && ($readback['lastname'] == 'Gramm') && ($readback['filmmakersnumber'] == 54321) && ($readback['birthname'] == '1987-12-21') && ($readback['nationality'] == 'FR')) {
            echo 'OK !!!';
        } else {
            echo '### BUG (diff) ###';
        }
    } else {
        echo '### BUG (count) ###';
    }
    echo "\n";
}

function testDeleteFilmMaker()
{
    echo "Test unitaire de la fonction deleteFilmMaker : ";
    $onefm = getFilmMakerByName('Gramm');
    $nfm = countFilmMakers();
    if (deleteFilmMaker($onefm['id'])) {
        if (countFilmMakers() == $nfm - 1) {
            if (getFilmMaker($onefm['id']) == null) {
                echo 'OK !!!';
            } else {
                echo '### BUG (no delete) ###';
            }
        } else {
            echo '### BUG (count) ###';
        }
    } else {
        echo '### BUG (function) ###';
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
testCreateFilmMaker();
testDeleteFilmMaker();