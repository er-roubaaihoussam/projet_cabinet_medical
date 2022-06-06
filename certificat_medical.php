<?php
    session_start();
    $idcompte = $_SESSION['idcompte'];  
    $idcompte_patient = $_GET['id'];
    
    
    
    
    $conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $users = $conn->query("SELECT * FROM compte WHERE IdCompte=$idcompte_patient;");
    $row= $users->fetch_assoc();
    $_SESSION["idcompte_patient"] =$row["IdCompte"];
?>
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
    <h1> Certificat Médical</h1>
    <form method="Post" action="./certificat_save.php"> 
    Date : <input type="text" id="date" name="date" value="<?php echo date("Y/m/d");?>">
    Nom du patient: <input type="text" id="nom_patient" name="nom_patient" value="<?php echo $row['PrenomUser'].' ' . $row['NomUser']; ?>">
    Date de naissance : <input type="text" id="age" name="age" value="<?php echo $row['NaissanceUser'] ?>">
    CIN : <input type="text" id="cin" name="cin" value="<?php echo $row['CinUser'] ?>"><br>
    Choisir une option: <br><input type="checkbox" id="1" name="choix[]"  value="Le patient présente de signe de malade tuberculose.">1. Le patient présente de signe de malade tuberculose.<br>
    <input type="checkbox" id="2" name="choix[]" value="Le patient ne présente pas de signe de malade tuberculose.">2. Il ne présente pas de signe de malade tuberculose.<br>
    <input type="checkbox" id="3" name="choix[]" value="Le patient est atteint d’affection dermatologie contagieuse.">3. Il est atteint d’affection dermatologie contagieuse.<br>
    <input type="checkbox" id="4" name="choix[]" value="Le patient n'est pas atteint d’affection dermatologie contagieuse.">4.elle n’est pas atteint d’affection dermatologie contagieuse.<br>
    <input type="checkbox" id="5" name="choix[]" value="Autre cas à signaler par le Médecin:">5. Autre cas à signaler par le Médecin. <br><textarea id="contenu" name="contenu" rows="4" cols="40">
</textarea>
<br>
<input name="submit_form" type="submit" value="Enregistrer">
    </form>
    <button><a href="dossiersPatient.php" >retour</a></button>


</body>
</html>