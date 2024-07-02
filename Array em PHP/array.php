<?php

//Introdução a arrays em PHP

$frutas = array ('Maça', 'Banana' , 'Laranja' , 'Morango');

print_r ($frutas);

echo"<hr>";

$numeros = [2,5,6,9];
print_r($numeros);
echo '<hr>';

$alunos = array('João' => 18, 'Maria' => 20, 'Pedro' => 19);
print_r($alunos);
echo '<hr>';

//acessando os elementos

echo 'A segunda fruta é ' . $frutas[1];
echo '<hr>';
echo 'O terceiro numero é ' . $numeros[2];
echo '<hr>';
echo 'A idade de João é ' . $alunos['João'];
echo '<hr>';

//Alteração de elementos 

$frutas[0] = 'Pera';

print_r($frutas);
echo '<hr>';

$numeros[4] = 100;

print_r($numeros);
echo '<hr>';

$alunos['Maria'] = 21;
$alunos['Ana'] = 21;

print_r($alunos);
echo '<hr>';


//adicionando um array

$frutas [] = 'abacaxi';
echo '<hr>';

print_r($frutas);
echo '<hr>';
$numeros[] = 93;
$alunos['Jose'] = 25;
print_r($numeros);
echo '<hr>';
print_r($alunos);
echo '<hr>';

//percorrendo pelos elementos

echo 'Listas de frutas: ';
foreach($frutas as $fruta){
    echo $fruta . ", "
;}
echo '<hr>';

echo 'Listas de numeros: ';
foreach($numeros as $numero){
    echo $numero . ", "
;}

echo '<hr>';

foreach($alunos as $nome => $idade){
    echo $nome . " tem  " . $idade . ' anos. <br> '
;}

echo '<hr>';

//Funções úteis para arrays

echo 'Número de elementos no array de frutas são : ' . count($frutas) . '<br>';
echo '<hr>';

echo "Indice de fruta Laranja : " . array_search('Laranja', $frutas) ;
echo '<hr>';

echo "Ultima fruta do array: " . end($frutas) . '<br>';

print_r($frutas);
echo '<hr>';
echo 'Array de frutas depois de reverter: <br> ';
$frutas_revertidas = array_reverse($frutas);
print_r($frutas_revertidas);

