<?php

$link = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");

class Db
{


    public function getReports() {

        $conn = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");
        $result = mysqli_query($conn, "SELECT r.*, p.photo, l.name FROM reports r inner join photos p on r.id = p.reportid inner join locations l on r.locationid = l.id ORDER BY r.created DESC");
        mysqli_close($conn);
        return $result;
    }
 
    public function getTable($tbl) {
        
        $conn = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");
        $result = mysqli_query($conn, sprintf("SELECT * FROM %s", $tbl));
        mysqli_close($conn);
        return $result;  
    }


    public function get_user(){
           session_start();
           return (int) $_SESSION['userid'];
    }

    public function addReport($locationid, $description, $image){

         $conn = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");
         $userid = self::get_user();
         $i1 = "INSERT INTO reports (userid, locationid, description, status, created) VALUES ({$userid}, {$locationid}, '{$description}', 'PENDING', now());";
         mysqli_query($conn, $i1);

         $reportid = mysqli_insert_id($conn);
         
         $i2 = "INSERT INTO photos (reportid, photo) VALUES ({$reportid}, '{$image}');";
         mysqli_query($conn, $i2);
         mysqli_close($conn);

    }

    public function addComment($reportid, $comment){

         $conn = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");
         $userid = self::get_user();
         $i = "INSERT INTO comments (reportid, userid, comment, comment_timestamp) VALUES ({$reportid}, {$userid}, '{$comment}', now());";
         mysqli_query($conn, $i);
         mysqli_close($conn);
         
    }

    public function getLocations() {

        $conn = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");
        $result = mysqli_query($conn, "SELECT * FROM locations ORDER BY name");
        mysqli_close($conn);
        return $result;
    }


    public function getReportById($id){

        $conn = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");
        $result = mysqli_query($conn, sprintf("SELECT r.id, r.description, r.status, r.created, l.name, p.photo  FROM reports r inner join photos p on r.id = p.reportid inner join locations l on r.locationid = l.id WHERE r.id = %d", (int) $id ));
        mysqli_close($conn);

        return mysqli_fetch_assoc($result);

    }


    public function getReportCommentsById($id){

        $conn = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");
        $result = mysqli_query($conn, sprintf("SELECT c.*, u.username FROM reports r inner join comments c on r.id = c.reportid inner join users u on c.userid = u.id WHERE r.id = %d", (int) $id ));
        mysqli_close($conn);

        return $result;

    }

    public function login($un, $pw){
        
        $conn = mysqli_connect("localhost","cen4010sum18_g07","GfXmrb1hyE","cen4010sum18_g07");
        $result = mysqli_query($conn,  sprintf("SELECT * FROM users WHERE username = '%s' and password = '%s'", $un, $pw));
        mysqli_close($conn);
        return mysqli_fetch_assoc($result);

    }


}
?>
