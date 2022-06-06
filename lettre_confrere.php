
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="titi.css">
    <link rel="stylesheet" href="toto.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
</head>
<body>
        <!-- <div><b>Clinique Nom </b> <br>
            Adresse:Adresse <br>
            ici <br>
            Tel : 0601020304 <br><br>
            <b>Dr {Nom & Prénom}</b> <br>
            Médecin {Spécialité} <br><br>
        </div> -->
        <button><a href="dossiersPatient.php" >retour</a></button>

        <h1><u>Lettre confrère</u></h1>
        <form method="Post" action="./lettre_save.php">  
        <div>
            Dr destinataire : <input type="text" id="dr_destinataire" name="dr_destinataire" value="">
            Médecin : <input type="text" id="specialite" name="specialite" placeholder="spécialité">
            Adresse:<input type="text" id="adresse" name="adresse" placeholder="adresse"> <br>
        </div>
        <div>Date:<input type="text" id="date" name="date" value="<?php echo date("Y/m/d");?>"></div>
        <div> objet: <input type="text" id="objet" name="objet" placeholder="objet de lettre"></div>
        <label>Contenu:</label>
        <textarea id="contenu" name="contenu" rows="10" cols="70">  Cher confrère,



Je vous remercie de votre confiance.

Je vous prie de croire, Cher confrère, en mes sentiments les meilleurs. </textarea>
    
        <div class="hiho"> <input name="submit_form" type="submit" value="Enregistrer"></div>
    </form>
        
    <!-- <div class="hiho"> Signature : </div> -->

</body>
</html>