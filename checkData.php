<?
function ValidaData($data)
{
	$data = explode("/", "$data"); // fatia a string $dat em pedados, usando / como referência
	$day = $data[0];
	$month = $data[1];
	$year = $data[2];

	// verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)
	$res = var_dump(checkdate($month, $day, $year));
	if ($res == 1) {
		echo "data válida!";
	} else {
		echo "data inválida!";
	}
}

ValidaData("yyyy/mm/dd");
