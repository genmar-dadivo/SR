<?php
date_default_timezone_set("Asia/Manila");
$Ynow = date('Y');
require "../dbase/dbconfig.php";
$sql = "SELECT * FROM OELINHST r, OEHDRHST s where r.ORDER_NO = s.OE_NO AND s.INVOICE_DATE between 20201001 and 20201031 AND r.DATABASE_NO = 12";
$stm = $confb->prepare($sql);
$stm->execute();
$results = $stm->fetchAll(PDO::FETCH_ASSOC);
if ($stm->rowCount() >= 1) {
    foreach ($results as $row) {
        $DATABASE_NO = $row['DATABASE_NO'];
        $OE_NO = $row['OE_NO'];
        $sqlheader = "SELECT OE_NO, SALESMAN_NO1 FROM oehdrhst WHERE DATABASE_NO = $DATABASE_NO AND OE_NO = $OE_NO";
        $stmheader = $confb->prepare($sqlheader);
        $stmheader->execute();
        $rowheader = $stmheader->fetch();
        // get dsm
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
                $dsm_desc = ucwords(strtolower($rowDSM['dsm_desc']));
                if ($dsm_code == "" OR $dsm_desc == "") { $dsmname = $sqlPSR; }
                else { $dsmname = "$dsm_code-$dsm_desc"; }
            }
            else {}
        }
        else { $dsmname = $sqlheader . " " . $stmheader->rowCount(); }

        $ITEM_NO = $row['ITEM_NO'];
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
        $UNIT_COST = $row['UNIT_COST'];
        $PRICE_ORG = $row['PRICE_ORG'];
        $CUSTOMER = $row['CUSTOMER'];

        // $STATUS = $row['STATUS'];
        // $DATE_ENTERED = $row['DATE_ENTERED'];
        // $OEHH_DATE = $row['OEHH_DATE'];
        // $APPLY_TO_NO = $row['APPLY_TO_NO'];
        // $CUSTOMER_NO = $row['CUSTOMER_NO'];
        // $SHIPPING_DATE = $row['SHIPPING_DATE'];
        // $SHIP_VIA_CODE = $row['SHIP_VIA_CODE'];
        // $TERMS_CODE = $row['TERMS_CODE'];
        // $SALESMAN_NO1 = $row['SALESMAN_NO1'];
        // $TAX_CODE_1 = $row['TAX_CODE_1'];
        // $MFGING_LOCATION = $row['MFGING_LOCATION'];
        // $TOTAL_SALE_AMOUNT = $row['TOTAL_SALE_AMOUNT'];
        // $TOTAL_TAXABLE_AMOUNT = $row['TOTAL_TAXABLE_AMOUNT'];
        // $DATE_PICKED = $row['DATE_PICKED'];
        // $DATE_BILLED = $row['DATE_BILLED'];
        // $INVOICE_NO = $row['INVOICE_NO'];
        $INVOICE_DATE = $row['INVOICE_DATE'];
        // $POSTED_DATE = $row['POSTED_DATE'];
        // $ORIG_ORDER_TYPE = $row['ORIG_ORDER_TYPE'];
        // $ORIG_ORDER_DATE = $row['ORIG_ORDER_DATE'];
        // $ORIG_ORDER_NO = $row['ORIG_ORDER_NO'];
        // $OE_CASH_KEY = $row['OE_CASH_KEY'];
        // $USER_FIELD_1 = $row['USER_FIELD_1'];
        // $USER_FIELD_2 = $row['USER_FIELD_2'];
        // $USER_FIELD_3 = $row['USER_FIELD_3'];
        // $USER_FIELD_4 = $row['USER_FIELD_4'];
        // $USER_FIELD_5 = $row['USER_FIELD_5'];
        // $DATE_SHIPPED = $row['DATE_SHIPPED'];
        // $OE_PO_NO = $row['OE_PO_NO'];

        $output['data'][] = array(
            "",
            "$OE_NO",
            "$dsmname",
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
            ""
        );
}
echo json_encode($output);
?>