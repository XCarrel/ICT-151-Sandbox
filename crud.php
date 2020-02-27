<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/

function getPDO()
{
    require ".const.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;
}

function getAllFilmMakers()
{
    $dbh = getPDO();
    try {
        $query = 'SELECT * FROM filmmakers';
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getFilmMaker($id)
{
    $dbh = getPDO();
    try {
        $query = "SELECT * FROM filmmakers WHERE id=$id";
        $statment = $dbh->prepare($query);//prepare query
        $statment->execute();//execute query
        $queryResult = $statment->fetch(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getFilmMakerByName ($name)
{
    try {
        $dbh = getPDO();
        $query = "SELECT * FROM filmmakers WHERE lastname='$name'";
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetch(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function updateFilmMaker($filmMaker)
{
    try {
        $dbh = getPDO();
        $query = "UPDATE filmmakers SET  
                    filmmakersnumber=:filmmakersnumber, 
                    firstname=:firstname, 
                    lastname=:lastname, 
                    birthname=:birthname, 
                    nationality=:nationality 
                WHERE id=:id";
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute($filmMaker);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return false;
    }
}
function createFilmMaker($filmMaker)
{
    try {
        $dbh = getPDO();
        $query = "INSERT INTO filmmakers (filmmakersnumber,firstname,lastname,birthname,nationality) VALUES (:filmmakersnumber, :firstname, :lastname, :birthname, :nationality)";
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute($filmMaker);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return false;
    }
}

