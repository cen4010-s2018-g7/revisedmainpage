<?php

include 'Db.php';


$reportid = (int) $_POST['reportid'];
$comment = $_POST['createcomment'];

$add = Db::addComment($reportid, $comment);

header("Location: report.php?id=".$reportid);


?>
