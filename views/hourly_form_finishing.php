<?php

$PageTitle = "Hourly Finishing Form | Optima Inventory";
function customPageHeader()
{
    ?>
    <!--Arbitrary HTML Tags-->
<?php }
include_once "controller/add_hourly_form_finishing.php";
include_once "includes/header.php";

?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Hourly Finishing Form
                    <div class="page-title-subheading">
                        Please use this form to add a new Item.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-card mb-3 card">
        <div class="card-body">
            <form class="needs-validation" method="POST" novalidate>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationTooltip01">Date</label>
                        <input type="date" name="date" class="form-control" id="validationTooltip01" placeholder="Date" required>
                    </div>
                </div>
                <style>
                    #mytable>tbody>tr>td {
                        padding: 0px;
                        margin: 0px;
                        margin-bottom: 0px !important;
                    }

                    #mytable>tbody>tr>td>input {
                        width: 100%;
                    }

                    #mytable>tbody>tr>td>input[type=text] {
                        width: 100px;
                    }
                </style>
                <div class="form-row">
                    <table class="mb-0 table table-bordered table-hover order-list" id="mytable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Floor</th>
                                <th>PO</th>
                                <th>Style</th>
                                <th>Color</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>1</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <input placeholder="Floor" name="floorno[]" type="text" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <select name="po[]" class="po  form-control" required>
                                        <option></option>
                                        <?php
                                        $conn = db_connection();
                                        $sql = "SELECT * FROM po WHERE status = 1";
                                        $results = mysqli_query($conn, $sql);
                                        while ($result = mysqli_fetch_assoc($results)) {
                                            echo '<option value="' . $result['POID'] . '">' . $result['PONumber'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="style[]" class="style  form-control" required>
                                        <option></option>
                                        <?php
                                        $conn = db_connection();
                                        $sql = "SELECT * FROM style WHERE status = 1";
                                        $results = mysqli_query($conn, $sql);
                                        while ($result = mysqli_fetch_assoc($results)) {
                                            echo '<option value="' . $result['StyleID'] . '">' . $result['StyleNumber'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="color[]" class="color  form-control" required>
                                        <option></option>
                                        <?php
                                        $conn = db_connection();
                                        $sql = "SELECT * FROM color WHERE status = 1";
                                        $results = mysqli_query($conn, $sql);
                                        while ($result = mysqli_fetch_assoc($results)) {
                                            echo '<option value="' . $result['id'] . '">' . $result['color'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input placeholder="9" name="nine[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="10" name="ten[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="11" name="eleven[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="12" name="twelve[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="1" name="one[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="3" name="three[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="4" name="four[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="5" name="five[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="6" name="six[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="7" name="seven[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td>
                                    <input placeholder="8" name="eight[]" type="number" class="form-control-sm form-control">
                                </td>
                                <td><a class="deleteRow"></a></td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="17" class="text-center"><input type="button" class="btn btn-sm btn-success" id="addrow" value="Add Row" /><br></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<?php
function customPagefooter()
{
    ?>
    <script>
        // Add new row code

        $(document).ready(function() {
            var counter = 2;

            $("#addrow").on("click", function() {
                var newRow = $("<tr>");
                var cols = "";

                cols += '<th scope="row">' + counter + '</th>';
                cols += '<td><input placeholder="Floor" name="floorno[]" type="text" class="form-control-sm form-control"></td>';
                cols += '<td><select name="po[]" class="po mb-2 form-control-sm form-control" required><option></option>';
                <?php
                    $conn = db_connection();
                    $sql = "SELECT * FROM po WHERE status = 1";
                    $results = mysqli_query($conn, $sql);
                    while ($result = mysqli_fetch_assoc($results)) {
                        echo 'cols += \'<option value="' . $result['POID'] . '">' . $result['PONumber'] . '</option>\'; ';
                    }
                    ?>
                cols += '</select></td>';
                cols += '<td><select name="style[]" class="style mb-2 form-control-sm form-control" required><option></option>';
                <?php
                    $conn = db_connection();
                    $sql = "SELECT * FROM style WHERE status = 1";
                    $results = mysqli_query($conn, $sql);
                    while ($result = mysqli_fetch_assoc($results)) {
                        echo 'cols += \'<option value="' . $result['StyleID'] . '">' . $result['StyleNumber'] . '</option>\'; ';
                    }
                    ?>
                cols += '</select></td>';
                cols += '<td><select name="color[]" class="color mb-2 form-control-sm form-control" required><option></option>';
                <?php
                    $conn = db_connection();
                    $sql = "SELECT * FROM color WHERE status = 1";
                    $results = mysqli_query($conn, $sql);
                    while ($result = mysqli_fetch_assoc($results)) {
                        echo 'cols += \'<option value="' . $result['id'] . '">' . $result['color'] . '</option>\'; ';
                    }
                    ?>
                cols += '</select></td>';
                cols += '<td><input placeholder="9" name="nine[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="10" name="ten[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="11" name="eleven[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="12" name="twelve[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="1" name="one[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="3" name="three[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="4" name="four[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="5" name="five[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="6" name="six[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="7" name="seven[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input placeholder="8" name="eight[]" type="number" class="form-control-sm form-control"></td>';
                cols += '<td><input type="button" class="ibtnDel btn btn-sm btn-danger "  value="Delete"></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });



            $("table.order-list").on("click", ".ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counter -= 1
            });


        });


        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
<?php }
include_once "includes/footer.php";
?>