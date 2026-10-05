<?php
$cijfer=8;

switch(true) {
    case $cijfer>=9:
        echo  "Uitstekend!";
        break;
    case $cijfer>=7:
        echo "Goed!";
        break;
    case $cijfer  >=5:
        echo "Voldoende!";
        break;
    default:
        echo "Onvoldoende!" ;
}
?>