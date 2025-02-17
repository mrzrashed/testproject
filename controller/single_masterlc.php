<?php
$conn = db_connection();

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
} else {
    nowgo('/index.php?page=all_master_lc');
}


$sqlp = "SELECT POID, PONumber FROM po";
$resultps = mysqli_query($conn, $sqlp);
$poArr = array();
while ($resultp = mysqli_fetch_assoc($resultps)) {
    $poArr[] = $resultp;
}

$sqls = "SELECT StyleID, StyleNumber FROM style";
$resultss = mysqli_query($conn, $sqls);
$styleArr = array();
while ($results = mysqli_fetch_assoc($resultss)) {
    $styleArr[] = $results;
}

//this function will return the value aginst ID from array
function searchForVal($id, $array, $IDcolumnName, $valueColumnName)
{
    for ($i = 0; $i < sizeof($array); $i++) {
        if ($array[$i][$IDcolumnName] == $id) {
            return $array[$i][$valueColumnName];
        }
    }
    return null;
}

$sql = "SELECT * FROM masterlc WHERE MasterLCID =  $id";
$mlc = mysqli_fetch_assoc(mysqli_query($conn, $sql));

if (isset($_POST['pono']) && isset($_POST['style']) && isset($_POST['qty']) && isset($_POST['unitname']) && isset($_POST['price']) && isset($_POST['lsdate'])) {
    //array MasterLC Description
    $pono  = $_POST['pono'];
    $style  = $_POST['style'];
    $qty  = $_POST['qty'];
    $unitname  = $_POST['unitname'];
    $price  = $_POST['price'];
    $lsdate  = $_POST['lsdate'];
    $user_id = get_ses('user_id');

    for ($i = 0; $i < sizeof($pono); $i++) {
        if ($pono[$i] != '') {

            $sql = "INSERT INTO masterlc_description (MasterLCID, POID, StyleID, Qty, Unit, Price, LSDate, AddedBy)

            values('$id','$pono[$i]','$style[$i]','$qty[$i]','$unitname[$i]','$price[$i]','$lsdate[$i]','$user_id')";

            if (mysqli_query($conn, $sql)) {
                notice('success', 'Master LC Orders Added Successfully.');
                nowgo('/index.php?page=single_masterlc&id=' . $id);
            } else {
                notice('error', $sql . "<br>" . mysqli_error($conn));
                die();
            }
        }
    }
}


if (
    isset($_POST['mlcnumber']) &&
    isset($_POST['mlcissuedate']) &&
    isset($_POST['mlcexpirydate']) &&
    isset($_POST['sender_bank']) &&
    isset($_POST['receiver_bank']) &&
    isset($_POST['buyer']) &&
    isset($_POST['lcissuedby']) &&
    isset($_POST['currency']) &&
    isset($_POST['amount']) &&
    isset($_POST['partialshipment']) &&
    isset($_POST['transshipment']) &&
    isset($_POST['portofloading']) &&
    isset($_POST['portofdischarge']) &&
    isset($_POST['description'])
) {
    $mlcnumber = $_POST['mlcnumber'];
    $mlcissuedate  = $_POST['mlcissuedate'];
    $mlcexpirydate  = $_POST['mlcexpirydate'];
    $lcissuedby  = $_POST['lcissuedby'];
    $buyer  = $_POST['buyer'];
    $sender_bank  = $_POST['sender_bank'];
    $receiver_bank  = $_POST['receiver_bank'];
    $currency  = $_POST['currency'];
    $amount  = $_POST['amount'];
    $partialshipment  = $_POST['partialshipment'];
    $transshipment  = $_POST['transshipment'];
    $portofloading  = $_POST['portofloading'];
    $portofdischarge  = $_POST['portofdischarge'];
    $description  = $_POST['description'];
    $user_id = get_ses('user_id');

    $sql = "UPDATE masterlc SET 
    MasterLCNumber = '$mlcnumber',
    MasterLCIssueDate = '$mlcissuedate', 
    MasterLCExpiryDate = '$mlcexpirydate', 
    MasterLCIssuingCompany = '$lcissuedby', 
    MasterLCBuyer = '$buyer', 
    MasterLCSenderBank = '$sender_bank', 
    MasterLCReceiverBank = '$receiver_bank', 
    MasterLCCurrency = '$currency', 
    MasterLCAmount = '$amount', 
    MasterLCPartialShipment = '$partialshipment', 
    MasterLCTranshipment = '$transshipment', 
    MasterLCPortOfLoading = '$portofloading', 
    MasterLCPortOfDischarge = '$portofdischarge', 
    Description = '$description', 
    AddedBy = '$user_id'
    WHERE MasterLCID = '$id'";

    if (mysqli_query($conn, $sql)) {
        notice('success', 'Master LC Updated Successfully.');
        nowgo('/index.php?page=single_masterlc&id=' . $id);
    } else {
        notice('error', $sql . "<br>" . mysqli_error($conn));
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sid = $_GET['id'];
    $sql = "DELETE FROM masterlc_description  WHERE ID=" . $id;

    if (mysqli_query($conn, $sql)) {
        notice('success', 'Master LC Orders Deleted Successfully');
        nowgo('/index.php?page=single_masterlc&id=' . $sid);
    } else {
        notice('error', $sql . "<br>" . mysqli_error($conn));
    }
}
