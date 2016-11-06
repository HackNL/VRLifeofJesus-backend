<?php
include 'config.php';

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM list");
$response = array();
$posts = array();

//http://stackoverflow.com/questions/2467945/how-to-generate-json-file-with-php
//https://pear.php.net/manual/en/package.database.mdb.intro-fetch.php

while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $filename = $row['filename'];
	$thumbnail = $row['thumbnail'];
	$storydate = $row['storydate'];	
	$datealias = $row['datealias'];
	$title = $row['title'];
	$description = $row['description'];
	$context = $row['context'];
	$importance = $row['importance'];

	$posts[] = array('filename' => $filename,
					 'thumbnail' => $thumbnail,
					 'storydate' => $storydate,
					 'datealias'=> $datealias,
					 'title'=> $title,
					 'description'=> $description,
					 'context'=> $context,
					 'importance'=> $importance);
	
}

$response['videos'] = $posts;

$fp = fopen('data.json', 'w');
fwrite($fp, json_encode($response));
fclose($fp);

?> 
