<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of CaptchaRok
 *
 * @author anna
 */
class CaptchaRok implements Captcha
{
    public function vypis() : void
    {
        echo('<label for="exampleFormControlInput1" class="form-label">Zadejte aktuální rok: </label>');
        echo('<input type="text" name="overeni" class="form-control" />');
    }

    public function over() : bool
    {
        return ($_POST['overeni'] == date("Y"));
    }
}
