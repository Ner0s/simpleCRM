<?php

class Customer
{
    private $customerTable = 'customer';
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createRecords($result)
    {
        $records = array();
        while ($customer = $result->fetch_assoc()) {
            $rows = array();
            $rows[] = $customer['customer_nr'];
            $rows[] = ucfirst($customer['first_name']);
            $rows[] = ucfirst($customer['last_name']);
            $rows[] = $customer['company'];
            $rows[] = $customer['address'];
            $rows[] = $customer['city'];
            $rows[] = $customer['country'];
            $rows[] = $customer['zip'];
            $rows[] = $customer['phone'];
            $rows[] = $customer['email'];
            $rows[] = $customer['create_date'];
            $rows[] = '<button type="button" name="update" id="' . $customer["customer_nr"] . '" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit"></span></button>';
            $rows[] = '<button type="button" name="delete" id="' . $customer["customer_nr"] . '" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete"></span></button>';
            $records[] = $rows;
        }

        return $records;
    }

    public function listCustomer()
    {
        $sqlQuery = "SELECT * FROM " . $this->customerTable;

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        $displayRecords = $result->num_rows;

        $records = $this->createRecords($result);

        $output = array(
            "draw" => intval($_POST["draw"]),
            "iTotalRecords" => $displayRecords,
            "iTotalDisplayRecords" => $displayRecords,
            "data" => $records
        );

        echo json_encode($output);
    }

    public function findCustomer()
    {
        if ($this->search_value) {
            $search_value = $this->search_value;
            $sqlQuery = "
			SELECT *  FROM " . $this->customerTable . "
			WHERE (`customer_nr` LIKE ? 
			OR `first_name` LIKE ? 
			OR `last_name` LIKE ? 
			OR `company` LIKE ? 
			OR `address` LIKE ? 
			OR `city` LIKE ? 
			OR `country` LIKE ? 
			OR `zip` LIKE ? 
			OR `phone` LIKE ? 
			OR `email` LIKE ?)";
            $stmt = $this->conn->prepare($sqlQuery);

            $search_value = htmlspecialchars(strip_tags($search_value));

            $stmt->bind_param("issssssiis", $search_value, $search_value, $search_value, $search_value, $search_value, $search_value, $search_value, $search_value, $search_value, $search_value);
            $stmt->execute();
            $result = $stmt->get_result();

            $displayRecords = $result->num_rows;

            $records = $this->createRecords($result);

            $output = array(
                "draw" => intval($_POST["draw"]),
                "iTotalRecords" => $displayRecords,
                "iTotalDisplayRecords" => $displayRecords,
                "data" => $records
            );

            echo json_encode($output);
        }
    }

    public function insert()
    {

        if ($this->first_name) {

            $stmt = $this->conn->prepare("
			INSERT INTO " . $this->customerTable . "(`first_name`, `last_name`, `company`, `address`, `city`, `country`, `zip`, `phone`, `email`)
			VALUES(?,?,?,?,?,?,?,?,?)");

            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->company = htmlspecialchars(strip_tags($this->company));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->city = htmlspecialchars(strip_tags($this->city));
            $this->country = htmlspecialchars(strip_tags($this->country));
            $this->zip = htmlspecialchars(strip_tags($this->zip));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));

            $stmt->bind_param("ssssssiis", $this->first_name, $this->last_name, $this->company, $this->address, $this->city, $this->country, $this->zip, $this->phone, $this->email);

            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public function getCustomer()
    {
        if ($this->customer_nr) {
            $sqlQuery = "
			SELECT `customer_nr`, `first_name`, `last_name`, `company`, `address`, `city`, `country`, `zip`, `phone`, `email` 
			FROM " . $this->customerTable . "
			WHERE `customer_nr` = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bind_param("i", $this->customer_nr);
            $stmt->execute();
            $result = $stmt->get_result();
            $record = $result->fetch_assoc();
            echo json_encode($record);
        }
    }

    public function update()
    {
        if ($this->customer_nr) {
            $stmt = $this->conn->prepare("
			UPDATE " . $this->customerTable . " 
			SET first_name = ?, last_name = ?, company = ?, address = ?, city = ?, country = ?, zip = ?, phone = ?, email = ?
			WHERE customer_nr = ?");
            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->company = htmlspecialchars(strip_tags($this->company));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->city = htmlspecialchars(strip_tags($this->city));
            $this->country = htmlspecialchars(strip_tags($this->country));
            $this->zip = htmlspecialchars(strip_tags($this->zip));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));

            $stmt->bind_param("ssssssiisi", $this->first_name, $this->last_name, $this->company, $this->address, $this->city, $this->country, $this->zip, $this->phone, $this->email, $this->customer_nr);

            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public function delete()
    {
        if ($this->customer_nr) {

            $stmt = $this->conn->prepare("
				DELETE FROM " . $this->customerTable . " 
				WHERE customer_nr = ?");

            $this->customer_nr = htmlspecialchars(strip_tags($this->customer_nr));

            $stmt->bind_param("i", $this->customer_nr);

            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }
}