<?php
    require "utils.php";
    if(isset($_POST['inscription']))
    {
    if(existe($_POST['nom']) && existe($_POST['prenom']) &&existe($_POST['cin'])
       &&existe($_POST['email']) && existe($_POST['password'])&&existe($_POST['adresse'])
       &&existe($_POST['telephone'])&&existe($_POST['sexe'])&&existe($_POST['naissance'])
       &&existe($_POST['ville']) )
       {
        $nom=$_POST['nom'];$prenom=$_POST['prenom'];$cin=$_POST['cin'];
        $email=$_POST['email'];$password=$_POST['password'];$adresse=$_POST['adresse'];
        $telephone=$_POST['telephone'];$sexe=$_POST['sexe'];
        $naissance=$_POST['naissance'];$ville=$_POST['ville'];

        $bdd=base_donnees();
        $insertion=$bdd->prepare('INSERT INTO compte(Email,Password,TypeCompte,PrenomUser,
                        NomUser,TelephoneUser,NaissanceUser,addressUser,CinUser,SexeUser ,Ville)
                 VALUES(:email,:password,"patient",:prenom,:nom,:telephone,:naissance,:adresse,
                 :cin,:sexe,:ville)');
    $insertion->bindValue('email',$email);$insertion->bindValue('password',$password);
    $insertion->bindValue('cin',$cin);$insertion->bindValue('adresse',$adresse);
    $insertion->bindValue('prenom',$prenom);$insertion->bindValue('nom',$nom);
    $insertion->bindValue('telephone',$telephone);$insertion->bindValue('naissance',$naissance);
$insertion->bindValue('sexe',$sexe);
$insertion->bindValue('ville',$ville);
    $insertion->execute();
    header('Location: cabinetLogin.php');
       }
    }
