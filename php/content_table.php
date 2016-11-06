<h2>Table</h2>
<?php
include 'config.php';
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM list");
#echo "<button type='button' id='btnshow'>Edit!</button>";
echo "<table border='1'>
<tr>
<th>File Name</th>
<th>Thumbnail</th>
<th>Story Date</th>
<th>Date Alias</th>
<th>Title</th>
<th>Description</th>
<th>Context</th>
<th>Importance</th>
<th>Archive?</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['filename'] . "</td>";
  echo "<td>" . $row['thumbnail'] . "</td>";
  echo "<td>" . $row['storydate'] . "</td>";
  echo "<td>" . $row['datealias'] . "</td>";
  echo "<td>" . $row['title'] . "</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "<td>" . $row['context'] . "</td>";
  echo "<td>" . $row['importance'] . "</td>";
  echo "<td><a href='archive.php?delid=" . $row['id'] . "'>Archive!</a></td>";
  echo "</tr>";
  }
  echo "</table>";
?>
<script>
$(document).ready(function(){
  $('.tredit').hide();
  });
$("#btnshow").click(function(){
  $(".tredit").toggle();
});
</script>
