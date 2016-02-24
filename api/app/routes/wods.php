<?php

$app->get('/wods',function() use ($app) {

 	$wods =	$app->db->query("
			select w.id as wodId, w.title,w.createdAt,w.publishAt, ww.id as workoutId, ww.subtitle, ww.workout,ww.ordr from wod w
			inner join wodworkout ww on ww.wod_id = w.id order by w.id desc, w.publishAt, ww.ordr
		")->fetchAll(PDO::FETCH_ASSOC);
	
  	$app->response()->header('Content-Type', 'application/json');

	$results = array();
	$previousId = 0;
	$oldww =0;
	$w =null;

	foreach($wods as $wod) 
	{
		if($previousId != $wod['wodId']){
			$w = new Wod(
				$wod["wodId"],
		 		$wod['title'],
		 		$wod['createdAt'],
		 		$wod['publishAt']
		 	);	

			$previousId = $wod['wodId'];
		 	$results[]=$w;
		}
		
		
		if($oldww != $wod['workoutId']){
			$ww = new Wodworkout($wod['workoutId'],$wod['subtitle'],$wod['workout'],$wod['ordr']);

			$w->AddWorkout($ww);

		}

		$previous = $wod['wodId'];
		$oldww = $wod['workoutId'];

	}

	echo json_encode($results);

});

$app->post('/wods',function() use ($app){

    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);
    
    var_dump($input);
    try{
    	 $app->db->beginTransaction(); 

	    $date = date("Y-m-d H:i:s");
	    $stmt = $app->db->prepare("insert into wod (title,publishAt,createdAt) values (:title,:publish,:created) ");
		$stmt->execute([
			':title' => $input->title,
			':publish' => $input->publishAt,
			':created' => $date
			]);

		$lastId = $app->db->lastInsertId();

		$stmt = $app->db->prepare("insert into wodworkout (subtitle,workout,wod_id,ordr) values (:subtitle,:workout,:wodid,:ordr) ");

		foreach ($input->workouts as $workout) {
			$stmt->execute([
				':subtitle' => $workout->subtitle,
				':workout' => $workout->wod,
				':wodid' => $lastId,
				':ordr' => $workout->order
				
			]);
	    }

	    $app->db->commit();	

    } catch(PDOExecption $e) { 
        $app->db->rollback(); 
        echo "Error!: " . $e->getMessage(); 
    } 

});

?>