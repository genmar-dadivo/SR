<?php
date_default_timezone_set("Asia/Manila");
$Ynow = date('Y');
require "../dbase/dbconfig.php";
$sql = "SELECT * FROM `oehdrhst`";
$stm = $con->prepare($sql);
$stm->execute();
$results = $stm->fetchAll(PDO::FETCH_ASSOC);
if ($stm->rowCount() >= 1) {
    foreach ($results as $row) {
    	$ID = $row['ID'];
        $DATABASE_NO = $row['DATABASE_NO'];
        $OEHH_TYPE = $row['OEHH_TYPE'];
        $OE_NO = $row['OE_NO'];
        $STATUS = $row['STATUS'];
        $DATE_ENTERED = $row['DATE_ENTERED'];
        $OEHH_DATE = $row['OEHH_DATE'];
        $APPLY_TO_NO = $row['APPLY_TO_NO'];
        $CUSTOMER_NO = $row['CUSTOMER_NO'];
        $SHIPPING_DATE = $row['SHIPPING_DATE'];
        $SHIP_VIA_CODE = $row['SHIP_VIA_CODE'];
        $TERMS_CODE = $row['TERMS_CODE'];
        $SALESMAN_NO1 = $row['SALESMAN_NO1'];
        $TAX_CODE_1 = $row['TAX_CODE_1'];
        $MFGING_LOCATION = $row['MFGING_LOCATION'];
        $TOTAL_SALE_AMOUNT = $row['TOTAL_SALE_AMOUNT'];
        $TOTAL_TAXABLE_AMOUNT = $row['TOTAL_TAXABLE_AMOUNT'];
        $DATE_PICKED = $row['DATE_PICKED'];
        $DATE_BILLED = $row['DATE_BILLED'];
        $INVOICE_NO = $row['INVOICE_NO'];
        $INVOICE_DATE = $row['INVOICE_DATE'];
        $POSTED_DATE = $row['POSTED_DATE'];
        $ORIG_ORDER_TYPE = $row['ORIG_ORDER_TYPE'];
        $ORIG_ORDER_DATE = $row['ORIG_ORDER_DATE'];
        $ORIG_ORDER_NO = $row['ORIG_ORDER_NO'];
        $OE_CASH_KEY = $row['OE_CASH_KEY'];
        $USER_FIELD_1 = $row['USER_FIELD_1'];
        $USER_FIELD_2 = $row['USER_FIELD_2'];
        $USER_FIELD_3 = $row['USER_FIELD_3'];
        $USER_FIELD_4 = $row['USER_FIELD_4'];
        $USER_FIELD_5 = $row['USER_FIELD_5'];
        $DATE_SHIPPED = $row['DATE_SHIPPED'];
        $OE_PO_NO = $row['OE_PO_NO'];

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