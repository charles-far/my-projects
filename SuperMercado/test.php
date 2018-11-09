<?php
$stack = array("orange", "banana");
array_push($stack, "apple", "raspberry");
print_r($stack);

$array = array();
for ($x = 1; $x <= 10; $x++)
{
    $array[] = $x;
}

print "<pre>";
print_r($array);
print "</pre>";

echo '<script>';
echo 'var p1 = "success";';
echo '</script>';

echo '<script>document.writeln(p1);</script>';

//echo '<a href="javascript:alert(document.getElementById("txt"));>Get value</a>';
echo '<a href="javascript:getTextValue()"> Click Me! </a>';

?>

<!DOCTYPE html>
<html>
<body>

<input type="text" name="txt" id="txt">
<input type='submit' name="submit" value='submit'>

<script>
function getTextValue(){
    var txt;
    txt = document.getElementById("txt");
    alert(txt.value);
}
</script>

</body>
</html>