<?php
$dag = "dinsdag";

switch ($dag) {
    case "maandag":
        echo "Het is maandag, legs";
        break;
    case "dinsdag":
        echo "Het is dinsdag, rug en tricep";
        break;
    case "woensdag":
        echo "Het is woensdag, rustdag";
        break;
    case "donderdag":
        echo "Het is donderdag, schouders en forearms";
        break;
    case "vrijdag":
        echo "Het is vrijdag, chest en bicep";
        break;
    case "zaterdag":
        echo "Het is zaterdag, weekend";
        break;
    case "zondag":
        echo "Het is zondag, rustdag";
        break;
    default:
        echo "dit is geen dag mattie";
}
?>