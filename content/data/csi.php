<?php
    date_default_timezone_set("Asia/Manila");
    require "../dbase/dbconfig.php";
    //settings
    $US = 90000000;
    $DB = ''; // AND l.DATABASE_NO = 14
    $STARTER = 20210101;
    $ENDER = 20210102;
    $sql = "SELECT (SELECT os.ORDER_STATUS FROM oeordhdr os WHERE os.DB_NO = l.DB_NO AND os.ORDER_NO = l.ORDER_NO) AS ORDERSTATUS, (SELECT ode.ORDER_DATE_ENTERED FROM oeordhdr ode WHERE ode.DB_NO = l.DB_NO AND ode.ORDER_NO =l.ORDER_NO) AS ORDERDATEENTERED, (SELECT oatn.ORDER_APPLY_TO_NO FROM oeordhdr oatn WHERE oatn.DB_NO = l.DB_NO AND oatn.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERAPPLYTONO, (SELECT opon.ORDER_PUR_ORDER_NO FROM oeordhdr opon WHERE opon.DB_NO = l.DB_NO AND opon.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERPURORDERNO, (SELECT ocn.ORDER_CUSTOMER_NO FROM oeordhdr ocn WHERE ocn.DB_NO = l.DB_NO AND ocn.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERCUSTOMERNO, (SELECT cbm.CUSTOMER_BAL_METHOD FROM oeordhdr cbm WHERE cbm.DB_NO = l.DB_NO AND cbm.ORDER_NO = l.ORDER_NO LIMIT 1) AS CUSTOMERBALMETHOD, (SELECT sd.SHIPPING_DATE FROM oeordhdr sd WHERE sd.DB_NO = l.DB_NO AND sd.ORDER_NO = l.ORDER_NO LIMIT 1) AS SHIPPINGDATE, (SELECT svc.SHIP_VIA_CODE FROM oeordhdr svc WHERE svc.DB_NO = l.DB_NO AND svc.ORDER_NO = l.ORDER_NO) AS SHIPVIACODE, (SELECT tc.TERMS_CODE FROM oeordhdr tc WHERE tc.DB_NO = l.DB_NO AND tc.ORDER_NO = l.ORDER_NO) AS TERMSCODE, (SELECT sn.SALESMAN_NO_1 FROM oeordhdr sn WHERE sn.DB_NO = l.DB_NO AND sn.ORDER_NO = l.ORDER_NO LIMIT 1) AS SALESMAN, (SELECT p.dsm_code FROM psr p WHERE p.psr_code = SALESMAN) AS DSMCODE, (SELECT d.dsm_desc FROM dsm d WHERE d.dsm_code = DSMCODE) AS DSMDESC, (SELECT ds.DSMSORT FROM dsm ds WHERE ds.dsm_code = DSMCODE) AS DSMSORT,  (SELECT i.CATEGORY FROM product i WHERE i.ITEM_NO = l.ITEM_NO) AS ITEMCAT, (SELECT n.SKU FROM product n WHERE n.ITEM_NO = l.ITEM_NO) AS INAME, (SELECT p.PROD_CODE FROM product p WHERE p.ITEM_NO = l.ITEM_NO) AS PRODCAT, l.DB_NO, l.ORDER_TYPE, l.ORDER_NO, l.SEQUENCE_NO, l.GEN_INV_NO, l.ITEM_NO, l.LOCATION, l.QTY_ORDERED, l.QTY_TO_SHIP, l.UNIT_PRICE, l.REQUEST_DATE, l.UNIT_OF_MEASURE, l.UNIT_COST, l.TOTAL_QTY_ORDERED, l.TOTAL_QTY_SHIPPED, l.PRICE_ORG, l.ITEM_PROD_CAT, l.USER_FIELD_3, l.USER_FIELD_5, l.BILL_DATE, ITEM_CUSTOMER FROM oeordlin l";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $ORDERSTATUS = $row['ORDERSTATUS'];
            $ORDERDATEENTERED = $row['ORDERDATEENTERED'];
            $ORDERAPPLYTONO = $row['ORDERAPPLYTONO'];
            $ORDERPURORDERNO = $row['ORDERPURORDERNO'];
            $ORDERCUSTOMERNO = $row['ORDERCUSTOMERNO'];
            $CUSTOMERBALMETHOD = $row['CUSTOMERBALMETHOD'];
            $SHIPPINGDATE = $row['SHIPPINGDATE'];
            $SHIPVIACODE = $row['SHIPVIACODE'];
            $TERMSCODE = $row['TERMSCODE'];
            $SALESMAN = $row['SALESMAN'];
            $DSMCODE = $row['DSMCODE'];
            $DSMDESC = $row['DSMDESC'];
            $DSMSORT = $row['DSMSORT'];
            $ITEMCAT = $row['ITEMCAT'];
            $INAME = $row['INAME'];
            $PRODCAT = $row['PRODCAT'];


            $DB_NO = $row['DB_NO'];
            $ORDER_TYPE = $row['ORDER_TYPE'];
            $ORDER_NO = $row['ORDER_NO'];
            $SEQUENCE_NO = $row['SEQUENCE_NO'];
            $GEN_INV_NO = $row['GEN_INV_NO'];
            $ITEM_NO = $row['ITEM_NO'];
            $LOCATION = $row['LOCATION'];
            $QTY_ORDERED = $row['QTY_ORDERED'];
            $QTY_TO_SHIP = $row['QTY_TO_SHIP'];
            $UNIT_PRICE = $row['UNIT_PRICE'];
            $REQUEST_DATE = $row['REQUEST_DATE'];
            $UNIT_OF_MEASURE = $row['UNIT_OF_MEASURE'];
            $UNIT_COST = $row['UNIT_COST'];
            $TOTAL_QTY_ORDERED = $row['TOTAL_QTY_ORDERED'];
            $PRICE_ORG = $row['PRICE_ORG'];
            $ITEM_PROD_CAT = $row['ITEM_PROD_CAT'];
            $USER_FIELD_3 = $row['USER_FIELD_3'];
            $USER_FIELD_5 = $row['USER_FIELD_5'];
            $BILL_DATE = $row['BILL_DATE'];
            $BILL_DATE = $row['BILL_DATE'];
            $output['data'][] = array(
                "",
                "$DB_NO",
                "$ORDER_TYPE",
                "$ORDER_NO",
                "$SEQUENCE_NO",
                "$GEN_INV_NO",
                "$ITEM_NO",
                "$LOCATION",
                "$QTY_ORDERED",
                "$QTY_TO_SHIP",
                "$UNIT_PRICE",
                "$REQUEST_DATE",
                "$UNIT_OF_MEASURE",
                "$UNIT_COST",
                "$TOTAL_QTY_ORDERED",
                "$PRICE_ORG",
                "$ITEM_PROD_CAT",
                "$USER_FIELD_3",
                "$USER_FIELD_5",
                "$BILL_DATE",
                "$BILL_DATE"
            );
        }
    }
    else {
        $output['data'][] = array(
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