?>
<!DOCTYPE html>
<html>
      <head>
	       <title> test</title>
	       <meta charset="utf-8">
		   <link rel="stylesheet" href="style-inscription.css">
       <link rel="stylesheet" href="css/bootstrap.min.css">
       <script src="https://kit.fontawesome.com/3f8b3dee73.js" crossorigin="anonymous"></script>
        </head>
    
          <body>
              <!--BEGIN BREADCRUMB-->
             <nav class="col-12">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a href="accueil.php">Accueil</a></li>
                        <li class="breadcrumb-item active">Inscription</li>
                    </ol>
                </nav>
       <!--FIN-->
            <h3 class="mx-auto">Formulaire d'inscription</h3>

            <form method="POST" class="container mt-5 w-75">
                <div class="row">
                    <div class="nomComplet px-2 col-9">
                        <label class="form-label d-block mx-auto w-25">Nom Complet</label>
                        <input type="text" name="nom" class="form-control d-inline" placeholder="votre nom" required>
                        <input type="text" name="prenom" class="form-control d-inline" placeholder="votre prenom" required>
                    </div>
                    <div class="cin col-3">
                        <label for="cin" class="form-label">CIN</label>
                        <input type="text" name="cin" class="form-control" id="cin" placeholder="votre CIN" required>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="email px-2 col-6">
                        <label class="form-label d-block">EMAIL</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="votre email" required>
                    </div>
                    <div class="password col-6">
                        <label for="password" class="form-label">PASSWORD</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="choisissez un mot de passe" required>
                    </div>
                </div>
                <div class="adresse mt-4">
                    <label for="adresse" class="form-label">ADRESSE</label>
                    <input type="text" name="adresse" class="form-control" id="adresse" required>
                </div>
                <div class="row mt-4">
                    <div class="col-4 telephone">
                        <label for="telephone" class="form-label">TELEPHONE</label>
                        <input type="text" name="telephone" class="form-control" id="telephone" required>
                    </div>
                    <div class="col-4 sexe">
                        <label for="sexe" class="form-label">SEXE</label>
                        <select class="form-select form-select-lg mb-3" name="sexe" id="sexe" required>
                            <option selected value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                          </select>
                          
                    </div>
                    <div class="col-4 date">
                        <label for="naissance" class="form-label">Date de naissance</label>
                        <input type="date" name="naissance" id="naissance" required>
                    </div>
                    <div class="col-4 date">
                        <label for="ville" class="form-label">Ville</label>
                        <select class="form-select form-select-lg mb-3" name="ville" id="ville" required>
                            
                            <option value="AGADIR">AGADIR</option>
                                                                                                                                <option value="AL HAOUZ">AL HAOUZ</option>
                                                                                                                                <option value="AL HOCEÏMA">AL HOCEÏMA</option>
                                                                                                                                <option value="ASSA-ZAG">ASSA-ZAG</option>
																															<option value="AZILAL">AZILAL</option>
																															<option value="BENI-MELLAL">BENI-MELLAL</option>
																															<option value="BENSLIMANE">BENSLIMANE</option>
																															<option value="BERKANE">BERKANE</option>
																															<option value="BERRECHID">BERRECHID</option>
																															<option value="BOUJDOUR">BOUJDOUR</option>
																															<option value="BOULEMANE">BOULEMANE</option>
																															<option selected value="CASABLANCA" >CASABLANCA</option>
																															<option value="CHEFCHAOUEN">CHEFCHAOUEN</option>
																															<option value="CHICHAOUA">CHICHAOUA</option>
																															<option value="AÏT BAHA">AÏT BAHA</option>
																															<option value="CHTOUKA">CHTOUKA</option>
																															<option value="DRIOUCH">DRIOUCH</option>
																															<option value="EL HAJEB">EL HAJEB</option>
																															<option value="EL JADIDA">EL JADIDA</option>
																															<option value="EL KELAA DES SRAGHNA">EL KELAA DES SRAGHNA</option>
																															<option value="ERRACHIDIA">ERRACHIDIA</option>
																															<option value="1462">ES-SEMARA</option>
																															<option value="1461">ESSAOUIRA</option>
																															<option value="1534">FAHS-ANJRA</option>
																															<option value="FES">FES</option>
																															<option value="1465">FIGUIG</option>
																															<option value="1466">FQUIH BEN SALAH</option>
																															<option value="1467">GUELMIM</option>
																															<option value="1468">GUERCIF</option>
																															<option value="1469">IFRANE</option>
																															<option value="1470">INEZGANE</option>
                                                                                                                            <option value="1470">MELLOUL</option>
																															<option value="1471">JERADA</option>
																															<option value="KENITRA">KENITRA</option>
																															<option value="1473">KHEMISSET</option>
																															<option value="KHENIFRA">KHENIFRA</option>
																															<option value="KHOURIBGA">KHOURIBGA</option>
																															<option value="1476">LAAYOUNE</option>
																															<option value="LARACHE">LARACHE</option>
																															<option value="1520">MARRAKECH</option>
																															<option value="1530">MEDIOUNA</option>
																															<option value="MEKNES">MEKNES</option>
																															<option value="1601">MELILIA</option>
																															<option value="1480">MIDELT</option>
																															<option value="1515">MOHAMMEDIA</option>
																															<option value="1531">MOULAY YACOUB</option>
																															<option value="1482">NADOR</option>
																															<option value="1533">NOUACEUR</option>
																															<option value="1484">OUARZAZATE</option>
																															<option value="1486">OUAZZANE</option>
																															<option value="1485">OUED ED DAHAB</option>
																															<option value="1487">OUJDA-ANGAD</option>
																															<option value="RABAT">RABAT</option>
																															<option value="1489">REHAMNA</option>
																															<option value="1490">SAFI</option>
																															<option value="SALE">SALE</option>
																															<option value="1600">SEBTA</option>
																															<option value="1492">SEFROU</option>
																															<option value="1493">SETTAT</option>
																															<option value="1494">SIDI BENNOUR</option>
																															<option value="1495">SIDI IFNI</option>
																															<option value="SIDI KACEM">SIDI KACEM</option>
																															<option value="1497">SIDI SLIMANE</option>
																															<option value="1498">SKHIRATE-TEMARA</option>
																															<option value="1512">TAN TAN</option>
																															<option value="TANGER">TANGER</option>
                                                                                                                            <option value="ASSILAH">ASSILAH</option>
																															<option value="TAOUNATE">TAOUNATE</option>
																															<option value="TAOURIRT">TAOURIRT</option>
																															<option value="TARFAYA">TARFAYA</option>
																															<option value="TAROUDANT">TAROUDANT</option>
																															<option value="TATA">TATA</option>
																															<option value="TAZA">TAZA</option>
																															<option value="TETOUAN">TETOUAN</option>
																															<option value="TINGHIR">TINGHIR</option>
																															<option value="TIZNIT">TIZNIT</option>
																															<option value="YOUSSOUFIA">YOUSSOUFIA</option>
																															<option value="ZAGORA">ZAGORA</option>
																											</select>                            



                    </div>


												
																													



                </div>
                <input type="submit" name="inscription" value="s'inscrire" class="mx-auto d-block mt-5" required>
                <a href="cabinetLogin.php" class="text-decoration-none d-block ">déjà avoir un compte?</a>
            </form>
	      </body>
      
      



</html>