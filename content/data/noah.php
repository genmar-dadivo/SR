<?php
	date_default_timezone_set("Asia/Manila");
	require "../dbase/dbconfig.php";
	//settings
    $T = 2020;
    $B = 9;
    $S = 0;
    $E = 99;
    $limit = '';
    $sql = "SELECT 
    SUBSTRING(DSM, 1, 3) AS DSMCODE,
    SUBSTRING(SKU, 1, 7) AS ITEMNO,
    (SELECT ds.DSMSORT FROM dsm ds WHERE ds.dsm_code = DSMCODE) AS DSMSORT,
    (SELECT p.PROD_CODE FROM product p WHERE p.ITEM_NO = ITEMNO LIMIT 1) AS PRODCAT, 
    nl.*
    FROM noah_oelinhst nl
    WHERE
    nl.TAON = $T AND
    nl.BUWAN = $B AND
    nl.ARAW BETWEEN 0 AND 99 
    $limit";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($stm->rowCount() >= 1) {
        foreach ($results as $row) {
            $id = $row['id'];
            $DBNO = strtoupper($row['DBNO']);
            $BRANCH_NAME = strtoupper($row['BRANCH_NAME']);
            $DSM = strtoupper($row['DSM']);
            $SALESMAN_CODE = strtoupper($row['SALESMAN_CODE']);
            $TAON = $row['TAON'];
            $BUWAN = $row['BUWAN'];
            $ARAW = $row['ARAW'];
            $SELLING_TYPE = strtoupper($row['SELLING_TYPE']);
            $CUSTOMERS = strtoupper($row['CUSTOMERS']);
            $ADDRESS = strtoupper($row['ADDRESS']);
            $TIN = $row['TIN'];
            $CUSTOMERS_TYPE = strtoupper($row['CUSTOMERS_TYPE']);
            $PROVINCIAL = strtoupper($row['PROVINCIAL']);
            $ACCOUNTS = $row['ACCOUNTS'];
            $CATEGORY = strtoupper(preg_replace('/\s+/', ' ',$row['CATEGORY']));
            $PRODUCT_CATEGORY = strtoupper(preg_replace('/\s+/', ' ',$row['PRODUCT_CATEGORY']));
            $SKU = strtoupper(preg_replace('/[^A-Za-z0-9-]/', '', $row['SKU']));
            $UOM = strtoupper($row['UOM']);
            $QTY = $row['QTY'];
            $AMOUNT = $row['AMOUNT'];
            $NET_AMOUNT = $row['NET_AMOUNT'];
            $TRANSDATE = $row['TRANSDATE'];
            $NOAH_INV_NO = strtoupper($row['NOAH_INV_NO']);
            $MANUAL_INV_NO = strtoupper($row['MANUAL_INV_NO']);
            $DATE_CONFIRMED = $row['DATE_CONFIRMED'];
            $DSMCODE = strtoupper($row['DSMCODE']);
            $DSMSORT = $row['DSMSORT'];
            $ITEMNO = $row['ITEMNO'];
            $PRODCAT = $row['PRODCAT'];
             // region mecha
            $SL = array("CD1", "CD2", "ND1", "OSC", "OSN");
            $NL = array("DD1", "PD1", "PD2", "SD1", "OSP", "OSD", "OSS");
            $MT = array("I97", "GB1", "GB2");
            $GT = array("APX", "GBX", "GW1", "GX1", "GX2");
            $V = array("BD1", "BX1", "LD1", "OD1", "TD1", "OSO", "OSL", "OSB");
            $M = array("VD1", "VD2", "VD3", "YD1", "YX1", "ZD1", "OSA", "OSY", "OSZ", "OST");
            if (in_array($DSMCODE, $SL)) { $AREA = '1. SOUTH-LUZON'; }
            elseif (in_array($DSMCODE, $NL)) { $AREA = '2. NORTH-LUZON'; }
            elseif (in_array($DSMCODE, $MT)) { $AREA = '3. MODERN TRADE'; }
            elseif (in_array($DSMCODE, $GT)) { $AREA = '4. GEN TRADE'; }
            elseif (in_array($DSMCODE, $V)) { $AREA = '5. VISAYAS'; }
            elseif (in_array($DSMCODE, $M)) { $AREA = '6. MINDANAO'; }
            else { $AREA = $DSMCODE; }
            if ($PRODCAT == 'RTD') { $PRODCAT = '1. RTD'; }
            elseif ($PRODCAT == 'DAIRY') { $PRODCAT = '2. DAIRY'; }
            elseif ($PRODCAT == 'NCB & CSD') { $PRODCAT = '3. NCB & CSD'; }
            elseif ($PRODCAT == 'FOOD') { $PRODCAT = '4. FOOD'; }
            elseif ($PRODCAT == 'POWDER') { $PRODCAT = '5. POWDER'; }
            $output['data'][] = array(
                "",
                "$DBNO",
                "$SALESMAN_CODE",
                "$DSM",
                "$DSMSORT $DSM",
                "$BRANCH_NAME",
                "$SELLING_TYPE",
                "$NOAH_INV_NO",
                "",
                "$ITEMNO",
                "$PRODUCT_CATEGORY",
                "$PRODCAT",
                "$SKU",
                "",
                "$QTY",
                "$QTY",
                "",
                "$TRANSDATE",
                "",
                "",
                "$UOM",
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
                "$CUSTOMERS",
                "$ADDRESS",
                "$TIN",
                "$CUSTOMERS_TYPE",
                "$PROVINCIAL",
                "$AREA",
                "$MANUAL_INV_NO",
                "$TRANSDATE",
                "$AMOUNT",
                "$NET_AMOUNT",
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