<?php
    session_start();
    if (isset($_POST['submit_form'])){
      $_SESSION["date"] = $_POST['date'];
      $_SESSION["choix"] = $_POST['choix'];
      $_SESSION["age"] = $_POST['age'];
      $_SESSION["nom_patient"] = $_POST['nom_patient'];
      $_SESSION["cin"] = $_POST['cin'];
      $_SESSION["contenu"] = $_POST['contenu'];

    
    // foreach ($name as $key=>$value){ 
    //     echo $value."<br />";
    // }
      header("Location: certificat_modification.php");
        
        
    }



?> 

