<?php

require "crud.php";
require ".const.php";
$cmd = "mysql -u $user -p$pass < Restore-MCU-PO-Final.sql";
exec($cmd);
/////////////////////////////////////////////////////////////////
// 1. A nice name change using parameters in the PDO query
/////////////////////////////////////////////////////////////////

// Simulation of values entered in a form
$_POST['id'] = 1;
$_POST['fname'] = "James";
$_POST['lname'] = "Bond";

//Real code from here...
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$fm = getFilmMaker($id);
$fm['lastname']=$lname;
$fm['firstname']=$fname;
updateFilmMaker($fm);

/////////////////////////////////////////////////////////////////
// 2. A nice name change NOT using parameters in the PDO query
/////////////////////////////////////////////////////////////////

// Simulation of values entered in a form
$_POST['id'] = 2;
$_POST['fname'] = "Miss";
$_POST['lname'] = "Monneypenny";

//Real code from here...
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$fm = getFilmMaker($id);
$fm['lastname']=$lname;
$fm['firstname']=$fname;
BADupdateFilmMaker($fm);

/////////////////////////////////////////////////////////////////
// 3. A vicious name change using parameters in the PDO query
/////////////////////////////////////////////////////////////////

// Simulation of values entered in a form
$_POST['id'] = 3;
$_POST['fname'] = "'+(SELECT 256*256*ASCII(lastname)+256*ASCII(SUBSTRING(lastname,2))+ASCII(SUBSTRING(lastname,3)) FROM actors WHERE id=1)+'";
$_POST['lname'] = "'+(SELECT 256*256*ASCII(SUBSTRING(lastname,4))+256*ASCII(SUBSTRING(lastname,5))+ASCII(SUBSTRING(lastname,6)) FROM actors WHERE id=1)+'";
// Tricky, tricky, tricky !!!....

//Real code from here...
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$fm = getFilmMaker($id);
$fm['lastname']=$lname;
$fm['firstname']=$fname;
updateFilmMaker($fm);

/////////////////////////////////////////////////////////////////
// 4. A vicious name change NOT using parameters in the PDO query
/////////////////////////////////////////////////////////////////

// Simulation of values entered in a form
$_POST['id'] = 4;
$_POST['fname'] = "'+(SELECT 256*256*ASCII(lastname)+256*ASCII(SUBSTRING(lastname,2))+ASCII(SUBSTRING(lastname,3)) FROM actors WHERE id=1)+'";
$_POST['lname'] = "'+(SELECT 256*256*ASCII(SUBSTRING(lastname,4))+256*ASCII(SUBSTRING(lastname,5))+ASCII(SUBSTRING(lastname,6)) FROM actors WHERE id=1)+'";
// Tricky, tricky, tricky !!!....

//Real code from here...
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$fm = getFilmMaker($id);
$fm['lastname']=$lname;
$fm['firstname']=$fname;
BADupdateFilmMaker($fm);

function getBossName()
{
    return "Alice";
}
