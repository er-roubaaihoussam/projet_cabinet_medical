<?php
    function existe($champs)
    {
        return isset($champs) && !empty($champs);
    }
    function base_donnees()
    {
        return new PDO('mysql:host=localhost;dbname=cabinetdb;','root','');
    }
    function ouvreSession()
    {
        if(!session_id())
      {
         session_start();
         session_regenerate_id();
      }
    }
?>