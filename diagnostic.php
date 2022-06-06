<?php
   require "utils.php";
   ouvreSession();
   if(isset($_POST["confirmer"]))
   {
    $bdd=base_donnees();

    $id=$_SESSION["id"];$date=$_SESSION["date"];

    $insertionCons=$bdd->prepare('INSERT INTO consultation(dateConsultation,IdCompte)
    VALUES(:date,:id)');
    $insertionCons->bindValue('date',$date);$insertionCons->bindValue('id',$id);
    $insertionCons->execute();

    $diagnostics=$_SESSION["diagnostics"];

       $i=0;
       $resultats=[];
       $listDiagnostics=[];
       foreach($_POST as $resultat)
       {
            $resultats[$i]=$resultat;
            ++$i;
       }
       $i=0;
       foreach($diagnostics as $diagnostic=>$val)
       {
            $listDiagnostics[$i]=$diagnostic;
            ++$i;
       }
       $reqId=$bdd->query('SELECT MAX(IdConsultation) FROM consultation');
    $idCons=$reqId->fetchALL(PDO::FETCH_ASSOC)[0]['MAX(IdConsultation)'];
    $i=0;
    for($in=0;$in<count($listDiagnostics);++$in)
    {
        $diagnostic=$listDiagnostics[$in];$resultat=$resultats[$in];
        $insertion=$bdd->prepare('INSERT INTO diagnostic(typeDiagnostic,resultat,IdConsultation)
        VALUES(:dignostic,:resultat,:idCons)');
        $insertion->bindValue('dignostic',$diagnostic);$insertion->bindValue('resultat',$resultat);
        $insertion->bindValue('idCons',$idCons);
        $insertion->execute();
        
    }
       
    $_SESSION["listDiagnostics"]=$listDiagnostics;
        $_SESSION["resultats"]=$resultats;
        $_SESSION["idConsultation"]=$idCons;
        header('Location: consultation.php');
    
    

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
    .contenu {
        background: #73C8A9;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top, #373B44, #73C8A9);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top, #373B44, #73C8A9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

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
                            <a class="js-arrow" href="./accueilMedecin.php">
                                <i class="fas fa-desktop"></i>Dashboard</a>
                        </li>
                        
                        <li>
                            
                            <a href="./calendrierMedecin.php?annee=<?=$annee?>&mois=<?=$mois?>&jour=<?=$jour?>">
                                <i class="fas fa-calendar-alt"></i>Calendrier</a>
                        </li>
                        <li>
                            <a href ="./dossiersPatient.php"><i class="fas fa-table"></i>DossiersPatients</a>
                        </li>
                        <li>
                            <a href ="./lettre_confrere.php">Lettre à un confrère</a>
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
                            <a class="js-arrow" href="./accueilMedecin.php">
                                <i class="fas fa-desktop"></i>Dashboard</a>
                        </li>
                        
                        
                        
                        <li>
                            <a href="./calendrierMedecin.php?annee=<?=$annee?>&mois=<?=$mois?>&jour=<?=$jour?>">

                                <i class="fas fa-calendar-alt"></i>Calendrier</a>
                        </li>
                        <li>
                            <a href ="./dossiersPatient.php"><i class="fas fa-table"></i>DossiersPatients</a>
                        </li>
                        <li>
                            <a href ="./lettre_confrere.php">Lettre à un confrère</a>
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
                                            <img src="./assetsDashboard/images/icon/Medecin.jpg" alt="" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['nom']; ?> <?php echo $_SESSION['prenom']; ?> </a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="./assetsDashboard/images/icon/Medecin.jpg" alt="" />
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
                                  <div class="contenu">
                              <h3 class="mx-auto w-25">Diagnostic</h3>
    <form method="post" class="mx-auto w-75">
        <div class="container pt-5">
            <div>
                <?php $_SESSION["diagnostics"]=[]; ?>
               <h5>1)Examen dermatologique</h5>
               <div>Examen de la peau:</div>
               <div class="row px-4">
                   <div class="col-3">-Paleur palmaire:</div>
                   <?php $_SESSION["diagnostics"]["Paleur palmaire"]="";?>
                   <div class="col-9">
                    <div class="form-check d-inline-block">
                     <input class="form-check-input" type="radio" value="oui" name="Paleur" id="Paleur1">
                     <label class="form-check-label" for="Paleur1">oui</label>
                 </div>
                    <div class="form-check d-inline-block px-5">
                     <input class="form-check-input" type="radio" value="non" name="Paleur" id="Paleur2" checked>
                     <label class="form-check-label" for="Paleur2">non</label>
                 </div>
                </div>
               </div>
        
               <div class="row px-4">
                <div class="col-3">-Ictère:</div>
                <?php $_SESSION["diagnostics"]["Ictère"]="";?>

                <div class="col-9">
                    <div class="form-check d-inline-block">
                     <input class="form-check-input" type="radio" value="oui" name="Ictere" id="ictere1">
                     <label class="form-check-label" for="ictere1">oui</label>
                 </div>
                    <div class="form-check d-inline-block px-5">
                     <input class="form-check-input" type="radio" value="non" name="Ictere" id="ictere2" checked>
                     <label class="form-check-label" for="ictere2">non</label>
                 </div>
                </div>
            </div>
        
            <div class="row px-4">
                <div class="col-3">-Dermatose:</div>
                <?php $_SESSION["diagnostics"]["Dermatose"]="";?>

                <div class="col-9">
                    <div class="form-check d-inline-block">
                     <input class="form-check-input" type="radio" value="oui" name="Dermatose" id="Dermatose1">
                     <label class="form-check-label" for="Dermatose1">oui</label>
                 </div>
                    <div class="form-check d-inline-block px-5">
                     <input class="form-check-input" type="radio" value="non" name="Dermatose" id="Dermatose2" checked>
                     <label class="form-check-label" for="Dermatose2">non</label>
                 </div>
                </div>
            </div>
        
            
            </div>
            <div>
                <h5 class="pt-5">2)Examen cardio-vasculaire</h5>
                <div class="row px-4">
                    <div class="col-6">-Pouls fémoraux présents:</div>
                    <?php $_SESSION["diagnostics"]["Pouls fémoraux présents"]="";?>

                    <div class="col-6">
                        <div class="form-check d-inline-block">
                         <input class="form-check-input" type="radio" value="oui" name="Pouls" id="Pouls1">
                         <label class="form-check-label" for="Pouls1">oui</label>
                     </div>
                        <div class="form-check d-inline-block px-5">
                         <input class="form-check-input" type="radio" value="non" name="Pouls" id="Pouls2" checked>
                         <label class="form-check-label" for="Pouls2">non</label>
                     </div>
                    </div>
                </div>
        
                <div class="row px-4">
                    <div class="col-6">-Auscultaion cardiaque normale:</div>
                    <?php $_SESSION["diagnostics"]["Auscultaion cardiaque normale"]="";?>

                    <div class="col-6">
                        <div class="form-check d-inline-block">
                         <input class="form-check-input" type="radio" value="oui" name="Auscultaion" id="Auscultaion1">
                         <label class="form-check-label" for="Auscultaion1">oui</label>
                     </div>
                        <div class="form-check d-inline-block px-5">
                         <input class="form-check-input" type="radio" value="non" name="Auscultaion" id="Auscultaion2" checked>
                         <label class="form-check-label" for="Auscultaion2">non</label>
                     </div>
                    </div>
                </div>
        
            </div>
        
            <div>
                <h5 class="pt-5">3)Examen de l'appareil respiratoire</h5>
                <div>Anamnèse :</div>
                <div class="row px-4 px-3">
                    <div class="col-6">-Contage tuberculeux</div>
                    <?php $_SESSION["diagnostics"]["Contage tuberculeux"]="";?>

                    <div class="col-6">
                        <div class="form-check d-inline-block">
                         <input class="form-check-input" type="radio" value="non" name="Contage" id="Contage1">
                         <label class="form-check-label" for="Contage1">oui</label>
                     </div>
                        <div class="form-check d-inline-block px-5">
                         <input class="form-check-input" type="radio" value="non" name="Contage" id="Contage2" checked>
                         <label class="form-check-label" for="Contage2">non</label>
                     </div>
                    </div>
                </div>
        
                <div class="row px-4 px-3">
                    <div class="col-6">-Notion d'asthme:</div>
                    <?php $_SESSION["diagnostics"]["Notion d'asthme"]="";?>

                    <div class="col-6">
                        <div class="form-check d-inline-block">
                         <input class="form-check-input" type="radio" value="oui" name="Notion" id="Notion1">
                         <label class="form-check-label" for="Notion1">oui</label>
                     </div>
                        <div class="form-check d-inline-block px-5">
                         <input class="form-check-input" type="radio" value="non" name="Notion" id="Notion2" checked>
                         <label class="form-check-label" for="Notion2">non</label>
                     </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-6">Examen pleuro-pulmonaire normal:</div>
                    <?php $_SESSION["diagnostics"]["Examen pleuro-pulmonaire normal"]="";?>

                    <div class="col-6">
                        <div class="form-check d-inline-block">
                         <input class="form-check-input" type="radio" value="oui" name="pleuro" id="pleuro1">
                         <label class="form-check-label" for="pleuro1">oui</label>
                     </div>
                        <div class="form-check d-inline-block px-5">
                         <input class="form-check-input" type="radio" value="non" name="pleuro" id="pleuro2" checked>
                         <label class="form-check-label" for="pleuro2">non</label>
                     </div>
                    </div>
                </div>
            </div>
        
            <div>
                <h5 class="pt-5">4)Examen neuro-psychiatrique</h5>
        
                <div>Examen neurologique:</div>
               <div class="row px-4">
                   <div class="col-5">-Motricité normale:</div>
                   <?php $_SESSION["diagnostics"]["Motricité normale"]="";?>

                   <div class="col-7">
                       <div class="form-check d-inline-block">
                        <input class="form-check-input" type="radio" value="oui" name="Motricite" id="Motricite1">
                        <label class="form-check-label" for="Motricite1">oui</label>
                    </div>
                       <div class="form-check d-inline-block px-5">
                        <input class="form-check-input" type="radio" value="non" name="Motricite" id="Motricite2" checked>
                        <label class="form-check-label" for="Motricite2">non</label>
                    </div>
                   </div>
               </div>
        
               <div class="row px-4">
                <div class="col-5">-Sensibilité normale:</div>
                <?php $_SESSION["diagnostics"]["Sensibilité normale"]="";?>

                <div class="col-7">
                    <div class="form-check d-inline-block">
                     <input class="form-check-input" type="radio" value="oui" name="Sensibilite" id="Sensibilite1">
                     <label class="form-check-label" for="Sensibilite1">oui</label>
                 </div>
                    <div class="form-check d-inline-block px-5">
                     <input class="form-check-input" type="radio" value="non" name="Sensibilite" id="Sensibilite2" checked>
                     <label class="form-check-label" for="Sensibilite2">non</label>
                 </div>
                </div>
            </div>
        
            <div class="row px-4">
                <div class="col-5">-Réflexes normaux:</div>
                <?php $_SESSION["diagnostics"]["Réflexes normaux"]="";?>

                <div class="col-7">
                    <div class="form-check d-inline-block">
                     <input class="form-check-input" type="radio" value="oui" name="Reflexes" id="Reflexes1">
                     <label class="form-check-label" for="Reflexes1">oui</label>
                 </div>
                    <div class="form-check d-inline-block px-5">
                     <input class="form-check-input" type="radio" value="non" name="Reflexes" id="Reflexes2" checked>
                     <label class="form-check-label" for="Reflexes2">non</label>
                 </div>
                </div>
            </div>
        
            <div>Examen psychiatrique:</div>
            <div class="row px-4">
                <div class="col-5">-Enurésie:</div>
                <?php $_SESSION["diagnostics"]["Enurésie"]="";?>

                <div class="col-7">
                    <div class="form-check d-inline-block">
                     <input class="form-check-input" type="radio" value="oui" name="Enuresie" id="Enuresie1">
                     <label class="form-check-label" for="Enuresie1">oui</label>
                 </div>
                    <div class="form-check d-inline-block px-5">
                     <input class="form-check-input" type="radio" value="non" name="Enuresie" id="Enuresie2" checked>
                     <label class="form-check-label" for="Enuresie2">non</label>
                 </div>
                </div>
            </div>
        
            <div class="row px-4">
                <div class="col-5">-Difficultés de langue:</div>
                <?php $_SESSION["diagnostics"]["Difficultés de langue"]="";?>

                <div class="col-7">
                    <div class="form-check d-inline-block">
                     <input class="form-check-input" type="radio" value="oui" name="Difficultes" id="Difficultes1">
                     <label class="form-check-label" for="Difficultes1">oui</label>
                 </div>
                    <div class="form-check d-inline-block px-5">
                     <input class="form-check-input" type="radio" value="non" name="Difficultes" id="Difficultes2" checked>
                     <label class="form-check-label" for="Difficultes2">non</label>
                 </div>
                </div>
            </div>
            </div>
        </div>
        <button class="btn btn-primary" style="width: 100px;margin-left: 550px;margin-top: 15px;" type="submit" name="confirmer">confirmer</button>
    </form>
                              </div></div>
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
