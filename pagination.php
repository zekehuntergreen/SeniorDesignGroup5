<?php


function getPage($stmt, $pageNum, $rowsPerPage)
{
    $offset = ($pageNum - 1) * $rowsPerPage;
    $rows = array();
    $i = 0;
    while(($row = sqlsrv_fetch_array($stmt, 
                                    SQLSRV_FETCH_NUMERIC,
                                    SQLSRV_SCROLL_ABSOLUTE,
                                    $offset + $i))
          && $i < $rowsPerPage)
    {
        array_push($rows, $row);
        $i++;
    }
    return $rows;
    
}

function pageLinks($numOfPages, $pageNum, $rowsPerPage, $rowsReturned)
{
    if($numOfPages <= 1)
        return;
    if($pageNum > 1)
    {
        $prevPageLink = "?pageNum=".($pageNum - 1);
        echo "<a href='$prevPageLink'>Previous Page</a>&nbsp;&nbsp;";
    }
    for($j = 0; $j < $numOfPages - 1; $j++)
    {
        $frontBound = ($j * $rowsPerPage) + 1;
        $endBound = ($j + 1) * $rowsPerPage;
        $linkedPageNum = $j + 1;
        $pageLink = "?pageNum=$linkedPageNum";
        print("<a href=$pageLink>$frontBound-$endBound</a>,&nbsp;&nbsp;");
    }
    
    /* Print Last Page Link (endpoint = last row) */
    $pageLink = "?pageNum=$numOfPages";
    $frontBound = ($numOfPages - 1) + 1;
    $endBound = $rowsReturned;
    print("<a href=$pageLink>$numOfPages-$rowsReturned</a>,&nbsp;&nbsp;");
    
    // Display Next Page link if applicable.
    if($pageNum < $numOfPages)
    {
        $nextPageLink = "?pageNum=".($pageNum + 1);
        echo "&nbsp;&nbsp;<a href='$nextPageLink'>Next Page</a>";
    }
    
}