
<?php

// PAGINATION VARIABLES
// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set records or rows of data per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;


$query = "SELECT id, name, description, price FROM products ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();

// PAGINATION
// count total number of rows
$query = "SELECT COUNT(*) as total_rows FROM products";
$stmt = $con->prepare($query);
 
// execute query
$stmt->execute();
 
// get total rows
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_rows = $row['total_rows'];

?>


<?php
echo "<ul class='pagination pull-left margin-zero mt0'>";
 
// first page button
if($page>1){
 
    $prev_page = $page - 1;
    echo "<li>";
        echo "<a href='{$page_url}page={$prev_page}'>";
            echo "<span style='margin:0 .5em;'>&laquo;</span>";
        echo "</a>";
    echo "</li>";
}
 
// clickable page numbers
 
// find out total pages
$total_pages = ceil($total_rows / $records_per_page);
 
// range of num links to show
$range = 1;
 
// display links to 'range of pages' around 'current page'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;
 
for ($x=$initial_num; $x<$condition_limit_num; $x++) {
 
    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {
 
        // current page
        if ($x == $page) {
            echo "<li class='active'>";
                echo "<a href='javascript::void();'>{$x}</a>";
            echo "</li>";
        }
 
        // not current page
        else {
            echo "<li>";
                echo " <a href='{$page_url}page={$x}'>{$x}</a> ";
            echo "</li>";
        }
    }
}


// last page button
if($page<$total_pages){
    $next_page = $page + 1;
 
    echo "<li>";
        echo "<a href='{$page_url}page={$next_page}'>";
            echo "<span style='margin:0 .5em;'>&raquo;</span>";
        echo "</a>";
    echo "</li>";
}
 
echo "</ul>";
?>