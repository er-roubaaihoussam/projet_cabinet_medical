 <?php
    session_start();
    if (isset($_POST['submit_form'])){
      $_SESSION["date"] = $_POST['date'];
      // echo $_SESSION["date"];
      $_SESSION["nom_patient"] = $_POST['nom_patient'];
      $_SESSION["medicament"] =$_POST['survey_options'];
    //   foreach ($_POST['survey_options'] as $key => $val) {
    //     echo $val;
    // }
      header("Location: ordonnance_modification.php");
        
        
        $conn->close();
    }



?> 

