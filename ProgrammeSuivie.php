<?php
    require "utils.php";
    ouvreSession();
    
    $id=$_SESSION['idcompte'];

    $annee=intval($_GET['annee']);
    $mois=intval($_GET['mois']);
    $jour=intval($_GET['jour']);
    $date=new DateTime("{$annee}-{$mois}-{$jour}");
    
    $semainAvant=(clone $date)->modify('-1 week');
    $anneeAvant=$semainAvant->format('Y');
    $moisAvant=$semainAvant->format('m');
    $jourAvant=$semainAvant->format('d');

    $semainApres=(clone $date)->modify('+1 week');
    $anneeApres=$semainApres->format('Y');
    $moisApres=$semainApres->format('m');
    $jourApres=$semainApres->format('d');

    $lundi=(clone $date)->modify('last monday');
    $jourLundi=$lundi->format('d');
    $moisLundi=$lundi->format('M');
    $dimanche=(clone $date)->modify('next sunday');
    $jourDimanche=$dimanche->format('d');
    $moisDimanche=$dimanche->format('M');
function dateApresJours($uneDate,$nmbr)
{
    $dateApres=(clone $uneDate)->modify("+{$nmbr} days");
    return $dateApres;
}

    $days=['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi','samedi','dimanche'];
    $horaire=['09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30'];
    $horaireTravail=['lundi09:00','lundi09:30','lundi10:00','lundi10:30','lundi11:00','lundi11:30','lundi12:00','lundi12:30','lundi13:00','lundi13:30','lundi14:00','lundi14:30','lundi15:00','lundi15:30',
    'mardi09:00','mardi09:30','mardi10:00','mardi10:30','mardi11:00','mardi11:30','mardi12:00','mardi12:30','mardi13:00','mardi13:30','mardi14:00','mardi14:30','mardi15:00','mardi15:30',
    'mercredi09:00','mercredi09:30','mercredi10:00','mercredi10:30','mercredi11:00','mercredi11:30','mercredi12:00','mercredi12:30','mercredi13:00','mercredi13:30','mercredi14:00','mercredi14:30','mercredi15:00','mercredi15:30',
    'jeudi09:00','jeudi09:30','jeudi10:00','jeudi10:30','jeudi11:00','jeudi11:30','jeudi12:00','jeudi12:30','jeudi13:00','jeudi13:30','jeudi14:00','jeudi14:30','jeudi15:00','jeudi15:30',
    'vendredi09:00','vendredi09:30','vendredi10:00','vendredi10:30','vendredi11:00','vendredi11:30','vendredi12:00','vendredi12:30','vendredi14:00','vendredi14:30','vendredi15:00','vendredi15:30','vendredi16:00','vendredi16:30'
    ];
    function dateCible($n,$date,$heure)
    {
       $dateCible=(clone $date)->modify("+{$n} days")->format('Y-m-d');  
       return $dateCible." ".$heure.":00";
    }
    function dateCibleD($n,$date,$heure)
    {
       $dateCible=(clone $date)->modify("+{$n} days")->format('Y-m-d');  
       $dateCible= $dateCible." ".$heure.":00";
       return DateTime::createFromFormat('Y-m-d H:i:s',$dateCible);
    }
    $debut=$lundi->format('Y-m-d')." 08:00:00";
    $fin=$dimanche->format('Y-m-d')." 11:30:00";

    $bdd=base_donnees();
    $bd=base_donnees();
    $req=$bdd->prepare('SELECT * FROM rdv WHERE DateRdv BETWEEN :debut AND :fin;');
        
    $req->bindValue('debut',$debut);$req->bindValue('fin',$fin);
            $req->execute();
    $tabRv=$req->fetchALL(PDO::FETCH_ASSOC);
    
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
                            <a class="js-arrow" href="./accueilMedecin.php">
                                <i class="fas fa-desktop"></i>Dashboard</a>
                        </li>
                        
                        <li>
                            
                            <a href="./calendrierMedecin.php?annee=<?=$annee?>&mois=<?=$mois?>&jour=<?=$jour?>">
                                <i class="fas fa-calendar-alt"></i>Calendrier</a>
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
                              <div class="mx-auto mt-3 d-flex justify-content-between fs-3" style="width:500px">
         <a class="text-secondary" href="./ProgrammeSuivie.php?annee=<?=$anneeAvant?>&mois=<?=$moisAvant?>&jour=<?=$jourAvant?>">
           <i class="fas fa-caret-square-left align-self-end" id="avant"></i>
         </a>
         <div>
            <?php echo $jourLundi.$moisLundi."-".$jourDimanche.$moisDimanche;?>
         </div>
         <a class="text-secondary" href="./ProgrammeSuivie.php?annee=<?=$anneeApres?>&mois=<?=$moisApres?>&jour=<?=$jourApres?>">
           <i class="fas fa-caret-square-right align-self-end" id="apres"></i>
         </a>
      </div>
      <table class="monCalendar container mt-3">      
         <thead>       
                <tr>
                  <th> </th>
                  <?php foreach($days as $key=>$jour):?>
                  <th><?=$jour?> <?=dateApresJours($lundi,$key)->format('d')?></th>
                  <?php endforeach;?>
                </tr>
         </thead>
             
                  <?php foreach($horaire as $heure):?>
                    <tr>
                       <th ><?=$heure?></th>
                       <?php foreach($days as $key=>$jour){
                           if(in_array($jour.$heure,$horaireTravail))
                           {
                              $rserve=0;
                              foreach($tabRv as $rdv)
                              {
                                 
                                 if($rdv['DateRdv']==dateApresJours($lundi,$key)->format('Y-m-d')." ".$heure.":00")
                                 {
                                    $rserve=1;

                                        if($rdv['statut']=="terminé")
                                        {
                                            echo'<td ></td>';
                                        }
                                        else
                                        {
                                            if($rdv['rdvConfirme'] == 'false'){
                                            
                                                echo'<td ></td>';

                                                
                                            }
                                            
        
                                            if($rdv['rdvConfirme']=='true'){
                                                echo'<td ></td>';
                                                
                                            }
                                        }
                                        
                      
                                    

                                    
                                 }
                              }
                              if($rserve==0)
                              {
                                if(dateCibleD($key,$lundi,$heure)>new DateTime("now"))
                                {
                                    echo'<td class="bg-success text-center">
                                <a href="calendrierMedecin.php?etat=suivi&annee='.$annee.'&mois='.$mois.'&jour='.$jour.'&dateTime='.dateCible($key,$lundi,$heure).'" class="text-decoration-none text-light">libre</a></td>';
                                }
                                else
                                echo'<td ></td>';
                                      }                             
                             
                                 
                           
                           }
                         else
                           echo'<td ></td>';
                         
                          }?>
                    </tr>
                  <?php endforeach;?>
          </table>
     
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
