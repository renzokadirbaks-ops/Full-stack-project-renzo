<?php
$maand="augustus";

switch($maand) {
    case "december":
    case "januari":
    case "februari":
        echo "Het is winter!";
        break;
    case "maart":
    case "april":
    case "mei":
        echo  "Het is lente!";
        break;
    case "juni":
    case "juli":
    case "augustus":
        echo "Het is zomer!";
        break;
    case "september":
    case "oktober":
    case "november":
        echo "Het is herfst!" ;
        break;
}
?>