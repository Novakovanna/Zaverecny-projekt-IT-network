<?php
    
    session_start();
    mb_internal_encoding("UTF-8");	

    function nactiTridu(string $trida) : void
    {
        require("tridy/$trida.php");
    }

    spl_autoload_register("nactiTridu");

    Databaze::pripoj('localhost', 'root', '', 'datab_poj');

    $spravcePojistencu = new SpravcePojistencu();
    $captchaRok = new CaptchaRok();
    
?>
<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta charset="UTF-8">
        <title>Pojištění</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
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
                <h2>Seznam pojištěnců</h2><br>
                <div class="container-md">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Jméno</th>
                            <th>Příjmení</th>
                            <th>Věk</th>
                            <th>Telefon</th>
                            <th>Typ pojištění</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php        
                     $spravcePojistencu->vypisPojistence();
                    ?>   
                    </tbody>
                </table>
                </div>
            <div id="novy-pojistenec"> 
                <!-- formulář pro odeslání nového pojištěnce do databáze
                TODO zeptat se jak udělat aby se pořád neodesílalo při reloadu-->
                <h2>Nový pojištěnec</h2>
                <p><em>Tímto formulářem zašlete požadavek o zřízení pojištění. Náš pojišťovací agent se Vám na uvedený email ozve do 3 pracovních dní.</em></p>
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Vaše jméno</label>
                            <input type="text" name="jmeno" class="form-control" required="required" value="<?php if (isset($_POST['jmeno'])); ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Vaše příjmení</label>
                            <input type="text" name="prijmeni" class="form-control" required="required" value="<?php if (isset($_POST['prijmeni'])) ; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Váš věk</label>
                            <input type="text" name="vek" class="form-control" required="required" value="<?php if (isset($_POST['vek'])) ; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Vaše telefonní číslo</label>
                            <input type="text" name="telefon" class="form-control" placeholder="+420" required="required" value="<?php if (isset($_POST['telefon'])) ; ?>"/>
                    </div><br>
                    <div class="mb-3">
                        <h3>Pojištění, které chcete sjednat</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="typ_pojisteni" id="typ_pojisteni1" value="Pojištění majetku" checked>
                            <label class="form-check-label" for="typ_pojisteni1">
                            Pojištění majetku
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="typ_pojisteni" id="typ_pojisteni2" value="Pojištění zvířat">
                            <label class="form-check-label" for="typ_pojisteni2">
                            Pojištění zvířat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="typ_pojisteni" id="typ_pojisteni3" value="Životní pojištění">
                            <label class="form-check-label" for="typ_pojisteni3">
                            Životní pojištění
                            </label>
                        </div><br>
                    </div>
                    <?php $captchaRok->vypis(); ?><br>
                    <input class="btn btn-primary" type="submit" value="Odeslat" />
                    <?php
                    
                    if ($_POST)
                    {
                        if ($captchaRok->over())
                        {
                            $spravcePojistencu->odesliFormular();
                        }
                    }
                    
                    ?>
                </form>
            </div>
        </article>
        <footer>
            <strong><a href="mailto:annovakova@icloud.com"> Ing. Anna Nováková </a></strong>: závěrečný projekt rekvalifikačního kurzu od IT network
        </footer>
    </body>
</html>
