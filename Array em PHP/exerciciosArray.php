<?php
 // 1

 $diasSemana = array ('Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sabado');

 print_r($diasSemana);

 echo '<hr>';

 echo "O terceiro dia da semana é: " . $diasSemana[2];

 echo '<hr>';


 //2

 $mesesAno = array ('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

 $mesesAno[11] = 'Onzembro';

print_r($mesesAno);

//3 
echo '<hr>';

$numeros = array (1, 2, 3, 4, 5);

$numeros [] = 6 ;


print_r($numeros);

echo '<hr>';

//4

echo 'Listas de meses: ';
foreach($mesesAno as $meses){
    echo $meses . ", "
;}

echo '<hr>';

//5 

echo "Numero de elementos do array de dias da semana : " . count($diasSemana);

echo '<hr>';

//6

echo "Indice do Sabado é: " . array_search("Sabado", $diasSemana);



