<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App;
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
// Get All Students
$app->get('/api/students', function(Request $request, Response $response){
    $sql = "SELECT * FROM students";
    try{
        // Get Datasource Object
        $datasource = new datasource();
        // Connect
        $datasource = $datasource->connect();
        $stmt = $datasource->query($sql);
        $students = $stmt->fetchAll(PDO::FETCH_OBJ);
        $datasource = null;
        echo json_encode($students);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Get Single student
$app->get('/api/student/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM students WHERE id = $id";
    try{
        // Get Datasource Object
        $datasource = new datasource();
        // Connect
        $datasource = $datasource->connect();
        $stmt = $datasource->query($sql);
        $student = $stmt->fetch(PDO::FETCH_OBJ);
        $datasource = null;
        echo json_encode($student);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Add student
$app->post('/api/student/add', function(Request $request, Response $response){
    $fbid = $request->getParam('fbid');
    $location = $request->getParam('location');
    $firstname = $request->getParam('firstname');
    $surname = $request->getParam('surname');
    $photo = $request->getParam('photo');
    $email = $request->getParam('email');
    $cell = $request->getParam('cell');

    $passport = $request->getParam('passport');
    $validpass = $request->getParam('validpass');
    $validage = $request->getParam('validage');
    $s1 = $request->getParam('s1');
    $s2 = $request->getParam('s2');
    $s3 = $request->getParam('s3');
    $s4 = $request->getParam('s4');
    $s5 = $request->getParam('s5');
    $password = $request->getParam('password');
    $text15 = $request->getParam('text15');
    $caption16 = $request->getParam('caption16');
    $caption17 = $request->getParam('caption17');
    $caption18 = $request->getParam('caption18');
    $sex = $request->getParam('sex');
    $text20 = $request->getParam('text20');

    $updated = $request->getParam(now());





    $sql = "INSERT INTO students (fbid,location,firstname,surname,photo,email,cell, passport, validpass, validage, s1, s2, s3, s4, s5, password, text15, caption16, caption17, caption18, sex, text20, updated) VALUES
    (:fbid,:location,:firstname,:surname,:photo,:email,:cell,:passport,:validpass,:validage,:s1,:s2,:s3,:s4,:s5,:password,:text15,:caption16,:caption17,:caption18,:sex,:text20,:updated)";
    try{
        // Get datasource Object
        $datasource = new db();
        // Connect
        $datasource = $datasource->connect();
        $stmt = $datasource->prepare($sql);
        $stmt->bindParam(':fbid',           $fbid);
        $stmt->bindParam(':location',       $location);
        $stmt->bindParam(':firstname',      $firstname);
        $stmt->bindParam(':surname',        $surname);
        $stmt->bindParam(':photo',          $photo);
        $stmt->bindParam(':email',          $email);
        $stmt->bindParam(':cell',           $cell);

        $stmt->bindParam(':passport',       $passport);
        $stmt->bindParam(':validpass',      $validpass);
        $stmt->bindParam(':validage',       $validage);
        $stmt->bindParam(':s1',             $s1);
        $stmt->bindParam(':s2',             $s2);
        $stmt->bindParam(':s3',             $s3);
        $stmt->bindParam(':s4',             $s4);
        $stmt->bindParam(':s5',             $s5);
        $stmt->bindParam(':password',       $password);
        $stmt->bindParam(':text15',         $text15);
        $stmt->bindParam(':caption16',      $caption16);
        $stmt->bindParam(':caption17',      $caption17);
        $stmt->bindParam(':caption18',      $caption18);
        $stmt->bindParam(':sex',            $sex);
        $stmt->bindParam(':text20',         $text20);
        $stmt->bindParam(':updated',        now());

        $stmt->execute();
        echo '{"notice": {"text": "student Added"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Update student
$app->put('/api/student/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $fbid = $request->getParam('fbid');
    $location = $request->getParam('location');
    $firstname = $request->getParam('firstname');
    $surname = $request->getParam('surname');
    $photo = $request->getParam('photo');
    $email = $request->getParam('email');
    $cell = $request->getParam('cell');

    $passport = $request->getParam('passport');
    $validpass = $request->getParam('validpass');
    $validage = $request->getParam('validage');
    $s1 = $request->getParam('s1');
    $s2 = $request->getParam('s2');
    $s3 = $request->getParam('s3');
    $s4 = $request->getParam('s4');
    $s5 = $request->getParam('s5');
    $password = $request->getParam('password');
    $text15 = $request->getParam('text15');
    $caption16 = $request->getParam('caption16');
    $caption17 = $request->getParam('caption17');
    $caption18 = $request->getParam('caption18');
    $sex = $request->getParam('sex');
    $text20 = $request->getParam('text20');

    $updated = $request->getParam(now());



    $sql = "UPDATE students SET
				fbid 	    = :fbid,
				location 	= :location,
                firstname		= :firstname,
                surname		= :surname,
                photo 	    = :photo,
                email 		= :email,
                cell		= :cell

                passport    =:passport,
                validpass   =:validpass,
                validage    =:validage, 
                s1          =:s1,
                s2          =:s2, 
                s3          =:s3, 
                s4          =:s4, 
                s5          =:s5, 
                password    =:password, 
                text15      =:text15, 
                caption16   =:caption16, 
                caption17   =:caption17, 
                caption18   =:caption18, 
                sex         =:sex, 
                text20      =:text20,
 
                updated     =:now()

			WHERE id = $id";
    try{
        // Get Datasource Object
        $datasource = new db();
        // Connect
        $datasource = $datasource->connect();
        $stmt = $datasource->prepare($sql);
        $stmt->bindParam(':fbid', $fbid);
        $stmt->bindParam(':location',  $location);
        $stmt->bindParam(':firstname',      $firstname);
        $stmt->bindParam(':surname',      $surname);
        $stmt->bindParam(':photo',    $photo);
        $stmt->bindParam(':email',       $email);
        $stmt->bindParam(':cell',      $cell);

        $stmt->bindParam(':passport',      $passport);
        $stmt->bindParam(':validpass',      $validpass);
        $stmt->bindParam(':validage',      $validage);
        $stmt->bindParam(':s1',      $s1);
        $stmt->bindParam(':s2',      $s2);
        $stmt->bindParam(':s3',      $s3);
        $stmt->bindParam(':s4',      $s4);
        $stmt->bindParam(':s5',      $s5);
        $stmt->bindParam(':password',      $password);
        $stmt->bindParam(':text15',      $text15);
        $stmt->bindParam(':caption16',      $caption16);
        $stmt->bindParam(':caption17',      $caption17);
        $stmt->bindParam(':caption18',      $caption18);
        $stmt->bindParam(':sex',      $sex);
        $stmt->bindParam(':text20',      $text20);
        $stmt->bindParam(':updated',      now());



        $stmt->execute();
        echo '{"notice": {"text": "student Updated"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Delete student
$app->delete('/api/student/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM students WHERE id = $id";
    try{
        // Get Datasource Object
        $datasource = new db();
        // Connect
        $datasource = $datasource->connect();
        $stmt = $datasource->prepare($sql);
        $stmt->execute();
        $datasource = null;
        echo '{"notice": {"text": "student Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});