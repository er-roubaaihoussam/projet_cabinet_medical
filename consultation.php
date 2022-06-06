<?php
    require "utils.php";
    ouvreSession();
    $date=new DateTime("now");
    $jour=$date->format('d');
    $mois=$date->format('m');
    $annee=$date->format('Y');

    $listDiagnostics=$_SESSION["listDiagnostics"];
    $resultats=$_SESSION["resultats"];
    $date=$_SESSION["date"];
    $idConsultation=$_SESSION["idConsultation"];
    if(isset($_POST["terminer"]))
    {
        $bdd=base_donnees();
        for($i=0;$i<count($listDiagnostics);$i++)
        {
            $diagnosticEx=explode(" ",$listDiagnostics[$i])[0];
            $diagnostic=$listDiagnostics[$i];
            $observation=$_POST[$diagnosticEx];
    $modificationDiag=$bdd->prepare('UPDATE diagnostic SET observation=:observation
    WHERE typeDiagnostic=:diagnostic AND IdConsultation=:idCons');
    $modificationDiag->bindValue('observation',$observation);$modificationDiag->bindValue('diagnostic',$diagnostic);
    $modificationDiag->bindValue('idCons',$idConsultation);
    $modificationDiag->execute();
        }
        
        $conclusion=$_POST["mesures"];
        $modificationCons=$bdd->prepare('UPDATE consultation SET conclusion=:conclusion
    WHERE IdConsultation=:idCons');
    $modificationCons->bindValue('conclusion',$conclusion);
    $modificationCons->bindValue('idCons',$idConsultation);

    $modificationCons->execute();

    $modificationStatut=$bdd->prepare('UPDATE rdv SET statut="terminé"
    WHERE DateRdv=:dateRdv');
    $modificationStatut->bindValue('dateRdv',$date);
    $modificationStatut->execute();
    header('Location: calendrierMedecin.php?annee='.$annee.'&mois='.$mois.'&jour='.$jour);
    

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
        background: #bdc3c7;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top, #2c3e50, #bdc3c7);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top, #2c3e50, #bdc3c7); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


    }
    .titre
    {
        background: #1f4037;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top, #99f2c8, #1f4037);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top, #99f2c8, #1f4037); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

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
                              <div class="titre pt-3 border border-4 border-secondary text-center rounded-pill mx-auto" style="width: 275px;">
                              Récapitulatif et Consultation médicales à la demande et suivi
       </div>
       <form method="post" class="pt-4">
         <div class="container w-75 mx-auto" >
            <table class="table table-dark table-striped table-bordered border-light">
              <thead class="table-light">
                <tr>
                  <th class="text-center" style="width: 10px;">Date</th>
                  <th class="text-center" style="width: 50px;">Diagnostic</th>
                  <th class="text-center" style="width: 20px;">Résultat</th>
                  <th class="text-center" style="width: 50px;">Observation</th>
                </tr>
              </thead>
              <tbody>
                  <?php for($i=0;$i<count($listDiagnostics);$i++):?>
                <tr>
                  <th ><?=$date?></th>
                  <td ><?=$listDiagnostics[$i]?></td>
                  <td ><?=$resultats[$i]?></td>
                  <td ><input type="text" class="form-control" name=<?=$listDiagnostics[$i]?> placeholder="Votre observation"></td>
                </tr>
                <?php endfor;?>
              </tbody>
            </table>
          </div>
            <div class="mb-3 mx-auto w-75" style="padding-right: 30px;">
              <label for="mesures" class="form-label fs-2">Conclusion générale de l'examen et mesures prises</label>
              <textarea class="form-control" id="mesures" name="mesures" rows="7"></textarea>
            </div>
            <button class="btn btn-secondary" style="width: 100px;margin-left: 630px;margin-top: 15px;" type="submit" name="terminer">terminer</button>
       </form method="post">
  
     
                              </div>
                              </div>
                            </gg><!-- .col -->
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
