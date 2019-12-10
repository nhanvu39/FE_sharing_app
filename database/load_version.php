<?php
    //fetch.php
    if(isset($_POST["idApp"])){
        $connect = mysqli_connect("localhost", "root", "", "ass");
        $columns = array('version', 'link1', 'link2','link3');
        $id = $_POST["idApp"];
        $query = "SELECT * FROM link WHERE idSoftware='$id' ";

        if(isset($_POST["search"]["value"]))
        {
            $query .= 'AND version LIKE "%'.$_POST["search"]["value"].'%" ';
        }
    
        if(isset($_POST["order"]))
        {
            $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
        }
        else
        {
            $query .= 'ORDER BY id DESC ';
        }
    
        $query1 = '';
    
        if($_POST["length"] != -1)
        {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
    
        $number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));
    
        $result = mysqli_query($connect, $query . $query1);
    
        $data = array();
    
        while($row = mysqli_fetch_array($result))
        {
            $sub_array = array();
            $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="version">' . $row["version"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="link1">' . $row["link1"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="link2">' . $row["link2"] . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="link3">' . $row["link3"] . '</div>';
            $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
            $data[] = $sub_array;
        }
    
        function get_all_data($connect,$id)
        {
            $query = "SELECT * FROM link WHERE idSoftware='$id'";
            $result = mysqli_query($connect, $query);
            return mysqli_num_rows($result);
        }
    
        $output = array(
        "draw"    => intval($_POST["draw"]),
        "recordsTotal"  =>  get_all_data($connect,$id),
        "recordsFiltered" => $number_filter_row,
        "data"    => $data
        );
    
        echo json_encode($output);
    }
?>
