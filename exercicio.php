<?php

$num = 89;

if ($num < 2) {
    echo "Não é um número primo <hr>";
} else if ($num == 2) {
    echo "É um número primo <hr>";
} else if ($num % 2 == 0) {
    echo "Não é um número primo <hr>";
} else if ($num % 3 == 0 && $num != 3) {
    echo "Não é um número primo <hr>";
} else if ($num % 5 == 0 && $num != 5) {
    echo "Não é um número primo <hr>";
} else if ($num % 7 == 0 && $num != 7) {
    echo "Não é um número primo <hr>";
} else if ($num % 11 == 0 && $num != 11) {
    echo "Não é um número primo <hr>";
} else {
    echo "É um número primo ! <hr>";
}