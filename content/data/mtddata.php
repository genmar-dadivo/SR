<?php
    date_default_timezone_set("Asia/Manila");
    require "../dbase/dbconfig.php";
    //settings
    $US = 90000000;
    $DB = ''; // AND l.DATABASE_NO = 14
    $STARTER = 20210101;
    $ENDER = 20210102;
    $sql = "SELECT (SELECT C.CUSTOMER FROM v_customer_info C WHERE TRIM(C.DBNO) = TRIM(l.DATABASE_NO) AND C.CUS_NO LIKE CONCAT ('%' , TRIM(l.CUSTOMER) , '%') LIMIT 1) AS CUSTOMERN, (SELECT A.ADDRESS FROM v_customer_info A WHERE A.DBNO = l.DATABASE_NO AND A.CUS_NO LIKE CONCAT ('%' , l.CUSTOMER , '%') LIMIT 1) AS ADDRESSC, (SELECT T.TIN_NO FROM v_customer_info T WHERE T.DBNO = l.DATABASE_NO AND T.CUS_NO LIKE CONCAT ('%' , l.CUSTOMER , '%') LIMIT 1) AS TINC, (SELECT t.CUST_TYPE_CODE FROM v_customer_type t WHERE t.DBNO = l.DATABASE_NO AND t.CUS_NO LIKE CONCAT ('%' , l.CUSTOMER , '%') LIMIT 1) AS TYPEC, (SELECT h.SALESMAN_NO1 FROM oehdrhst h WHERE h.DATABASE_NO = TRIM(l.DATABASE_NO) AND h.OE_NO = l.ORDER_NO LIMIT 1) AS SALESMAN, (SELECT p.dsm_code FROM psr p WHERE p.psr_code = SALESMAN) AS DSMCODE, (SELECT d.dsm_desc FROM dsm d WHERE d.dsm_code = DSMCODE) AS DSMDESC, (SELECT ds.DSMSORT FROM dsm ds WHERE ds.dsm_code = DSMCODE) AS DSMSORT, (SELECT i.CATEGORY FROM product i WHERE i.ITEM_NO = l.ITEM_NO) AS ITEMCAT, (SELECT n.SKU FROM product n WHERE n.ITEM_NO = l.ITEM_NO) AS INAME, (SELECT p.PROD_CODE FROM product p WHERE p.ITEM_NO = l.ITEM_NO) AS PRODCAT, l.ID, l.DATABASE_NO, l.ORDER_TYPE, l.ORDER_NO, l.SEQUENCE_NO, l.ITEM_NO, l.LOCATION, l.QTY_ORDERED, l.QTY_TO_SHIP, l.UNIT_PRICE, l.REQUEST_DATE, l.QTY_BACK_ORDERED, l.QTY_RETURN_TO_STOCK, l.UNIT_OF_MEASURE, l.UNIT_COST, l.TOTAL_QTY_ORDERED, l.TOTAL_QTY_SHIPPED, l.PRICE_ORG, l.LAST_POST_DATE, l.ITEM_PROD_CAT, l.USER_FIELD_1, l.USER_FIELD_2, l.USER_FIELD_3, l.USER_FIELD_4, l.CUSTOMER, l.INVOICE_NO, l.INVOICE_DATE, IF(l.USER_FIELD_5 = l.CUSTOMER, '', '0') AS USER_FIELD_5 FROM oelinhst l WHERE USER_FIELD_5 = '' AND TRIM(l.ORDER_TYPE) = 'o' AND l.UNIT_PRICE <> 0 AND l.INVOICE_NO < $US AND l.INVOICE_DATE BETWEEN $STARTER AND $ENDER";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $ID = $row['ID'];
            $DATABASE_NO = $row['DATABASE_NO'];
            $ORDER_TYPE = strtoupper($row['ORDER_TYPE']);
            $ORDER_NO = $row['ORDER_NO'];
            $SEQUENCE_NO = $row['SEQUENCE_NO'];
            $ITEM_NO = $row['ITEM_NO'];
            $LOCATION = $row['LOCATION'];
            $QTY_ORDERED = $row['QTY_ORDERED'];
            $QTY_TO_SHIP = $row['QTY_TO_SHIP'];
            $UNIT_PRICE = $row['UNIT_PRICE'];
            $REQUEST_DATE = $row['REQUEST_DATE'];
            $QTY_BACK_ORDERED = $row['QTY_BACK_ORDERED'];
            $QTY_RETURN_TO_STOCK = $row['QTY_RETURN_TO_STOCK'];
            $UNIT_OF_MEASURE = strtoupper($row['UNIT_OF_MEASURE']);
            $UNIT_COST = $row['UNIT_COST'];
            $TOTAL_QTY_ORDERED = $row['TOTAL_QTY_ORDERED'];
            $TOTAL_QTY_SHIPPED = $row['TOTAL_QTY_SHIPPED'];
            $PRICE_ORG = $row['PRICE_ORG'];
            $LAST_POST_DATE = $row['LAST_POST_DATE'];
            $ITEM_PROD_CAT = strtoupper($row['ITEM_PROD_CAT']);
            $USER_FIELD_1 = $row['USER_FIELD_1'];
            $USER_FIELD_2 = $row['USER_FIELD_2'];
            $USER_FIELD_3 = $row['USER_FIELD_3'];
            $USER_FIELD_4 = $row['USER_FIELD_4'];
            $USER_FIELD_5 = strtoupper($row['USER_FIELD_5']);
            $CUSTOMER = $row['CUSTOMER'];
            $INVOICE_NO = $row['INVOICE_NO'];
            $INVOICE_DATE = $row['INVOICE_DATE'];
            // readable invoice date mecha
            $IDY = substr($INVOICE_DATE, 0, 4);
            $IDM = substr($INVOICE_DATE, 4, 2);
            $IDD = substr($INVOICE_DATE, 6, 2);
            $INAME = preg_replace('/[^A-Za-z0-9-]/', '', $row['INAME']);
            $ITEMCAT = $row['ITEMCAT'];
            $PRODCAT = preg_replace('/\s+/', '', $row['PRODCAT']);
            $PRODCAT = preg_replace('/[^a-zA-Z0-9\']/', '', $row['PRODCAT']);
            $SALESMAN = strtoupper($row['SALESMAN']);
            if (isset($row['SALESMAN'])) {
                $DSMCODE = strtoupper(preg_replace('/\s+/', '', $row['DSMCODE']));
                $DSMDESC = strtoupper(preg_replace('/\s+/', '', $row['DSMDESC']));
                $DSMSORT = strtoupper(preg_replace('/\s+/', '', $row['DSMSORT']));
            }
            else {
                $DSMCODE = $row['SALESMAN'];
                $DSMDESC = '';
                $DSMSORT = '';
            }
            if (isset($row['CUSTOMERN'])) {
                $CUSTOMERN = strtoupper($row['CUSTOMERN']);
                $ADDRESSC = strtoupper($row['ADDRESSC']);
                $TYPEC = $row['TYPEC'];
                $TINC = $row['TINC'];
            }
            else {
                $CUSTOMERN = strtoupper($row['CUSTOMER']);
                $ADDRESSC = strtoupper("N/A");
                $TYPEC = strtoupper("N/A");
                $TINC = strtoupper("N/A");
            }
            // region mecha
            $SL = array("CD1", "CD2", "ND1", "OSC", "OSN");
            $NL = array("DD1", "PD1", "PD2", "SD1", "OSP", "OSD");
            $MT = array("I97", "GB1", "GB2");
            $GT = array("APX", "GBX", "GW1", "GX1", "GX2");
            $V = array("BD1", "BX1", "LD1", "OD1", "TD1", "OSO", "OSL");
            $M = array("VD1", "VD2", "VD3", "YD1", "YX1", "ZD1", "OSA", "OSY", "OSZ", "OST");
            if (in_array($DSMCODE, $SL)) { $AREA = '1. SOUTH-LUZON'; }
            elseif (in_array($DSMCODE, $NL)) { $AREA = '2. NORTH-LUZON'; }
            elseif (in_array($DSMCODE, $MT)) { $AREA = '3. MODERN TRADE'; }
            elseif (in_array($DSMCODE, $GT)) { $AREA = '4. GEN TRADE'; }
            elseif (in_array($DSMCODE, $V)) { $AREA = '5. VISAYAS'; }
            elseif (in_array($DSMCODE, $M)) { $AREA = '6. MINDANAO'; }
            // branch mecha
            if ($DATABASE_NO == 1) { $branch = 'GMA'; }
            elseif ($DATABASE_NO == 3) { $branch = 'CANLUBANG'; }
            elseif ($DATABASE_NO == 4) { $branch = 'PILI/NAGA'; }
            elseif ($DATABASE_NO == 5) { $branch = 'PAMPANGA'; }
            elseif ($DATABASE_NO == 12) { $branch = 'ESMO'; }
            elseif ($DATABASE_NO == 13) { $branch = 'OZAMIZ'; }
            elseif ($DATABASE_NO == 14) { $branch = 'AGDAO'; }
            elseif ($DATABASE_NO == 15) { $branch = 'TORIL/COTABATO'; }
            // gross net mecha
            $gross = $QTY_TO_SHIP * $PRICE_ORG;
            $net = $QTY_TO_SHIP *  $UNIT_PRICE;
            if ($ITEMCAT == 'RTD') { $ITEMCAT = '1. RTD'; }
            elseif ($ITEMCAT == 'DAIRY') { $ITEMCAT = '2. DAIRY'; }
            elseif ($ITEMCAT == 'NCB') { $ITEMCAT = '3. DAIRY'; }
            elseif ($ITEMCAT == 'FOOD') { $ITEMCAT = '4. FOOD'; }
            elseif ($ITEMCAT == 'POWDER') { $ITEMCAT = '5. POWDER'; }
            $output['data'][] = array(
                "",
                "$DATABASE_NO",
                "$SALESMAN",
                "$DSMCODE-$DSMDESC",
                "$DSMSORT $DSMCODE-$DSMDESC",
                "$branch",
                "$ORDER_TYPE",
                "$ORDER_NO",
                "$SEQUENCE_NO",
                "$ITEM_NO",
                "$ITEMCAT",
                "$PRODCAT",
                "$INAME",
                "$LOCATION",
                "$QTY_ORDERED",
                "$QTY_TO_SHIP",
                "$UNIT_PRICE",
                "$REQUEST_DATE",
                "$QTY_BACK_ORDERED",
                "$QTY_RETURN_TO_STOCK",
                "$UNIT_OF_MEASURE",
                "$UNIT_COST",
                "$TOTAL_QTY_ORDERED",
                "$TOTAL_QTY_SHIPPED",
                "$PRICE_ORG",
                "$LAST_POST_DATE",
                "$ITEM_PROD_CAT",
                "$USER_FIELD_1",
                "$USER_FIELD_2",
                "$USER_FIELD_3",
                "$USER_FIELD_4",
                "$USER_FIELD_5",
                "$CUSTOMERN",
                "$ADDRESSC",
                "$TINC",
                "$TYPEC",
                "N/A",
                "$AREA",
                "$INVOICE_NO",
                "$INVOICE_DATE",
                "$gross",
                "$net"
            );
        }
    }
    else {
        $output['data'][] = array(
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