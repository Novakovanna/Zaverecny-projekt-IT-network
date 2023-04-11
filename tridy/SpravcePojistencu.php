<?php

class SpravcePojistencu
{
    public function vratPojistence() : array
    {
        return Databaze::dotazVsechny('
            SELECT `pojistenci_id`, `jmeno`, `prijmeni`, `vek`, `telefon`, `typ_pojisteni` 
            FROM `pojistenci`
            ORDER BY `pojistenci_id` DESC
            LIMIT 8
        ');
    }
    
    public function vypisPojistence() : void {
        
        // vypíše všechny pojištěnce z tabulky "pojištěnci"
                        
        $pojistenci = $this->vratPojistence();
        
        foreach ($pojistenci as $pojistenec) 
        {
        echo('<tr>');
            echo('<td>');
                echo($pojistenec['jmeno']);
            echo('</td>');
            echo('<td>');
                echo($pojistenec['prijmeni']);
            echo('</td>');
            echo('<td>');
                echo($pojistenec['vek']);
            echo('</td>');
            echo('<td>');
                echo('<a href="tel:' . $pojistenec['telefon'] . '">' . $pojistenec['telefon'] . '</a>');
            echo('</td>');
            echo('<td>');
                echo($pojistenec['typ_pojisteni']);
            echo('</td>');
        echo('</tr>');
        }
    }
    
    public function pridejPojistence(string $jmeno, string $prijmeni, int $vek, string $telefon, string $typ_pojisteni) : void 
    {
        Databaze::dotaz('
            INSERT INTO `pojistenci`
            (`jmeno`, `prijmeni`, `vek`, `telefon`, `typ_pojisteni`) 
            VALUES (?, ?, ?, ?, ?)
        ', array($jmeno, $prijmeni, $vek, $telefon, $typ_pojisteni));  
    }
    
    public function odesliFormular () 
    {
        $this->pridejPojistence($_POST['jmeno'], $_POST['prijmeni'], $_POST['vek'], $_POST['telefon'], $_POST['typ_pojisteni']);
        header('Location: index.php');
        exit;  
    }

    private Captcha $captcha;

    public function __construct()
    {
        $this->captcha = new CaptchaRok();
    }
}