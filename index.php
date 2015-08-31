<?php
include("./pagination.php");

$iLimit = 10;
$iPage = isset($_GET['page']) ? $_GET['page'] : 1;
$iStart = ($iLimit * $iPage) - $iLimit;

$oPaginate = new Pagination();

$aNames = $oPaginate->getNames($iStart, $iLimit);
$oPaginate->iCount = $aNames['count'];
$oPaginate->iRange = 3;
$oPaginate->iLimit = $iLimit;
$oPaginate->iCurrentPage = $iPage;

if($aNames['count'] > 0)
{
   foreach($aNames['names'] as $r) {
       echo $r['name'].'<br>';

   }
}

echo $oPaginate->create();

