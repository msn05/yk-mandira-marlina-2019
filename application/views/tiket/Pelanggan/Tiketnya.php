<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<style>
	h1.Text{
		color: green;
		font-size: 50px;
		text-align: center;
	}
	body{
		border-style: dotted;
		width:100%; 
		height:100%;
	}

</style>
</head>
<body>
	<h1 class="Text"><?=strtoupper($nomorKursi);?></h1>
	<hr>
	<small style="text-align:justify-all;">Silakan Tukarkan Pada Loket Maskapai <?=$maskapai;?> Sebelum waktu keberangkatan</small>
</body>
</html>
