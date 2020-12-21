<?php
date_default_timezone_set("Asia/Manila");
$Ynow = date('Y');
require "../dbase/dbconfig.php";
$sql = "SELECT * FROM OELINHST WHERE DATABASE_NO = 14 AND INVOICE_NO < 80000000 AND USER_FIELD_5 = '' AND INVOICE_DATE BETWEEN 20201101 AND 20201131";
$stm = $con->prepare($sql);
$stm->execute();
$results = $stm->fetchAll(PDO::FETCH_ASSOC);
if ($stm->rowCount() >= 1) {
    foreach ($results as $row) {
        $DATABASE_NO = $row['DATABASE_NO'];
        $ORDER_TYPE = $row['ORDER_TYPE'];
        $ORDER_NO = $row['ORDER_NO'];
        // get dsm mecha
        $sqlheader = "SELECT SALESMAN_NO1 FROM oehdrhst WHERE DATABASE_NO = $DATABASE_NO AND OE_NO = $ORDER_NO";
        $stmheader = $con->prepare($sqlheader);
        $stmheader->execute();
        $rowheader = $stmheader->fetch();
        if ($stmheader->rowCount() == 1) {
            $SALESMAN_NO1 = str_replace(' ', '', $rowheader['SALESMAN_NO1']);
            $SALESMAN_NO1 = $SALESMAN_NO1;
            $sqlPSR = "SELECT psr_code, dsm_code FROM psr WHERE psr_code = '$SALESMAN_NO1'";
            $stmPSR = $con->prepare($sqlPSR);
            $stmPSR->execute();
            $rowPSR = $stmPSR->fetch();
            $psr_code = str_replace(' ', '', $rowPSR['psr_code']);
            $dsm_coderaw = str_replace(' ', '', $rowPSR['dsm_code']);
            if ($stmheader->rowCount() == 1) {
                $sqlDSM = "SELECT dsm_code, dsm_desc FROM dsm WHERE dsm_code = '$dsm_coderaw'";
                $stmDSM = $con->prepare($sqlDSM);
                $stmDSM->execute();
                $rowDSM = $stmDSM->fetch();
                $dsm_code = strtoupper($rowDSM['dsm_code']);
                $dsm_desc = strtoupper($rowDSM['dsm_desc']);
                if ($dsm_code == "" OR $dsm_desc == "") { $dsmname = $sqlPSR; }
                else { $dsmname = "$dsm_code-$dsm_desc"; }
            }
            else {}
        }
        else { $dsmname = $sqlheader . " " . $stmheader->rowCount(); }
        $SEQUENCE_NO = $row['SEQUENCE_NO'];
        $ITEM_NO = $row['ITEM_NO'];
        // get item desc mecha
        $sqitem = "SELECT SKU, CATEGORY FROM product WHERE ITEM_NO = $ITEM_NO";
        $stmitem = $con->prepare($sqitem);
        $stmitem->execute();
        $rowitem = $stmitem->fetch();
        if ($stmitem->rowCount() == 1) {
            $itemname = ucwords(strtolower($rowitem['SKU']));
            $itemcat = strtoupper($rowitem['CATEGORY']);
        }
        else {
            $itemname = $sqitem . " " . $stmitem->rowCount();
            $itemcat = $sqitem . " " . $stmitem->rowCount();
        }
        $LOCATION = $row['LOCATION'];
        $QTY_ORDERED = $row['QTY_ORDERED'];
        $QTY_TO_SHIP = $row['QTY_TO_SHIP'];
        $UNIT_PRICE = $row['UNIT_PRICE'];
        $REQUEST_DATE = $row['REQUEST_DATE'];
        $QTY_BACK_ORDERED = $row['QTY_BACK_ORDERED'];
        $QTY_RETURN_TO_STOCK = $row['QTY_RETURN_TO_STOCK'];
        $UNIT_OF_MEASURE = $row['UNIT_OF_MEASURE'];
        $UNIT_COST = $row['UNIT_COST'];
        $TOTAL_QTY_ORDERED = $row['TOTAL_QTY_ORDERED'];
        $TOTAL_QTY_SHIPPED = $row['TOTAL_QTY_SHIPPED'];
        $PRICE_ORG = $row['PRICE_ORG'];
        $LAST_POST_DATE = $row['LAST_POST_DATE'];
        $ITEM_PROD_CAT = $row['ITEM_PROD_CAT'];
        $USER_FIELD_1 = $row['USER_FIELD_1'];
        $USER_FIELD_2 = $row['USER_FIELD_2'];
        $USER_FIELD_3 = $row['USER_FIELD_3'];
        $USER_FIELD_4 = $row['USER_FIELD_4'];
        $USER_FIELD_5 = $row['USER_FIELD_5'];
        $CUSTOMER = $row['CUSTOMER'];
        $INVOICE_NO = $row['INVOICE_NO'];
        $INVOICE_DATE = $row['INVOICE_DATE'];
        

        $output['data'][] = array(
            "",
            "$ORDER_NO",
            "$dsmname",
            "$itemname",
            "$itemcat",
            "$QTY_ORDERED",
            "$QTY_TO_SHIP",
            "$UNIT_COST",
            "$UNIT_PRICE",
            "$PRICE_ORG",
            "$CUSTOMER",
            "$INVOICE_DATE"
        );


    }
}
else {
    $output['data'][] = array(
            "",
            "No Data",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            ""
        );
}
echo json_encode($output);
?>