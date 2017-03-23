<?php 
	
$action = $_GET["action"];

if ($action=="edit"){
	header("Location: edit.php?id=" . $_GET['id']);

}elseif ($action=="delete"){
	include "delete.php";

}elseif ($action=="description"){
	include "description.php";
}
?>