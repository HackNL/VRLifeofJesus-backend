<h2>Upload</h2>
<?php
include 'config.php';
mysqli_query($con);
//            /home/krkooistra/domains/klaaskooistra.nl/public_html/vrlifeofjesus/uploads
//Upload File

if (isset($_POST['submit'])) {
	
	//from w3schools
$target_dir = "/home/krkooistra/domains/klaaskooistra.nl/public_html/vrlifeofjesus/uploads/";
$target_file = $target_dir . basename($_FILES["imagename"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagename"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br/>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["imagename"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["imagename"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.<br/>";
    }
}
}
    if (is_uploaded_file($_FILES['videoname']['tmp_name']) and (is_uploaded_file($_FILES['imagename']['tmp_name']))) {

        echo "<h1>" . "File ". $_FILES['videoname']['name'] ." uploaded successfully." . "</h1>";
		echo "<h1>" . "File ". $_FILES['imagename']['name'] ." uploaded successfully." . "</h1>";
        echo "<h2>Displaying contents:</h2>";
    }

    //Import uploaded filesize
	//Insert into database
		$videofilename = $_FILES['videoname']['name'];
		$imagefilename = $_FILES['imagename']['name'];
        $import="INSERT into list(filename,thumbnail,storydate,datealias,title,description,context,importance) values('$videofilename' ,'$imagefilename','$_POST[storydate]','$_POST[timeline]','$_POST[title]','$_POST[description]','$_POST[context]','$_POST[importance]')";

		if (!mysqli_query($con,$import))
		  {
		  die('Error: ' . mysqli_error($con));
		  }

    print "Import done";

    //view upload form
}else {
    print "Upload new video and thumbnail and fill in the info fields<br/><br/>\n";
    print "<form enctype='multipart/form-data' action='add.php' method='post'>";
	print "<h2>General</h2>";
	print "Title:<input type='text' name = 'title'></input><br><br>";
	print "Story Date:<input type='text' name = 'storydate'></input><br><br>";
	print "Description:<textarea type='text' name = 'description'></textarea><br><br>";
	print "Context:<textarea type='text' name = 'context'></textarea><br><br>";
	print "Timeline Position:<label id='timelineValue'>50</label><input type='range' name = 'timeline'min=0 max=100 onchange='updateTimelineText(this.value)';><br>";
	print "Importance:<label id='importanceValue'>50</label><input type='range' name = 'importance'min=0 max=100 onchange='updateImportanceText(this.value)';><br>";
    print "Video to import:<br />\n";
    print "<input size='50' type='file' name='videoname'><br />\n";
	print "Thumbnail to import:<br />\n";
    print "<input size='50' type='file' name='imagename'><br />\n";
    print "<input type='submit' name='submit'></form>";
}
?>
<script>
function updateTimelineText(val) {
	document.getElementById('timelineValue').innerHTML=val; 
}
function updateImportanceText(val) {
	document.getElementById('importanceValue').innerHTML=val; 
}		
</script>
