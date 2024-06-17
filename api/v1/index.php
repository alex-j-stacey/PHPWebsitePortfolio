<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

/* put = update
 * post = insert
 * get = select
 * delete = delete
 */

$app = new \Slim\Slim();
$app->get('/get_races','get_races');
$app->get('/get_runners/:race_id','get_runners');
$app->post('/add_runner','add_runner');
$app->delete('/delete_runner','delete_runner');

$app->run();

function get_races() {

    include '../../includes/dbConn.php';

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("select * from race");

        $sql->execute();
        $results = $sql->fetchAll();
        echo '{"Races":' . json_encode($results) . '}';
        $results = null;
        $db = null;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo json_encode($error);
    }
}

function get_runners($race_id) {
    include '../../includes/dbConn.php';

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("SELECT DISTINCT memberLogin.memberName, memberLogin.memberEmail FROM memberLogin
	                                INNER JOIN member_race ON memberLogin.memberID = member_race.memberID
                                    WHERE member_race.raceID = :raceID");
        $sql->bindValue(":raceID",$race_id);

        $sql->execute();
        $results = $sql->fetchAll();
        echo '{"Runners":' . json_encode($results) . '}';
        $results = null;
        $db = null;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo json_encode($error);
    }
}

function add_runner() {
    $request = \Slim\Slim::getInstance()->request();
    $post_json = json_decode($request->getBody(),TRUE);
    $memberID = $post_json["memberID"];
    $raceID = $post_json["raceID"];
    $memberKey = $post_json["memberKey"];

    include '../../includes/dbConn.php';

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("SELECT member_race.raceID FROM member_race
	                                INNER JOIN memberLogin ON member_race.memberID = memberLogin.memberID
                                    WHERE member_race.raceID = 2 AND memberLogin.memberKey = :APIKey");
        $sql->bindValue(":APIKey",$memberKey);

        $sql->execute();
        $results = $sql->fetch();
        if ($results == null) {
            echo "Bad API Key";
        } else {
            $sql = $db->prepare("INSERT INTO member_race (memberID,raceID,RoleID) VALUES (:memberID,:raceID,3)");
            $sql->bindValue(":memberID",$memberID);
            $sql->bindValue(":raceID",$raceID);
            $sql->execute();
        }
        $results = null;
        $db = null;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo json_encode($error);
    }
}

function delete_runner() {
    $request = \Slim\Slim::getInstance()->request();
    $post_json = json_decode($request->getBody(),TRUE);
    $memberID = $post_json["memberID"];
    $raceID = $post_json["raceID"];
    $memberKey = $post_json["memberKey"];

    include '../../includes/dbConn.php';

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("SELECT member_race.raceID FROM member_race
	                                INNER JOIN memberLogin ON member_race.memberID = memberLogin.memberID
                                    WHERE member_race.raceID = 2 AND memberLogin.memberKey = :APIKey");
        $sql->bindValue(":APIKey",$memberKey);

        $sql->execute();
        $results = $sql->fetch();
        if ($results == null) {
            echo "Bad API Key";
        } else {
            $sql = $db->prepare("DELETE FROM member_race WHERE memberID=:memberID AND raceID=:raceID AND RoleID=3");
            $sql->bindValue(":memberID",$memberID);
            $sql->bindValue(":raceID",$raceID);
            $sql->execute();
        }
        $results = null;
        $db = null;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo json_encode($error);
    }
}


?>
