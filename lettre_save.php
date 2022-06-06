<?php
    session_start();
    if (isset($_POST['submit_form'])){
        $_SESSION["dr_destinataire"] = $_POST['dr_destinataire'];
        $_SESSION["specialite"] =$_POST['specialite'];
        $_SESSION["adresse"] = $_POST['adresse'];
        $_SESSION["date"] = $_POST['date'];
        $_SESSION["objet"] = $_POST['objet'];
        $_SESSION["adresse"] = $_POST['adresse'];
        $_SESSION["contenu"] = $_POST['contenu'];
      
      header("Location: lettre_modification.php");
        
        
        $conn->close();
    }



?> 

