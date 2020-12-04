<?php
date_default_timezone_set("Asia/Manila");
$Ynow = date('Y');
require "../dbase/dbconfig.php";
$sql = "SELECT ID ,ORDER_NO ,ITEM_NO ,QTY_ORDERED ,QTY_TO_SHIP ,UNIT_PRICE ,QTY_BACK_ORDERED ,QTY_RETURN_TO_STOCK ,UNIT_COST ,TOTAL_QTY_ORDERED ,TOTAL_QTY_SHIPPED ,PRICE_ORG ,LAST_POST_DATE ,CUSTOMER ,INVOICE_NO FROM oelinhst WHERE LENGTH(ORDER_NO) < 10 AND LAST_POST_DATE BETWEEN 20201001 AND 20201031 LIMIT 100000";
$stm = $con->prepare($sql);
$stm->execute();
$results = $stm->fetchAll(PDO::FETCH_ASSOC);
if ($stm->rowCount() >= 1) {
    foreach ($results as $row) {
    	$ID = $row['ID'];
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

        $ITEM_NO = $row['ITEM_NO'];

        $sqlitem = "SELECT ITEM_NO, SKU FROM product WHERE ITEM_NO = $ITEM_NO ";
        $stmitem = $con->prepare($sqlitem);
        $stmitem->execute();
        $rowitem = $stmitem->fetch();
        $SKU = $rowitem['SKU'];
        if ($SKU == '') { $SKU = $sqlitem; }

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
        $CUSTOMER = $row['CUSTOMER'];
        $INVOICE_NO = $row['INVOICE_NO'];

        $output['data'][] = array(
            "",
            "$ORDER_NO",
            "$dsmname",
            "$INVOICE_NO",
            "$SKU",
            "",
            "",
            "",
            "",
            "",
            "",
            ""
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