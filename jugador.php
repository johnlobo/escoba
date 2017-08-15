<?php
function compararCartas($a, $b){
	if (substr($a,1)>substr($b,1))
		return 1;
	else if (substr($a,1)<substr($b,1))
    		return -1;
	else
		return 0;
}
	


function sumaBaza($esc){
	print_r($esc);
	$suma=0;
	foreach($esc as $carta){
		$suma+=substr($carta,1);
		echo("sumo...".$carta."  ");
	}
	echo("suma:".$suma."  ");
	return $suma;
}

function oros($esc){
	$suma =0;
	foreach($esc as $carta){
		if(substr($carta,0,1) == "o")
			$suma++;
	}
	return $suma;
}

function sietes($esc){
	$suma =0;
	foreach($esc as $carta){
		if(substr($carta,1) == "7")
			$suma++;
	}
	return $suma;
}

function velus($esc){
	$suma=0;
	foreach($esc as $carta){
		if($carta == "o7")
			$suma++;
	}
	return $suma;
}

function mejor($esc1,$esc2){
	$valor1 = 0;
	$valor2 = 0;

	//Cartas
	if ($esc1.length>$esc2.length){
		$valor1++;
	}
	else{
		$valor2++;
	}
	// Oros
	$valor1 += oros($esc1);
	$valor2 += oros($esc2);

	// Sietes
	$valor1 += sietes($esc1);
	$valor2 += sietes($esc2);
	
	// Velus 
	$valor1 += velus($esc1);
	$valor2 += velus($esc2);


	if ($valor1>$valor2){
		$mejor = $esc1;
	}else{
		$mejor = $esc2;
	}

	return $mejor;
}


function jugar(){
	$cartasJugador=split(",",$_GET['jugador']);
	$cartasMesa = split(",",$_GET['mesa']);
	$escoba=array();
	$mejor=array();
	
	usort($cartasMesa,compararCartas);

	foreach($cartasJugador as $cartaJ){
		array_push($escoba, $cartaJ);
		foreach($cartasMesa as $cartaM1){
			array_push($escoba,$cartaM1);
			if(sumaBaza($escoba) == 15){
				echo("escoba!!<br>");
				$mejor = mejor($mejor, $escoba);	
			}else{
				echo("na...<br>");
			}
		array_pop($escoba);
		}
	}

	return $mejor;
      } // fin jugar()


function jugarMejorado(){
	$cartasJugador=split(",",$_GET['jugador']);
	$cartasMesa = split(",",$_GET['mesa']);
;
	$mejor=array();
	
	usort($cartasMesa,compararCartas);

	array_push($escoba, $cartaJugador[0]);
	$i=0;
	while (($i<count($cartasMesa)) && (sumaBaza(array($cartaJugador[0],$cartasMesa[$i]))<=15)){
		$j=0;
		$escoba=array();
		array_push($escoba, $cartasMesa[$i]);
		if (sumaBaza($escoba) == 15){
			echo("escoba!!<br>");
			$mejor = mejor($mejor, $escoba);
		}else{
			while ($j<count($cartasMesa)){
				if ($i!=$j){
					array_push($escoba, $cartasMesa[$j]);
					if(sumaBaza($escoba) == 15){
						echo("escoba!!<br>");
						$mejor = mejor($mejor, $escoba);	
					}else{
						echo("na...<br>");
					}
				}
				$j++;
			}	
		}
		$i++;
	}

	return $mejor;
      } // fin jugar()



// Bucle principal


print_r(jugar());
echo("<hr>");
print_r(jugarMejorado());

?>
