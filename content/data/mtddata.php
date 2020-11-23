<?php
date_default_timezone_set("Asia/Manila");
$Ynow = date('Y');
require "../dbase/dbconfig.php";
$sql = "SELECT * FROM oelinhst WHERE REQUEST_DATE > '$Ynow" . "1000' ";
//$sql = "SELECT * FROM oelinhst";
$stm = $con->prepare($sql);
$stm->execute();
$results = $stm->fetchAll(PDO::FETCH_ASSOC);
if ($stm->rowCount() >= 1) {
    foreach ($results as $row) {
    	$ID = $row['ID'];
        $DATABASE_NO = $row['DATABASE_NO'];
        $ORDER_TYPE = $row['ORDER_TYPE'];

        // get dsm
        $ORDER_NO = $row['ORDER_NO'];
        if (strpos($ORDER_NO, 'ERROR') !== false) { $dsmname = 'ERROR'; }
        else {
            $sqlheader = "SELECT OE_NO, SALESMAN_NO1 FROM oehdrhst WHERE OE_NO = '$ORDER_NO' LIMIT 1";
            $stmheader = $con->prepare($sqlheader);
            $stmheader->execute();
            $rowheader = $stmheader->fetch();
            $SALESMAN_NO1 = str_replace(' ', '', $rowheader['SALESMAN_NO1']);

            // get dsm
            if ($stmheader->rowCount() == 1) {
                $SALESMAN_NO1 = $rowheader['SALESMAN_NO1'];
                $sqlPSR = "SELECT psr_code, dsm_code FROM psr WHERE psr_code = '$SALESMAN_NO1' LIMIT 1";
                $stmPSR = $con->prepare($sqlPSR);
                $stmPSR->execute();
                $rowPSR = $stmPSR->fetch();
                $psr_code = str_replace(' ', '', $rowPSR['psr_code']);
                $dsm_coderaw = str_replace(' ', '', $rowPSR['dsm_code']);
                if ($stmheader->rowCount() == 1) {
                    $sqlDSM = "SELECT dsm_code, dsm_desc FROM dsm WHERE dsm_code = '$dsm_coderaw' LIMIT 1";
                    $stmDSM = $con->prepare($sqlDSM);
                    $stmDSM->execute();
                    $rowDSM = $stmDSM->fetch();
                    $dsm_code = strtoupper($rowDSM['dsm_code']);
                    $dsm_desc = ucwords(strtolower($rowDSM['dsm_desc']));
                    if ($dsm_code == "" OR $dsm_desc == "") {
                        $dsmname = $sqlDSM;
                    }
                    else { $dsmname = "$dsm_code-$dsm_desc"; }
                }
                else {}
            }
            else { $dsmname = $sqlheader; }
        }

        $SEQUENCE_NO = $row['SEQUENCE_NO'];
        // get item details
        $ITEM_NO = str_replace(' ', '', $row['ITEM_NO']);
        $sqlitem = "SELECT * FROM product WHERE ITEM_NO = $ITEM_NO LIMIT 1";
        $stmitem = $con->prepare($sqlitem);
        $stmitem->execute();
        $rowitem = $stmitem->fetch();
        if ($rowitem['SKU'] == '') { $itemsku = $sqlitem; }
        else { $itemsku = ucwords(strtolower($rowitem['SKU'])); }
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

        $sample = "sample";
        if (!strpos($ORDER_NO, 'ERROR') !== false) {
        	$output['data'][] = array(
                "",
                "$DATABASE_NO",
                "$ORDER_TYPE",
                "<a class='pointer table-link' onclick='getMTDdata(1, $ID)'> $ORDER_NO </a>",
                "<a class='pointer table-link' onclick='getMTDdata(2, $ID)'> $dsmname </a>",
                "<a class='pointer table-link' onclick='getMTDdata(3, $ID)'> $ITEM_NO </a>",
                "$ITEM_PROD_CAT",
                "$itemsku",
                "$CUSTOMER",
                "$INVOICE_NO",
                "$QTY_ORDERED",
                "$QTY_TO_SHIP",
                "$UNIT_COST",
                "$UNIT_PRICE",
                "$REQUEST_DATE",
                "$QTY_BACK_ORDERED",
                "$QTY_RETURN_TO_STOCK",
                "$UNIT_OF_MEASURE",
                "$TOTAL_QTY_ORDERED",
                "$TOTAL_QTY_SHIPPED",
                "$PRICE_ORG",
                "$LAST_POST_DATE",
                "$USER_FIELD_1",
                "$USER_FIELD_2",
                "$USER_FIELD_3",
                "$USER_FIELD_4",
                "$USER_FIELD_5"
        	);
        }
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
            "",
            "",
            "",
            "",
            "",
            "",
            "",
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