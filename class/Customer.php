<?php

class Customer
{
    private $customerTable = 'customer';
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listContact()
    {
        $sqlQuery = "SELECT * FROM " . $this->customerTable . "ORDER BY id ASC";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        $displayRecords = $result->num_rows;
        $records = array();
        while ($customer = $result->fetch_assoc()) {
            $rows = array();
            $rows[] = $customer['customer_nr'];
            $rows[] = ucfirst($customer['first_name']);
            $rows[] = ucfirst($customer['last_name']);
            $rows[] = $customer['company'];
            $rows[] = $customer['address'];
            $rows[] = $customer['city'];
            $rows[] = $customer['state'];
            $rows[] = $customer['country'];
            $rows[] = $customer['zip'];
            $rows[] = $customer['phone'];
            $rows[] = $customer['email'];
            $rows[] = $customer['website'];
            $rows[] = $customer['create_date'];
            $rows[] = '<button type="button" name="update" id="' . $customer["customer_nr"] . '" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit"></span></button>';
            $rows[] = '<button type="button" name="delete" id="' . $customer["customer_nr"] . '" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete"></span></button>';
            $records[] = $rows;
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "iTotalDisplayRecords" => $displayRecords,
            "data" => $records
        );

        echo json_encode($output);
    }

    public function insert()
    {

        if ($this->first_name) {

            $stmt = $this->conn->prepare("
			INSERT INTO " . $this->customerTable . "(`first_name`, `last_name`, `company`, `address`, `city`, `state`, `country`, `zip`, `phone`, `email`, `website`, `create_date`)
			VALUES(?,?,?,?,?,?)");

            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->company = htmlspecialchars(strip_tags($this->company));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->city = htmlspecialchars(strip_tags($this->city));
            $this->state = htmlspecialchars(strip_tags($this->state));
            $this->country = htmlspecialchars(strip_tags($this->country));
            $this->zip = htmlspecialchars(strip_tags($this->zip));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->website = htmlspecialchars(strip_tags($this->website));
            $this->create_date = htmlspecialchars(strip_tags($this->create_date));

            $stmt->bind_param("ssssssssiisss", $this->first_name, $this->last_name, $this->company, $this->address, $this->city, $this->state, $this->country, $this->zip, $this->phone, $this->email, $this->website, $this->create_date);

            if ($stmt->execute()) {
                return true;
            }
        }
    }
}