





<?php
    require "utils.php";
    ouvreSession();
    
    echo 'bonjour patient no: '.$_SESSION['idcompte'];
?>


<?php
  $host = 'localhost';
  $dbname = 'cabinetDB';
  $username = 'root';
  $password = '';
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  // récupérer tous les utilisateurs
  $sql = "SELECT rdv.idRdv , rdv.DateRdv , rdv.prix ,
  compte.PrenomUser , compte.NomUser , compte.TelephoneUser , compte.Email
   FROM `rdv` join compte 
   WHERE compte.IdCompte = rdv.idCompte   AND compte.IdCompte = $_SESSION['idcompte'] " ;
  
   
  try{
   $pdo = new PDO($dsn, $username, $password);
   $stmt = $pdo->query($sql);
   if($stmt === false ){
    die("Erreur");
   }
   
  }catch (PDOException $e){
    echo $e->getMessage();
  }

  
?>






