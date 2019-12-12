<?php
class Software
{
    private $conn;
    private $table_name = "software";

    //properties
    public $id;
    public $name;
    public $description;
    public $kind;
    public $loc;
    public $image;
    public $Ltype;

    // public $timestamp;

    //constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read all products 
    function read($from_record_num, $records_per_page)
    {

        //SELECT all product query
        $query = "SELECT 
                    id, name, description, kind, loc, image
                FROM
                    " . $this->table_name . "
                WHERE loc = 0";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //blind limti clause variables
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        //execute query
        $stmt->execute();

        //return value
        return $stmt;
    }

    // For search function
    function search($sample)
    {

        //SELECT all product query
        $query = "SELECT * FROM software WHERE name LIKE '%" . $sample . "%' and loc = 0";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();
        // echo $query;
        //return value
        return $stmt;
    }

    function getKind($id)
    {
        //select query
        $query = "SELECT kind
                FROM " . $this->table_name . "
                WHERE id = ?
            ";
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->id = $id;

        //bind product id variable
        $stmt->bindParam(1, $this->id);
        // execute query
        $stmt->execute();

        // return values
        return $stmt;
    }

    function getAllKind()
    {
        //select query
        $query = "SELECT DISTINCT kind
                FROM " . $this->table_name;
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // return values
        return $stmt;
    }

    //used for paging products
    public function count()
    {
        //query to count all products records
        $query = "SELECT count(*) FROM " . $this->table_name;

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query 
        $stmt->execute();

        //get row value
        $rows = $stmt->fetch(PDO::FETCH_NUM);

        //return count
        return $rows[0];
    }

    // used when filling up the update product form
    function readOne()
    {

        // query to select single record
        $query = "SELECT
                    name, image, description
                FROM
                    " . $this->table_name . "
                WHERE
                    id = " . $this->id .
            " LIMIT
                    0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind product id value
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get row values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // assign retrieved row value to object properties
        $this->name = $row['name'];
        $this->image = $row['image'];
        $this->description = $row['description'];
    }

    // read all product based on product ids included in the $ids variable
    // reference http://stackoverflow.com/a/10722827/827418
    public function readByIds($ids)
    {

        $ids_arr = str_repeat('?,', count($ids) - 1) . '?';

        // query to select products
        $query = "SELECT id, name FROM " . $this->table_name . " WHERE id IN ({$ids_arr}) ORDER BY name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute($ids);

        // return values from database
        return $stmt;
    }

    public function readfollowIdUser($id, $number)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idUser=:id LIMIT :number";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', (int) $id);
        $stmt->bindValue(':number', (int) $number, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
