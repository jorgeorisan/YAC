<?php

$_SERVER['HTTP_HOST']="";
include_once("../config/config.php");
include_once("../config/classes/db.class.php");
include_once("../config/classes/user.class.php");
include_once("../config/classes/blogpost.class.php");

$u = new User();
$us = $u->getAll(); 
print_r($us);
$us[1]->setInitials("BB");
$us[1]->updateFields(array('initials'));

$u->load(1);
print_r($u); 

die;
$u->load(1);
//$u->save();
$u->setFirstName("SELECT-' ONE.");
$u->setLastName("helo");
$u->setInitials("helo");
print_r($u);

$u->updateFields(array('initials'));

//$u->save();
$u->load(1);
print_r($u);
die;
echo "\n\n ****************************************** \n\n";
//if ($u->getValid()){echo "\n\nYYYYYY\n";}else{echo "\n\nNNNNN\n";}

$uu = new User();
$uu->setFirstName('Tom');
$uu->setLastName('Jones');
$uu->setInitials('TJ');
$uu->setEmail('tj@example.com');
$id = $uu->save();
echo $id;
 print_r($uu);

/*  [id:protected] => 1
    [email:protected] => msnod@illumant.com
    [firstName:protected] => TOnny
    [lastName:protected] => Snodgrassaa
    [initials:protected] => MFS
    [password:protected] => 
    [type:protected] => super
    [enabled:protected] => 1
    [deleted:protected] => 0
    [token:protected] => e871-aa65-8f4c
    [tokenExpires:protected] => 2017-04-07 20:29:53
    [modified:protected] => 2017-04-07 13:14:53
    [created:protected] => 2017-01-27 11:07:08
    [authorsummary:protected] => 
    [valid:protected] => 1
    [status:protected] => 
*/