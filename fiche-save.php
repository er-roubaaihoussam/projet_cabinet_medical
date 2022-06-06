 <?php
    session_start();
    $conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
    $sexe = $_SESSION["sexe"] ;
    if (isset($_POST['submit_form'])){
        $lastname = $_POST['f_lastname'];
        echo 1;
        $firstname = $_POST['f_firstname'];
        $cin = $_POST['f_cin'];
        $birthday = $_POST['f_birthday'];
        $address = $_POST['f_address'];
        $email = $_POST['f_email'];
        $telephone = $_POST['f_telephone_portable'];
        $id = $_POST['id'];
        if(isset($_POST['f_gender_homme']) ){
          $sexe="Homme";
        }elseif(isset($_POST['f_gender_femme']) ){
          $sexe="Femme";
        }

        $sql = "UPDATE compte SET Email='$email', PrenomUser='$firstname', NomUser='$lastname', TelephoneUser='$telephone', NaissanceUser='$birthday', addressUser='$address', cinUser='$cin', SexeUser='$sexe'
        WHERE idCompte=$id";
        
        if (mysqli_query($conn, $sql)) {
        echo "Modification bien enregistrée";
        header("Location: fiche-modification.php");
        } else {
          alert( "Error: " . $sql . "<br>" . mysqli_error($conn));
        }
        $conn->close();
    }



?> 

