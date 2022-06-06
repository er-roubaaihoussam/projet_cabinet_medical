<?php
   require "utils.php";
  ouvreSession();
  $bdd=base_donnees();
    $flag=0;
   if(isset($_GET['id'])){
       $id=$_GET['id'];
       $req=$bdd->prepare('SELECT NomUser,PrenomUser,TelephoneUser,Email FROM compte WHERE IdCompte=:id');
        $req->bindValue('id',$id);
        $req->execute();
        $infos=$req->fetchALL(PDO::FETCH_ASSOC);
        $nom=$infos[0]['NomUser'];$prenom=$infos[0]['PrenomUser'];
        $email=$infos[0]['Email'];$telephone=$infos[0]['TelephoneUser'];
    }  
   $date=$_GET['dateTime'];
   $type=$_GET['type'];
    
   $dateAujourdhui=new DateTime("now");
    $jour=$dateAujourdhui->format('d');
    $mois=$dateAujourdhui->format('m');
    $annee=$dateAujourdhui->format('Y');
    
    if(isset($_POST['annulerconfirmation']))
    {
    
    $idRDV=$_GET['idRDV'];
    $idrdv = $idRDV;
    $supression=$bdd->prepare('DELETE FROM recette WHERE idRdv=:idRdv');
    $supression->bindValue('idRdv',$idrdv);
    $supression->execute();
        
    $conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
    $sql = "UPDATE rdv SET rdvConfirme='false' WHERE idRdv=$idrdv";
        
        if (mysqli_query($conn, $sql)) {
        echo "Modification bien enregistrée";
        header('Location: ./calendrierSecretaire.php?annee='.$annee.'&mois='.$mois.'&jour='.$jour);
        } else {
          alert( "Error: " . $sql . "<br>" . mysqli_error($conn));
        }
        $conn->close();


}
    if(isset($_POST['confirmer']))
    {
        $idrdv=$idRDV;
        

        $insertion=$bdd->prepare('INSERT INTO recette(Montant, Mode,idRdv)
                 VALUES(200.0,"Espèce",:idRdv)');
    $insertion->bindValue('idRdv',$idrdv);
    
    $insertion->execute();
  
    
    header('Location: ./calendrierSecretaire.php?annee='.$annee.'&mois='.$mois.'&jour='.$jour);
    }
    if(isset($_POST['annuler']))
    {
    $supression=$bdd->prepare('DELETE FROM rdv WHERE DateRdv=:dateRdv');
    $supression->bindValue('dateRdv',$date);
    $supression->execute();
    $confirme=0;
    header('Location: ./calendrierSecretaire.php?annee='.$annee.'&mois='.$mois.'&jour='.$jour);
    }
    if(isset($_POST['ajouter']))
    {
        $nom=$_POST['nom'];$prenom=$_POST['prenom'];$cin=$_POST['cin'];
        $email=$_POST['email'];$password=$_POST['cin'];$adresse=$_POST['adresse'];
        $telephone=$_POST['telephone'];$sexe=$_POST['sexe'];
        $naissance=$_POST['naissance'];$ville=$_POST['ville'];

        $insertion=$bdd->prepare('INSERT INTO compte(Email,Password,TypeCompte,PrenomUser,
                        NomUser,TelephoneUser,NaissanceUser,addressUser,CinUser,SexeUser,Ville)
                 VALUES(:email,:password,"patient",:prenom,:nom,:telephone,:naissance,:adresse,
                 :cin,:sexe,:ville)');
    $insertion->bindValue('email',$email);$insertion->bindValue('password',$password);
    $insertion->bindValue('cin',$cin);$insertion->bindValue('adresse',$adresse);
    $insertion->bindValue('prenom',$prenom);$insertion->bindValue('nom',$nom);
    $insertion->bindValue('telephone',$telephone);$insertion->bindValue('naissance',$naissance);
    $insertion->bindValue('sexe',$sexe);
    $insertion->bindValue('ville',$ville);
    $insertion->execute();
    
    $reqId=$bdd->query('SELECT MAX(IdCompte) FROM compte');
    $id=$reqId->fetchALL(PDO::FETCH_ASSOC)[0]['MAX(IdCompte)'];

    $insertionRdv=$bdd->prepare('INSERT INTO rdv(DateRdv,IdCompte)
    VALUES(:dateRdv,:id)');
    $insertionRdv->bindValue('dateRdv',$date);$insertionRdv->bindValue('id',$id);
    $insertionRdv->execute();
    $confirme=0;
    header('Location: ./calendrierSecretaire.php?annee='.$annee.'&mois='.$mois.'&jour='.$jour);
    }
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Calendrier</title>

    <!-- Fontfaces CSS-->
    <link href="./assetsDashboard/css/font-face.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="./assetsDashboard/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="./assetsDashboard/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="./assetsDashboard/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- FullCalendar -->
    <link href='./assetsDashboard/vendor/fullcalendar-3.10.0/fullcalendar.css' rel='stylesheet' media="all" />

    <!-- Main CSS-->
    <link href="./assetsDashboard/css/theme.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="./css/bootstrap.min.css">
       <script src="https://kit.fontawesome.com/3f8b3dee73.js" crossorigin="anonymous"></script>

    <style type="text/css">
    /* force class color to override the bootstrap base rule
       NOTE: adding 'url: #' to calendar makes this unneeded
     */
    .fc-event, .fc-event:hover {
          color: #fff !important;
          text-decoration: none;
    }
    .monCalendar th, .monCalendar td {
 border:1px solid black;
 width:10%;
 max-width: 500px;
 text-align:center;
 background-color: rgb(255, 255, 255);
 }
 .monCalendar thead th{background-color: rgb(247, 240, 234);}
 .monCalendar tr{
    height: 10px;
 }
    </style>

</head>


<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="./assetsDashboard/images/icon/logo2.png" alt="" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="active has-sub">
                            <a class="js-arrow" href="./accueilSecretaire.php">
                                <i class="fas fa-desktop"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="./tablesSecretaire.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            
                            <a href="./calendrierSecretaire.php?annee=<?=$annee?>&mois=<?=$mois?>&jour=<?=$jour?>">
                                <i class="fas fa-calendar-alt"></i>Calendrier</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Comptabilté</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="recettes.php">Recettes</a>
                                </li>
                                <li>
                                    <a href="depenses.php">Dépenses</a>
                                </li>
                            </ul>
                        </li>
                        
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="./assetsDashboard/images/icon/logo2.png" alt="" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="./accueilSecretaire.php">
                                <i class="fas fa-desktop"></i>Dashboard</a>
                        </li>
                        
                        <li class="">
                            <a href="./tablesSecretaire.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        
                        <li>
                            <a href="./calendrierSecretaire.php?annee=<?=$annee?>&mois=<?=$mois?>&jour=<?=$jour?>">

                                <i class="fas fa-calendar-alt"></i>Calendrier</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Comptabilté</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="recettes.php">Recettes</a>
                                </li>
                                <li>
                                    <a href="depenses.php">Dépenses</a>
                                </li>
                            </ul>
                        </li>
                        
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Chercher .. " />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="./assetsDashboard/images/icon/secretaire.jpg" alt="" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['nom']; ?> <?php echo $_SESSION['prenom']; ?> </a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="./assetsDashboard/images/icon/secretaire.jpg" alt="" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION['nom']; ?> <?php echo $_SESSION['prenom']; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION['email']; ?> </span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                <a href="./profile.php">
                                                        <i class="zmdi zmdi-account"></i>Profile</a>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="./accueil.php">
                                                    <i class="zmdi zmdi-power"></i>Déconnexion</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->


            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                              <div class="au-card">
                              <form method="post" class="container corps mt-3 mx-auto position-relative">
              <div class="text-success">
                informations du patient:
              </div>
              <?php if($type=='libre'):?>
              <div class="formul" style="margin-left: 150px;width:400px">
                <div class="row">
                  <label for="nom" class="pt-3 form-label col-3">Nom</label>
                  <input  type="text" name="nom" class="form-control-sm col-8 mt-auto bg-warning" id="nom" style="height: 15px;" required>
                </div>
                
                <div class="row">
                  <label for="prenom" class="pt-3 form-label col-3">Prenom</label>
                  <input type="text" name="prenom" class="form-control-sm col-8 mt-auto bg-warning" id="prenom" style="height: 15px;" required>
                </div>
                
                <div class="row">
                  <label for="telephone" class="pt-3 form-label col-3">Telephone</label>
                  <input  type="text" name="telephone" class="form-control-sm col-8 mt-auto bg-warning" id="telephone" style="height: 15px;" required>
                </div>
                
                <div class="row">
                  <label for="email" class="pt-3 form-label col-3">Email</label>
                  <input  type="email" name="email" class="form-control-sm col-8 mt-auto bg-warning" id="email" style="height: 15px;" required>
                </div>
                <div class="row">
                  <label for="cin" class="pt-3 form-label col-3">CIN</label>
                  <input  type="text" name="cin" class="form-control-sm col-8 mt-auto bg-warning" id="cin" style="height: 15px;" required>
                </div>

                <div class="row">
                  <label for="adresse" class="pt-3 form-label col-3">Adresse</label>
                  <input  type="text" name="adresse" class="form-control-sm col-8 mt-auto bg-warning" id="adresse" style="height: 15px;" required>
                </div>

                <div class="row">
                  <label for="ville" class="pt-3 form-label col-3">Ville</label>
                  <select class="col-5 mt-auto" name="ville" id="ville" required>
                            
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

                <div class="row">
                  <label for="sexe" class="pt-3 col-3">Sexe</label>
                  <select class="col-5 mt-auto" name="sexe" id="sexe" required>
                            <option selected value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                  </select>        
                </div>

                <div class="row">
                  <label for="naissance" class="pt-3 form-label col-3">Naissance</label>
                  <input type="date" name="naissance" class="form-control-sm col-8 mt-auto bg-secondary" id="naissance" required>
                </div>
                
                
              </div>
              <?php else:?>
                <div class="formul" style="margin-left: 150px;width:400px">
                <div class="row">
                  <label for="nom" class="pt-3 form-label col-3">Nom</label>
                  <input value=<?=$nom?> type="text" name="nom" class="form-control-sm col-8 mt-auto bg-warning" id="nom" style="height: 15px;" disabled>
                </div>
                
                <div class="row">
                  <label for="prenom" class="pt-3 form-label col-3">Prenom</label>
                  <input value="<?=$prenom?>" type="text" name="prenom" class="form-control-sm col-8 mt-auto bg-warning" id="prenom" style="height: 15px;" disabled>
                </div>
                
                <div class="row">
                  <label for="telephone" class="pt-3 form-label col-3">Telephone</label>
                  <input value=<?=$telephone?> type="text" name="telephone" class="form-control-sm col-8 mt-auto bg-warning" id="telephone" style="height: 15px;" disabled>
                </div>
                
                <div class="row">
                  <label for="email" class="pt-3 form-label col-3">Email</label>
                  <input value=<?=$email?> type="email" name="email" class="form-control-sm col-8 mt-auto bg-warning" id="email" style="height: 15px;" disabled>
                </div>
                
                
              </div>
              <?php endif;?>
              <hr class="mx-auto">
              <pre><div class="text-success">réservation:</div>

consultation avec le Docteur dans le:
<?php
   echo explode(' ',$date)[0].'<br>'.explode(' ',$date)[1];
?>
              </pre>
              <?php if($type=='reserve'):?>
                
                <input type="submit" name="annuler" value="annuler le rendez vous" class="btn btn-danger position-absolute" style="right: 11px;width:210px">
                <i class="far fa-window-close position-absolute" style="right: 12px;top:437px;"></i>
              
                    <input type="submit" name="annulerconfirmation" value="annuler la recette" class="btn btn-success position-absolute" style="left: 11px;width:210px">
                <i class="far fa-window-close position-absolute" style="right: 12px;top:437px;"></i>
                
                
              <?php else:?>
                <input type="submit" name="ajouter" value="ajouter un rendez vous" class="btn btn-success position-absolute" style="right: 1px;width:210px">
                <i class="fas fa-plus-circle position-absolute" style="right: 1px;top:644px;"></i>
              <?php endif;?>
            </form>
     
                              </div>
                            </div><!-- .col -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2022 C4GAMES. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="./assetsDashboard/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="./assetsDashboard/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="./assetsDashboard/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="./assetsDashboard/vendor/slick/slick.min.js">
    </script>
    <script src="./assetsDashboard/vendor/wow/wow.min.js"></script>
    <script src="./assetsDashboard/vendor/animsition/animsition.min.js"></script>
    <script src="./assetsDashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="./assetsDashboard/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="./assetsDashboard/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="./assetsDashboard/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./assetsDashboard/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="./assetsDashboard/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="./assetsDashboard/vendor/select2/select2.min.js"></script>

    <!-- full calendar requires moment along jquery which is included above -->
    <script src="./assetsDashboard/vendor/fullcalendar-3.10.0/lib/moment.min.js"></script>
    <script src="./assetsDashboard/vendor/fullcalendar-3.10.0/fullcalendar.js"></script>

    <!-- Main JS-->
    <script src="./assetsDashboard/js/main.js"></script>

    <script type="text/javascript">
$(function() {
  // for now, there is something adding a click handler to 'a'
  var tues = moment().day(2).hour(19);

  // build trival night events for example data
  var events = [
    {
      title: "Special Conference",
      start: moment().format('YYYY-MM-DD'),
      url: '#'
    },
    {
      title: "Doctor Appt",
      start: moment().hour(9).add(2, 'days').toISOString(),
      url: '#'
    }

  ];

  var trivia_nights = []

  for(var i = 1; i <= 4; i++) {
    var n = tues.clone().add(i, 'weeks');
    console.log("isoString: " + n.toISOString());
    trivia_nights.push({
      title: 'Trival Night @ Pub XYZ',
      start: n.toISOString(),
      allDay: false,
      url: '#'
    });
  }

  // setup a few events
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listWeek'
    },
    events: events.concat(trivia_nights)
  });
});
    </script>


</body>

</html>
<!-- end document-->
