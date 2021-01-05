<?php
    date_default_timezone_set("Asia/Manila");
    $Ynow = date('Y');
    require "../dbase/dbconfig.php";
    $sql = "SELECT (SELECT h.SALESMAN_NO1 FROM oehdrhst h WHERE h.DATABASE_NO = l.DATABASE_NO AND h.OE_NO = l.ORDER_NO) AS SALESMAN, (SELECT p.dsm_code FROM psr p WHERE p.psr_code = SALESMAN) AS DSMCODE, (SELECT d.dsm_desc FROM dsm d WHERE d.dsm_code = DSMCODE) AS DSMDESC, l.DATABASE_NO, l.ORDER_TYPE, l.ORDER_NO, l.SEQUENCE_NO, l.ITEM_NO, l.LOCATION, l.QTY_ORDERED, l.QTY_TO_SHIP, l.UNIT_PRICE, l.REQUEST_DATE, l.QTY_BACK_ORDERED, l.QTY_RETURN_TO_STOCK, l.UNIT_OF_MEASURE, l.UNIT_COST, l.TOTAL_QTY_ORDERED, l.TOTAL_QTY_SHIPPED, l.PRICE_ORG, l.LAST_POST_DATE, l.ITEM_PROD_CAT, l.USER_FIELD_1, l.USER_FIELD_2, l.USER_FIELD_3, l.USER_FIELD_4, l.USER_FIELD_5, l.CUSTOMER, l.INVOICE_NO, l.INVOICE_DATE FROM oelinhst l WHERE l.DATABASE_NO = '1' AND l.UNIT_PRICE <> 0 AND l.INVOICE_NO < 81000000 AND l.INVOICE_DATE BETWEEN 20201001 AND 20201099";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $DATABASE_NO = $row['DATABASE_NO'];
            $ORDER_TYPE = $row['ORDER_TYPE'];
            $ORDER_NO = $row['ORDER_NO'];
            $SALESMAN = $row['SALESMAN'];
            $DSMCODE = $row['DSMCODE'];
            $DSMDESC = $row['DSMDESC'];
            $SEQUENCE_NO = $row['SEQUENCE_NO'];
            $ITEM_NO = $row['ITEM_NO'];
            // get item desc mecha
            $sqitem = "SELECT SKU, CATEGORY FROM product WHERE ITEM_NO = $ITEM_NO";
            $stmitem = $con->prepare($sqitem);
            $stmitem->execute();
            $rowitem = $stmitem->fetch();
            if ($stmitem->rowCount() == 1) {
                $itemname = strtoupper(preg_replace("/[^0-9A-Za-z -]/", "", $rowitem['SKU']));
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
            // area mecha
            if ($DATABASE_NO == 1) { $AREA = 'NCR'; }
            elseif ($DATABASE_NO < 5) { $AREA = 'SOUTH-LUZON'; }
            elseif ($DATABASE_NO < 8) { $AREA = 'NORTH-LUZON'; }
            elseif ($DATABASE_NO < 12) { $AREA = 'VISAYAS'; }
            elseif ($DATABASE_NO < 17) { $AREA = 'MINDANAO'; }
            else { $AREA = ''; }
            // gross net mecha
            $gross = $QTY_TO_SHIP * $PRICE_ORG;        
            $net = $QTY_TO_SHIP *  $UNIT_PRICE;       

            $output['data'][] = array(
                "",
                "$ORDER_NO",
                "$DSMCODE - $DSMDESC",
                "$itemname",
                "$itemcat",
                "$QTY_ORDERED",
                "$QTY_TO_SHIP",
                "$UNIT_COST",
                "$UNIT_PRICE",
                "$PRICE_ORG",
                "$CUSTOMER",
                "$INVOICE_DATE",
                "$AREA",
                "$gross",
                "$net"
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
                ""
            );
    }
    echo json_encode($output);
?>