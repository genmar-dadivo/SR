<?php
date_default_timezone_set("Asia/Manila");
$Ynow = date('Y');
require "../dbase/dbconfig.php";
$sql = "SELECT * FROM oelinhst WHERE LAST_POST_DATE BETWEEN 20201111 AND 20201130";
$stm = $confb->prepare($sql);
$stm->execute();
$results = $stm->fetchAll(PDO::FETCH_ASSOC);
if ($stm->rowCount() >= 1) {
    foreach ($results as $row) {
    	//$ID = $row['ID'];
        $DATABASE_NO = $row['DATABASE_NO'];
        $ORDER_NO = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $row['ORDER_NO']);
        $ITEM_NO = $row['ITEM_NO'];
        $REQUEST_DATE = $row['REQUEST_DATE'];
        $CUSTOMER = $row['CUSTOMER'];
        // 1 GO
        $CHECKER = 0;
        if (strlen($ORDER_NO) > 6) {
            $FCHECKER = substr($ORDER_NO, 0, 1);
            $OS = array(7, 8);
            if (in_array(substr($ORDER_NO, 0, 1), $OS)) { $CHECKER = 0; }
            else { $CHECKER = 1; }
        }
        else { $CHECKER = 1; }

        if (strpos($ORDER_NO, 'ERROR') !== false) { $dsmname = 'ERROR'; }
        else {
            $sqlheader = "SELECT OE_NO, SALESMAN_NO1, INVOICE_DATE FROM oehdrhst WHERE DATABASE_NO = $DATABASE_NO AND OE_NO = $ORDER_NO";
            $stmheader = $confb->prepare($sqlheader);
            $stmheader->execute();
            $rowheader = $stmheader->fetch();

            // get dsm
            if ($stmheader->rowCount() == 1) {
                $SALESMAN_NO1 = str_replace(' ', '', $rowheader['SALESMAN_NO1']);
                $SALESMAN_NO1 = $SALESMAN_NO1;
                $INVOICE_DATE = $rowheader['INVOICE_DATE'];
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
                    $dsm_desc = ucwords(strtolower($rowDSM['dsm_desc']));
                    if ($dsm_code == "" OR $dsm_desc == "") {
                        $dsmname = $sqlPSR;
                    }
                    else { $dsmname = "$dsm_code-$dsm_desc"; }
                }
                else {}
            }
            else { $dsmname = $sqlheader . " " . $stmheader->rowCount(); }
        }
        $sqlitem = "SELECT ITEM_NO, SKU, CATEGORY FROM product WHERE ITEM_NO = $ITEM_NO ";
        $stmitem = $con->prepare($sqlitem);
        $stmitem->execute();
        $rowitem = $stmitem->fetch();
        $rowItemcount = $stmitem->rowCount();
        if ($rowItemcount == 0) {
            $SKU = $sqlitem;
            $CATEGORY = $sqlitem;
        }
        else {
            $SKU = ucwords(strtolower($rowitem['SKU']));
            $CATEGORY = ucwords(strtolower($rowitem['CATEGORY']));
        }
        $QTY_ORDERED = $row['QTY_ORDERED'];
        $QTY_TO_SHIP = $row['QTY_TO_SHIP'];
        $UNIT_PRICE = $row['UNIT_PRICE'];
        $QTY_BACK_ORDERED = $row['QTY_BACK_ORDERED'];
        $QTY_RETURN_TO_STOCK = $row['QTY_RETURN_TO_STOCK'];
        $UNIT_COST = $row['UNIT_COST'];
        $TOTAL_QTY_ORDERED = $row['TOTAL_QTY_ORDERED'];
        $TOTAL_QTY_SHIPPED = $row['TOTAL_QTY_SHIPPED'];
        $PRICE_ORG = $row['PRICE_ORG'];
        $LAST_POST_DATE = $row['LAST_POST_DATE'];
        $INVOICE_NO = $row['INVOICE_NO'];

        $output['data'][] = array(
            "",
            "$ORDER_NO $CHECKER",
            "$dsmname",
            "$INVOICE_NO",
            "$SKU",
            "$CATEGORY",
            "$QTY_ORDERED",
            "$QTY_TO_SHIP",
            "$UNIT_PRICE",
            "$UNIT_COST",
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
            "",
            ""
        );
}
echo json_encode($output);
?>