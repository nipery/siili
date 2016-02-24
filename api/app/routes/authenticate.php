<?php

const ATHLETE = 'Athlete';
const COACH = 'Coach';

use \Firebase\JWT\JWT;

$app->post('/authenticate',function() use ($app) {

    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

});

$app->post('/authenticate/signup',function() use ($app) 
{

    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);
   
   	if(!validateSignUpInfo($input,true)){
   		$app->response->setStatus(400);	

   		return;
   	}

	$crypted_passwd = cryptPasswd($input->password);
	
   	$user = new User($input->username, $input->email,$crypted_passwd,ATHLETE);

   	saveUserInfo($user,$app);

   	echo json_encode($user->username);

});


$app->post('/authenticate/login',function() use ($app) 
{

    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);
   
   	if(!validateSignUpInfo($input,false)){
   		$app->response->setStatus(400);	

   		return;
   	}

   	$user = getUser($input->username,$app);

   	if(!$user)
   	{
   		echo 'Cannot find user with given username!';
   		$app->response->setStatus(400);	
   		return;
   	}	

   	if(!validateUserPassowrd($input->password,$user->password))
   	{
   		echo 'Invalid password!';
   		$app->response->setStatus(400);	
   		return;
   	}

	$token = createToken($user);

});


function createToken($user)
{

	$key = "example_key";

	$token = array(
    	"iss" => "http://crossfitsiilinjarvi.fi",
    	"aud" => "http://example.com",
    	"iat" => 1356999524,
    	"nbf" => 1357000000
	);


   	$jwt = JWT::encode($token, $key);
	$decoded = JWT::decode($jwt, $key, array('HS256'));

	var_dump($decoded);
}


function getUser($username,$app)
{
  	$stmt = $app->db->prepare("select rid, userid,email,password,status from users where verified =0 and userid = :userid limit 1");
	$stmt->execute([
			':userid' => $username
	]);

	$result = $stmt->fetchAll();

	if($result){
		
		$user = new User($result[0]['userid'],$result[0]['email'],$result[0]['password'],$result[0]['status']);
		return $user;
	}

}


function saveUserInfo($user,$app)
{
	try{
	    $stmt = $app->db->prepare("insert into users (userid,email,password) values (:username,:email,:password) ");
		$stmt->execute([
			':username' => $user->username,
			':email' => $user->email,
			':password' => $user->password
			]);

	} catch(PDOExecption $e) { 
    	echo "Error!: " . $e->getMessage(); 
    } 
}

function validateSignUpInfo($info, $validateEmail)
{
	if(!$info)
		return false;

	try{
		if(!$info->username)
			return false;

		if($validateEmail){
			if(!$info->email)
				return false;
		}

		if(!$info->password)
			return false;

	} catch(Exception $e){
		return false;
	}
	
	if($validateEmail){
		if (!filter_var($info->email, FILTER_VALIDATE_EMAIL)) {
	  		return false;
		}
	}

	return true;
}


function validateUserPassowrd($src,$hashedPassword)
{

	if(crypt($src,$hashedPassword) == $hashedPassword)
	{
		return true;
	}
	
	return false;

}

function cryptPasswd($src, $rounds = 9)
{
	$salt ="";
	$salt_chars = array_merge(range('A','Z'),range('a','z'),range(0,9));

	for($i =0; $i < 22; $i++)
	{
		$salt .= $salt_chars[array_rand($salt_chars)];
	}

	return crypt($src, sprintf('$2y$%02d$',$rounds) .$salt);

}

?>