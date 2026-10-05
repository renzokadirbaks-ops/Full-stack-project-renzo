Nu je de basis van nummers en strings weet gaan we beginnen met operators en rekenen

Math:
php heeft een aantal math functies zoals
    pi(); geeft de waarde van pi terug
    <?php echo pi();?>


    Min en Max functies kunnen gebruikt worden om de laagst of hoogste waarde in een lijst te vinden
    min();
    <?php echo(min(0,150,30,20,-8,-200));?>

    max();
    <?php echo(max(0,150,30,20,-8,-200));?>


    geeft een waarde terug met de absolute value of een positieve nummer
    abs();
    <?php echo abs(-6.7);?>


    geeft de sqaure root terug van een nummer
    sqrt();
    <?php echo sqrt(64);?>


    rond een nummer af naar het dichtbij zijne integer
    round();
    voorbeeld: 
    <?php echo round(0.60);?>
    
    Geef een random nummer tussen een x,x waarde,
    rand();
    <?php echo rand(0, 100); // geeft een random waarde tussen 0 en 100?>