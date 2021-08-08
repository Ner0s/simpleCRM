<?php
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listCustomer') {
    $customer->listCustomer();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addCustomer') {
    $customer->first_name = $_POST["first_name"];
    $customer->last_name = $_POST["last_name"];
    $customer->company = $_POST["company"];
    $customer->address = $_POST["address"];
    $customer->city = $_POST["city"];
    $customer->country = $_POST["country"];
    $customer->zip = $_POST["zip"];
    $customer->phone = $_POST["phone"];
    $customer->email = $_POST["email"];
    $customer->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getCustomer') {
    $customer->customer_nr = $_POST["id"];
    $customer->getCustomer();
}

if(!empty($_POST['action']) && $_POST['action'] == 'findCustomer') {
    $customer->search_value = $_POST["search"]["value"];
    $customer->findCustomer();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateCustomer') {
    $customer->customer_nr = $_POST["id"];
    $customer->first_name = $_POST["first_name"];
    $customer->last_name = $_POST["last_name"];
    $customer->company = $_POST["company"];
    $customer->address = $_POST["address"];
    $customer->city = $_POST["city"];
    $customer->country = $_POST["country"];
    $customer->zip = $_POST["zip"];
    $customer->phone = $_POST["phone"];
    $customer->email = $_POST["email"];
    $customer->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteCustomer') {
    $customer->customer_nr = $_POST["id"];
    $customer->delete();
}
