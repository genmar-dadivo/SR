<?php
    date_default_timezone_set("Asia/Manila");
    require "../dbase/dbconfig.php";
    //settings
    $US = 40000000;
    $USE = 49999999;
    $DB = '1';
    $S = 20200900;
    $E = 20200999;
    $limit = '';
    $sql = "SELECT
    (SELECT os.ORDER_STATUS FROM oeordhdr os WHERE os.DB_NO = l.DB_NO AND os.ORDER_NO = l.ORDER_NO) AS ORDERSTATUS,
    (SELECT ode.ORDER_DATE_ENTERED FROM oeordhdr ode WHERE ode.DB_NO = l.DB_NO AND ode.ORDER_NO =l.ORDER_NO) AS ORDERDATEENTERED,
    (SELECT oatn.ORDER_APPLY_TO_NO FROM oeordhdr oatn WHERE oatn.DB_NO = l.DB_NO AND oatn.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERAPPLYTONO,
    (SELECT opon.ORDER_PUR_ORDER_NO FROM oeordhdr opon WHERE opon.DB_NO = l.DB_NO AND opon.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERPURORDERNO,
    (SELECT ocn.ORDER_CUSTOMER_NO FROM oeordhdr ocn WHERE ocn.DB_NO = l.DB_NO AND ocn.ORDER_NO = l.ORDER_NO LIMIT 1) AS ORDERCUSTOMERNO,
    (SELECT C.CUSTOMER FROM v_customer_info C WHERE TRIM(C.DBNO) = TRIM(l.DB_NO) 
    AND C.CUS_NO LIKE CONCAT ('%' , TRIM(ORDERCUSTOMERNO) , '%') LIMIT 1) AS CUSTOMERN,
    (SELECT A.ADDRESS FROM v_customer_info A WHERE A.DBNO = l.DB_NO AND A.CUS_NO LIKE CONCAT ('%' , ORDERCUSTOMERNO , '%') LIMIT 1) AS ADDRESSC, 
    (SELECT T.TIN_NO FROM v_customer_info T WHERE T.DBNO = l.DB_NO AND T.CUS_NO LIKE CONCAT ('%' , ORDERCUSTOMERNO , '%') LIMIT 1) AS TINC, 
    (SELECT t.CUST_TYPE_CODE FROM v_customer_type t WHERE t.DBNO = l.DB_NO AND t.CUS_NO LIKE CONCAT ('%' , ORDERCUSTOMERNO , '%') LIMIT 1) AS TYPEC, 
    (SELECT cbm.CUSTOMER_BAL_METHOD FROM oeordhdr cbm WHERE cbm.DB_NO = l.DB_NO AND cbm.ORDER_NO = l.ORDER_NO LIMIT 1) AS CUSTOMERBALMETHOD, 
    (SELECT sd.SHIPPING_DATE FROM oeordhdr sd WHERE sd.DB_NO = l.DB_NO AND sd.ORDER_NO = l.ORDER_NO LIMIT 1) AS SHIPPINGDATE, 
    (SELECT svc.SHIP_VIA_CODE FROM oeordhdr svc WHERE svc.DB_NO = l.DB_NO AND svc.ORDER_NO = l.ORDER_NO) AS SHIPVIACODE, 
    (SELECT tc.TERMS_CODE FROM oeordhdr tc WHERE tc.DB_NO = l.DB_NO AND tc.ORDER_NO = l.ORDER_NO) AS TERMSCODE, 
    (SELECT ml.MFGING_LOCATION FROM oeordhdr ml WHERE ml.DB_NO = l.DB_NO AND ml.ORDER_NO = l.ORDER_NO) AS MFGINGLOCATION, 
    (SELECT ttc.TOTAL_COST FROM oeordhdr ttc WHERE ttc.DB_NO = l.DB_NO AND ttc.ORDER_NO = l.ORDER_NO) AS TOTALCOST, 
    (SELECT tsa.TOTAL_SALE_AMOUNT FROM oeordhdr tsa WHERE tsa.DB_NO = l.DB_NO AND tsa.ORDER_NO = l.ORDER_NO) AS TOTALSALEAMOUNT, 
    (SELECT sn.SALESMAN_NO_1 FROM oeordhdr sn WHERE sn.DB_NO = l.DB_NO AND sn.ORDER_NO = l.ORDER_NO LIMIT 1) AS SALESMAN, 
    (SELECT p.dsm_code FROM psr p WHERE p.psr_code = SALESMAN) AS DSMCODE, 
    (SELECT d.dsm_desc FROM dsm d WHERE d.dsm_code = DSMCODE) AS DSMDESC, 
    (SELECT ds.DSMSORT FROM dsm ds WHERE ds.dsm_code = DSMCODE) AS DSMSORT,  
    (SELECT i.CATEGORY FROM product i WHERE i.ITEM_NO = l.ITEM_NO) AS ITEMCAT, 
    (SELECT n.SKU FROM product n WHERE n.ITEM_NO = l.ITEM_NO) AS INAME, 
    (SELECT p.PROD_CODE FROM product p WHERE p.ITEM_NO = l.ITEM_NO) AS PRODCAT, 
    l.DB_NO, l.ORDER_TYPE, l.ORDER_NO, l.SEQUENCE_NO, l.GEN_INV_NO, l.ITEM_NO, l.LOCATION, l.QTY_ORDERED, 
    l.QTY_TO_SHIP, l.UNIT_PRICE, l.REQUEST_DATE, l.UNIT_OF_MEASURE, l.UNIT_COST, l.TOTAL_QTY_ORDERED, l.TOTAL_QTY_SHIPPED, 
    l.PRICE_ORG, l.ITEM_PROD_CAT, l.USER_FIELD_3, l.USER_FIELD_5, l.BILL_DATE, l.ITEM_CUSTOMER 
    FROM oeordlin l
    WHERE l.DB_NO IN ($DB) AND l.ORDER_NO BETWEEN $US AND $USE 
    AND l.USER_FIELD_5 = ''
    AND l.REQUEST_DATE BETWEEN $S AND $E $limit";
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
            $CUSTOMERBALMETHOD = strtoupper($row['CUSTOMERBALMETHOD']);
            $SHIPPINGDATE = $row['SHIPPINGDATE'];
            $SHIPVIACODE = strtoupper($row['SHIPVIACODE']);
            $TERMSCODE = $row['TERMSCODE'];
            $MFGINGLOCATION = $row['MFGINGLOCATION'];
            $TOTALSALEAMOUNT = $row['TOTALSALEAMOUNT'];
            $TOTALCOST = $row['TOTALCOST'];
            $SALESMAN =strtoupper($row['SALESMAN']);
            $DSMCODE = strtoupper($row['DSMCODE']);
            $DSMDESC = strtoupper($row['DSMDESC']);
            $DSMSORT = $row['DSMSORT'];
            $ITEMCAT = strtoupper(preg_replace('/\s+/', ' ',$row['ITEMCAT']));
            $INAME = strtoupper(preg_replace('/[^A-Za-z0-9-]/', '', $row['INAME']));
            $PRODCAT = strtoupper(preg_replace('/\s+/', ' ',$row['PRODCAT']));
            $DB_NO = $row['DB_NO'];
            $ORDER_TYPE = strtoupper($row['ORDER_TYPE']);
            $ORDER_NO = $row['ORDER_NO'];
            $SEQUENCE_NO = $row['SEQUENCE_NO'];
            $GEN_INV_NO = strtoupper($row['GEN_INV_NO']);
            $ITEM_NO = $row['ITEM_NO'];
            $LOCATION = $row['LOCATION'];
            $QTY_ORDERED = $row['QTY_ORDERED'];
            $QTY_TO_SHIP = $row['QTY_TO_SHIP'];
            $UNIT_PRICE = $row['UNIT_PRICE'];
            $REQUEST_DATE = $row['REQUEST_DATE'];
            $UNIT_OF_MEASURE = strtoupper($row['UNIT_OF_MEASURE']);
            $UNIT_COST = $row['UNIT_COST'];
            $TOTAL_QTY_ORDERED = $row['TOTAL_QTY_ORDERED'];
            $TOTAL_QTY_SHIPPED = $row['TOTAL_QTY_SHIPPED'];
            $PRICE_ORG = $row['PRICE_ORG'];
            $ITEM_PROD_CAT = strtoupper($row['ITEM_PROD_CAT']);
            $USER_FIELD_3 = $row['USER_FIELD_3'];
            $USER_FIELD_5 = $row['USER_FIELD_5'];
            $BILL_DATE = $row['BILL_DATE'];
            // branch mecha
            if ($DB_NO == 1) { $branch = 'GMA'; }
            elseif ($DB_NO == 3) { $branch = 'CANLUBANG'; }
            elseif ($DB_NO == 4) { $branch = 'PILI/NAGA'; }
            elseif ($DB_NO == 5) { $branch = 'PAMPANGA'; }
            elseif ($DB_NO == 12) { $branch = 'ESMO'; }
            elseif ($DB_NO == 13) { $branch = 'OZAMIZ'; }
            elseif ($DB_NO == 14) { $branch = 'AGDAO'; }
            elseif ($DB_NO == 15) { $branch = 'TORIL/COTABATO'; }
            if (isset($row['SALESMAN'])) {
                $DSMCODE = preg_replace('/\s+/', '', $row['DSMCODE']);
                $DSMDESC = preg_replace('/\s+/', '', $row['DSMDESC']);
                $DSMSORT = preg_replace('/\s+/', '', $row['DSMSORT']);
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
            $GT = array("APX", "GBX", "GW1", "GX1", "GX2", "GMS", "OSE", "RB1");
            $V = array("BD1", "BX1", "LD1", "OD1", "TD1", "OSO", "OSL");
            $M = array("VD1", "VD2", "VD3", "YD1", "YX1", "ZD1", "OSA", "OSY", "OSZ", "OST");
            if (in_array($DSMCODE, $SL)) { $AREA = '1. SOUTH-LUZON'; }
            elseif (in_array($DSMCODE, $NL)) { $AREA = '2. NORTH-LUZON'; }
            elseif (in_array($DSMCODE, $MT)) { $AREA = '3. MODERN TRADE'; }
            elseif (in_array($DSMCODE, $GT)) { $AREA = '4. GEN TRADE'; }
            elseif (in_array($DSMCODE, $V)) { $AREA = '5. VISAYAS'; }
            elseif (in_array($DSMCODE, $M)) { $AREA = '6. MINDANAO'; }
            else { $AREA = 'N/A'; }
            // gross net mecha
            $gross = $QTY_TO_SHIP * $PRICE_ORG;
            $net = $QTY_TO_SHIP *  $UNIT_PRICE;
            if ($PRODCAT == 'RTD') { $PRODCAT = '1. RTD'; }
            elseif ($PRODCAT == 'DAIRY') { $PRODCAT = '2. DAIRY'; }
            elseif ($PRODCAT == 'NCB & CSD') { $PRODCAT = '3. NCB & CSD'; }
            elseif ($PRODCAT == 'FOOD') { $PRODCAT = '4. FOOD'; }
            elseif ($PRODCAT == 'POWDER') { $PRODCAT = '5. POWDER'; }
            $output['data'][] = array(
                "",
                "$DB_NO",
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
                "",
                "",
                "$UNIT_OF_MEASURE",
                "$UNIT_COST",
                "$TOTAL_QTY_ORDERED",
                "$TOTAL_QTY_SHIPPED",
                "$PRICE_ORG",
                "",
                "$ITEM_PROD_CAT",
                "",
                "",
                "$USER_FIELD_3",
                "",
                "$USER_FIELD_5",
                "$CUSTOMERN",
                "$ADDRESSC",
                "$TINC",
                "",
                "N/A",
                "$AREA",
                "$ORDER_NO",
                "$BILL_DATE",
                "$gross",
                "$net",
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