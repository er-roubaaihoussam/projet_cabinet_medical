

<?php
    session_start();
    if(!isset($_SESSION['idcompte'])) 
        header('location:cabinetlogin.php');
    
       if($_SESSION['typeCompte'] != "secretaire")
          header('location:cabinetlogin.php');

    require "utils.php";
    $bdd=base_donnees();
    ouvreSession();
    $date=new DateTime("now");
    $jour=$date->format('d');
    $mois=$date->format('m');
    $annee=$date->format('Y');


?>







<?php
  $host = 'localhost';
  $dbname = 'cabinetDB';
  $username = 'root';
  $password = '';
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  // récupérer tous les utilisateurs
  $sql = "SELECT idDepense ,DateDepense, Motif,Montant
   FROM depense
   " ;
  
   
  try{
   $pdo = new PDO($dsn, $username, $password);
   $stmt = $pdo->query($sql);
   if($stmt === false ){
    die("Erreur");
   }
   
  }catch (PDOException $e){
    echo $e->getMessage();
  }

  

  
    if(isset($_POST['ajouter']))
    {
        
        $Motif=$_POST['motif'];
        $Montant=$_POST['montant'];
        

        $insertion=$bdd->prepare('INSERT INTO depense(Motif,Montant)
                 VALUES(:Motif,:Montant)');
   
    $insertion->bindValue('Motif',$Motif);
    $insertion->bindValue('Montant',$Montant);
    $insertion->execute();
    header('Location: ./depenses.php');
    
    }
?>




<?php

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
    <title>Dashboard</title>

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

    <!-- Main CSS-->
    <link href="./assetsDashboard/css/theme.css" rel="stylesheet" media="all">

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
                                <i class="fas ffa-tachometer-alt"></i>Comptabilté</a>
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
                        
                             <div class="col-lg-12">
                                
                             <h2 class="title-1 m-b-25">saisir des dépenses</h2>

                            <div class="card">
                                    
                            
                                <div class="card-body card-block">
                                <form  method="post" class="form-horizontal">
                                        
                                    <div class="row form-group ">
                                        <div class="col col-md-12">
                                            <select placeholder="Motif de dépense" class=" form-control" name="motif" id="motif" required>
                                                    <option value="PAS PRECIS" selected >Motif de dépense</option>
                                                    <option value="MEDICAMENT">l'achat des médicaments (comprimes, piqûres....)</option>
                                                    <option value="LOYER">le loyer du cabinet</option>
                                                    <option value="FACTURE">les factures(electricite , eau , wifi)</option>
                                                    <option value="NETTOYAGE">achat de fournitures de nettoyages (javel, air fraiche...)</option>
                                                    <option value="NETTOYAGE">achat de matérielles médicales</option>
                                                    <option value="AUTRE"> Autres</option>
                                                    				
								            </select>                            
                                         </div>
                                    </div>
            
                                    <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" id="montant" name="montant" placeholder="Montant" class="form-control">
                                                        <div class="input-group-addon">
                                                            <i class="">DH</i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" id="ajouter" name="ajouter" class="btn btn-success btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Ajouter
                                        </button>
                                        
                                    </div>

                                    </form>
                                </div>

                                
                              
              
             

                            </div>   
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">table des dépenses</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>l'ID de depense </th>    
                                                <th>la date de dépense </th>
                                                <th>motif de depense </th>
                                                <th class="text-right">montant</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <tr >
                                            
                                            
       <td><?php echo htmlspecialchars($row['idDepense']); ?></td>
       <td><?php echo htmlspecialchars($row['DateDepense']); ?></td>
       <td><?php echo htmlspecialchars($row['Motif']); ?></td>
       <td><?php echo htmlspecialchars($row['Montant']); ?> DH</td>
       
       

      
     </tr>
     
     <?php endwhile; ?>
   </tbody>
 
                                    </table>
                                </div>
                            </div>
                            
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
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
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
    <script src="./assetsDashboard/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="./assetsDashboard/js/main.js"></script>

</body>

</html>
<!-- end document-->

