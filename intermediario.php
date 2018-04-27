<html>
<body>
<h3>Archivo de pruebas de C++ y PHP - Estructuras - 2 - 2014 - ECCI - UCR</h3>
<h2>CONECTANDO PHP CON C++</h2>
<h3>INTERMEDIARIO PHP CON SERVIDOR (C++)</h3>
<h4>ricardogang@gmail.com</h4>

<?php
echo $data;
$data=$_POST['data'];
exec("$data,$output);

foreach($output as $line){
	//echo "<script type='text/javascript'>alert('$line');</script>";
	echo "<h3>$line</h3>" ;
}
?>
</body>
</html>