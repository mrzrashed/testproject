<?php

$conn = db_connection();
$user_id = get_ses('user_id');

//edit table by ajax
if (isset($_POST['form']) && $_POST['form'] = "editDetails") {

    $token = $_POST["token"];

    if (get_ses('token') === $token) {

        $eid = $_POST["id"];
        $cname = $_POST['cname'];
        $text = $_POST["text"];


        $sql = "UPDATE style SET " . $cname . "='" . $text . "' WHERE StyleID = '" . $eid . "'";
        if (mysqli_query($conn, $sql)) {
            echo 'Data Updated';
        } else {
            echo $sql . "<br>" . mysqli_error($conn);
        }
    }
    die();
}

//Delete item requiremwnts
if (isset($_GET['delete'])) {
    $itemid = $_GET['delete'];
    $id = $_GET['id'];
    $sql = "DELETE FROM itemrequirment WHERE ItemRequirmentID=" . $itemid;

    if (mysqli_query($conn, $sql)) {
        notice('success', 'Item Deleted Successfully');
        nowgo('/index.php?page=single_style&id=' . $id);
    } else {
        notice('error', $sql . "<br>" . mysqli_error($conn));
    }
}

//delete trims & Accessories
if (isset($_GET['deletet'])) {
    $tid = $_GET['deletet'];
    $id = $_GET['id'];
    $sql = "DELETE FROM trimsaccess where TrimsAccessID=" . $tid;

    if (mysqli_query($conn, $sql)) {
        notice('success', 'TRIMS & ACCESSORIES Deleted Successfully');
        nowgo('/index.php?page=single_style&id=' . $id);
    } else {
        notice('error', $sql . "<br>" . mysqli_error($conn));
    }
}

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
} else {
    nowgo('/index.php?page=all_style');
}

if (isset($_POST['size']) && isset($_POST['item']) && isset($_POST['qty'])) {
    //array Item Requirments
    $size = $_POST['size'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];


    for ($i = 0; $i < sizeof($size); $i++) {
        if ($size[$i] != '') {
            $sqli = "INSERT INTO itemrequirment (ItemRequirmentStyleID,ItemRequirmentItemID,ItemRequirmentSize,ItemRequirmentQty,AddedBy)

            values('$id','$item[$i]','$size[$i]','$qty[$i]','$user_id')";

            if (mysqli_query($conn, $sqli)) {
                notice('success', 'New Item Added Successfully.');
                nowgo('/index.php?page=single_style&id=' . $id);
            } else {
                notice('error', $sql . "<br>" . mysqli_error($conn));
            }
        }
    }
}


if (isset($_POST['trim_name']) && isset($_POST['trim_description'])) {
    //array TRIMS & ACCESSORIES
    $trim_name = $_POST['trim_name'];
    $trim_description = $_POST['trim_description'];

    for ($i = 0; $i < sizeof($trim_name); $i++) {

        if ($trim_name[$i] != '') {
            $sql = "INSERT INTO trimsaccess (TrimsAccessStyleID,TrimsAccessName,TrimsAccessDescription,AddedBy)

		   		values('$id','$trim_name[$i]','$trim_description[$i]','$user_id')";

            if (mysqli_query($conn, $sql)) {
                notice('success', 'New TRIMS & ACCESSORIES Added Successfully.');
                nowgo('/index.php?page=single_style&id=' . $id);
            } else {
                notice('error', $sql . "<br>" . mysqli_error($conn));
            }
        }
    }
}



$sql = "SELECT * FROM style where StyleID='$id'";

$item = mysqli_fetch_assoc(mysqli_query($conn, $sql));


function getDivision($ssid)
{
    global $conn;
    $sql = "SELECT po.Division FROM po LEFT JOIN order_description ON  po.POID = order_description.POID WHERE order_description.StyleID = '$ssid'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if ($result) {
        return $result['Division'];
    } else {
        return 'No Related PO Found';
    }
}

function getPrice($ssid)
{
    global $conn;
    $sql = "SELECT masterlc_description.Price, masterlc_description.StyleID, masterlc.MasterLCCurrency FROM masterlc_description LEFT JOIN masterlc ON masterlc_description.MasterLCID = masterlc.MasterLCID WHERE masterlc_description.StyleID = '$ssid'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if ($result) {
        return $result['MasterLCCurrency'] . " " . $result['Price'];
    } else {
        return 'No Related LC Found';
    }
}
