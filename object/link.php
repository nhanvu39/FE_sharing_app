<?php
class Link
{
    private $conn;
    private $table_name = "link";

    //properties
    public $id;
    // public $kind;
    public $idSoftware;
    public $version;
    public $linkWindows;
    public $linkLinux;
    public $linkMac;

    //constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read all links 
    function read($from_record_num, $records_per_page)
    {

        //SELECT all product query
        $query = "SELECT 
                    *
                FROM
                    " . $this->table_name;

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

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

    //used for listing version
    public function getDistinctVersion($idSoftware)
    {
        //query to count all products records
        $query = "SELECT DISTINCT version FROM " . $this->table_name . " WHERE idSoftware =" . $idSoftware;
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query 
        $stmt->execute();

        return $stmt;
    }

    // used when filling up the update product form
    function readOne($idSoft, $version)
    {

        // query to select single record
        $query = "SELECT
                    linkWindows, linkLinux, linkMac, version
                FROM
                    " . $this->table_name . "
                WHERE
                    idSoftware = $idSoft and version = '$version'
             ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->id = htmlspecialchars(strip_tags($this->id));

        // bind product id value
        // $stmt->bindParam(1, $idSoft);
        // $stmt->bindParam(1, $version);

        // execute query
        $stmt->execute();
        // echo $query;

        // get row values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // assign retrieved row value to object properties
        $this->linkLinux = $row["linkLinux"];
        $this->linkMac = $row["linkMac"];
        $this->linkWindows = $row["linkWindows"];
        // $this->kind = $row['kind'];
        $this->version = $row['version'];
    }
}
