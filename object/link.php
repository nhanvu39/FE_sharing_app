<?php
class Link
{
    private $conn;
    private $table_name = "link";

    //properties
    public $id;
    public $linkDownload;
    public $kind;
    public $idSoftware;
    public $version;

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

    //used for listing downloadLink
    public function getLinkDownload($version, $kind)
    {
        //query to count all products records
        $query = "SELECT linkDownload from link where version = '" . $version . "' and kind = '" . $kind . "' ";
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query 
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->linkDownload = $row["linkDownload"];
    }

    // used when filling up the update product form
    function readOne()
    {

        // query to select single record
        $query = "SELECT
                    linkDownload, kind, version
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
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
        $this->linkDownload = $row['linkDownload'];
        $this->kind = $row['kind'];
        $this->version = $row['version'];
    }
}
