<?php

function nactiTridu(string $trida) : void
{
    require("tridy/$trida.php");
}

spl_autoload_register("nactiTridu");

mb_internal_encoding("UTF-8");	

Databaze::pripoj('localhost', 'root', '', 'datab_poj');
?>
<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta charset="UTF-8">
        <title>O aplikaci</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <div id="nadpis">
            <h1><a href="index.php">Evidence pojištěných</a></h1>
            </div>
        <nav>
            <ul>
                <li><a href=index.php>Pojištěnci</a></li>
                <li><a href=o-aplikaci.php>O aplikaci</a></li>
                <li><a href=kontakt.php>Kontakt</a></li>
            </ul>
        </nav>
        </header>
        <article>
                <h2>Kontakt</h2>
                <p>Ing. Anna Nováková<br>
                    Uhersko 9, 533 73 Uhersko<br>
                    anna.uhersko@seznam.cz</p>
                
            <?php 
            
            ?>
        </article>
        <footer>
            <strong><a href="mailto:annovakova@icloud.com"> Ing. Anna Nováková </a></strong>: závěrečný projekt rekvalifikačního kurzu od IT network
        </footer>
    </body>
</html>
