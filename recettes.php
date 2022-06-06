

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
  $sql = "SELECT rdv.idRdv , rdv.DateRdv , rdv.prix , rdv.idCompte ,
  compte.PrenomUser , compte.NomUser , compte.TelephoneUser , compte.Email , 
  recette.idRecette ,recette.DateRecette, recette.Montant , recette.Mode
   FROM `rdv` join compte join recette
   WHERE compte.IdCompte = rdv.idCompte AND rdv.idRdv = recette.idRdv  ;"
    ;
  
    $sql2 = "SELECT  recette.idRecette ,recette.DateRecette, 
    recette.Montant , recette.Mode
   FROM  recette
   WHERE  recette.idRdv = '0'  ;"
    ;
   
  try{
   $pdo = new PDO($dsn, $username, $password);
   $stmt = $pdo->query($sql);
   if($stmt === false ){
    die("Erreur");
   }
   
  }catch (PDOException $e){
    echo $e->getMessage();
  }

  try{
    $pdo2 = new PDO($dsn, $username, $password);
    $stmt2 = $pdo2->query($sql2);
    if($stmt2 === false ){
     die("Erreur");
    }
    
   }catch (PDOException $e2){
     echo $e2->getMessage();
   }

  if(isset($_POST['ajouter']))
    {
        
        $Mode=$_POST['mode'];
        $Montant=$_POST['montant'];
        

        $insertion=$bdd->prepare('INSERT INTO recette(Mode,Montant , idRdv)
                 VALUES(:Mode,:Montant , 0)');
   
    $insertion->bindValue('Mode',$Mode);
    $insertion->bindValue('Montant',$Montant);
    $insertion->execute();
    header('Location: ./recettes.php');
    
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
                                
                                <h2 class="title-1 m-b-25">saisir des recettes</h2>
   
                               <div class="card">
                                       
                               
                                   <div class="card-body card-block">
                                   <form  method="post" class="form-horizontal">
                                           
                                       <div class="row form-group ">
                                           <div class="col col-md-12">
                                               <select placeholder="Mode de paiment" class=" form-control" name="mode" id="mode" required>
                                                       <option value="Espéce" selected >mode de paiment</option>
                                                       <option value="Espèce">Espèce</option>
                                                       <option value="Chàque">Chèque</option>
                                                       
                                                                       
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
                               <h2 class="title-1 m-b-25">table des recettes  </h2>

                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>l'ID <br>de recette </th>
                                                <th>la date <br>de recette </th>
                                                <th >tarif</th>

                                                
                                                <th>mode de paiment</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <tr >
                                            
                                            <td>

           
<div class="table-data-feature">
    
    <button class="item" data-toggle="tooltip" data-placement="top" title="Modifier">
        <i class="zmdi zmdi-edit"></i>
    </button>
    <button class="item" data-toggle="tooltip" data-placement="top" title="Supprimer">
        <i class="zmdi zmdi-delete"></i>
    </button>
    
</div>
</td>

       <td><?php echo htmlspecialchars($row2['idRecette']); ?></td>                                   
       <td><?php echo htmlspecialchars($row2['DateRecette']); ?></td>                                   
       <td><?php echo htmlspecialchars($row2['Montant']); ?> DH</td>
       <td><?php echo htmlspecialchars($row2['Mode']); ?></td>
       

      
     </tr>
     
     <?php endwhile; ?>
   </tbody>
 
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>l'ID <br>de recette </th>
                                                <th>la date <br>de recette </th>
                                                <th >tarif</th>

                                                <th>la date <br>de rendez-vous </th>
                                                <th>prenom</th>
                                                <th>nom</th>
                                                <th class="text-right">telephone </th>
                                                <th class="text-right">email</th>
                                                <th>mode de paiment</th>
                                                <th>l'ID <br>de patient </th>
                                                <th>l'ID <br>de rendez-vous </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <tr >
                                            <td>

           
<div class="table-data-feature">
    
    <button class="item" data-toggle="tooltip" data-placement="top" title="Modifier">
        <i class="zmdi zmdi-edit"></i>
    </button>
    <button class="item" data-toggle="tooltip" data-placement="top" title="Supprimer">
        <i class="zmdi zmdi-delete"></i>
    </button>
    
</div>
</td>

       <td><?php echo htmlspecialchars($row['idRecette']); ?></td>                                   
       <td><?php echo htmlspecialchars($row['DateRecette']); ?></td>                                   
       <td><?php echo htmlspecialchars($row['Montant']); ?> DH</td>
       <td><?php echo htmlspecialchars($row['DateRdv']); ?></td>
       <td><?php echo htmlspecialchars($row['PrenomUser']); ?></td>
       <td><?php echo htmlspecialchars($row['NomUser']); ?></td>       
       <td><?php echo htmlspecialchars($row['TelephoneUser']); ?></td>
       <td><?php echo htmlspecialchars($row['Email']); ?></td>
       <td><?php echo htmlspecialchars($row['Mode']); ?></td>
       <td><?php echo htmlspecialchars($row['idCompte']); ?></td>
       <td><?php echo htmlspecialchars($row['idRdv']); ?></td>
       
       
      
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

