<?php
$conn = db_connection();
if (isset($_POST['date']) && isset($_POST['floorno']) && isset($_POST['line']) && isset($_POST['po']) && isset($_POST['style']) && isset($_POST['color']) && isset($_POST['nine']) && isset($_POST['ten']) && isset($_POST['eleven']) && isset($_POST['twelve']) && isset($_POST['one']) && isset($_POST['three']) && isset($_POST['four']) && isset($_POST['five']) && isset($_POST['six']) && isset($_POST['seven']) && isset($_POST['eight']) ) {

    $date = $_POST['date'];
    $floorno = $_POST['floorno'];
    $user_id = get_ses('user_id');
    
    $sql = "INSERT INTO hourly_production (Date,FloorNO,AddedBy)
	values('$date','$floorno','$user_id')";

    if (mysqli_query($conn, $sql)) {
        notice('success', 'New Hourly Production added Successfully');
        $last_id = mysqli_insert_id($conn);
    } else {
        notice('error', $sql . "<br>" . mysqli_error($conn));
    }

    //hourly production datails
    $line = $_POST['line'];
    $po = $_POST['po'];
    $style = $_POST['style'];
    $color = $_POST['color'];
    $nine = $_POST['nine'];
    $ten = $_POST['ten'];
    $eleven = $_POST['eleven'];
    $twelve = $_POST['twelve'];
    $one = $_POST['one'];
    $three = $_POST['three'];
    $four = $_POST['four'];
    $five = $_POST['five'];
    $six = $_POST['six'];
    $seven = $_POST['seven'];
    $eight = $_POST['eight'];

    for ($i = 0; $i < sizeof($color); $i++) {

        $sql = "INSERT INTO hourly_production_details (HourlyProductionID,LineNo,POID,StyleID,Color,nine,ten,eleven,twelve,one,three,four,five,six,seven,eight,AddedBy)

        values('$last_id','$line[$i]','$po[$i]','$style[$i]','$color[$i]','$nine[$i]', '$ten[$i]','$eleven[$i]','$twelve[$i]','$one[$i]','$three[$i]','$four[$i]','$five[$i]','$six[$i]','$seven[$i]','$eight[$i]','$user_id') ";
        
        if (mysqli_query($conn, $sql)) {
            notice('success', 'New Hourly Production added Successfully');
        } else {
            notice('error', $sql . "<br>" . mysqli_error($conn));
        }
    }

}
