<?php

require_once "./cms/config.php";
require_once "./cms/functions.php";

// inicijalizacija na promenlivi
$full_name=$company_name=$contact_email=$contact_tel=$student_type="";
$full_name_err=$company_name_err=$contact_email_err=$contact_tel_err=$student_type_err="";
$message = '';

if(if_POST()) {

    // $full_name = trim($_POST['full_name']);
    if ( !field_isset_not_empty('full_name', 'POST') ) {
      $full_name_err= "Ве молиме внесете име и презиме.";
      } else if (! validateFullname(trim($_POST['full_name']))) {
                $full_name_err= "Полето може да прими само букви и барем едно празно место";
              } else {
                $full_name = trim($_POST['full_name']);
              }
    
    // $company_name = trim($_POST['company_name']);
    if ( !field_isset_not_empty('company_name', 'POST') ) {
      $company_name_err = "Ве молиме внесете име на компанија";
    } else if (! validateCompanyname(trim($_POST['company_name']))) {
              $company_name_err = "Полето може да прими само букви, - и празно место";
            } else {
              $company_name = trim($_POST['company_name']);
            }
    
    // $contact_email = trim($_POST['contact_email']);
    if ( !field_isset_not_empty('contact_email', 'POST') ) {
      $contact_email_err = "Ве молиме внесете имејл за контакт";
    } else if (! validateEmail(trim($_POST['contact_email']))) {
              $contact_email_err = "Ве молиме внесете валиден имејл";
            } else {
              $contact_email = trim($_POST['contact_email']);
            }

    // $contact_tel = trim($_POST['contact_tel']);
    if ( !field_isset_not_empty('contact_tel', 'POST') ) {
      $contact_tel_err = "Ве молиме внесете телефон за контакт";
    } else if (! validateTel(trim($_POST['contact_tel']))) {
              $contact_tel_err = "Не валиден, пр: +3897YXXXXXX";
            } else {
              $contact_tel = trim($_POST['contact_tel']);
            }
    

    // $student_type = trim($_POST['student_type']);
    if (!field_isset_not_empty('student_type', 'POST')) {
      $student_type_err = "Ве молиме изберете тип на студент";
    } else {
      $student_type = trim($_POST['student_type']);
    }
    // nema potreba od validacija vneseni se vo select

    if ( empty($full_name_err) && empty($company_name_err) && empty($contact_email_err) && empty($contact_tel_err) && empty($student_type_err) ) {

      // Prepare an insert statement
      $sql = "INSERT INTO vraboti (full_name, company_name, contact_email, contact_tel, student_type) VALUES (?, ?, ?, ?, ?)";
      // $sql = "INSERT INTO vraboti (`full_name`, `company_name`, `contact_email`, `contact_tel`, `student_type`)
      //       VALUES ('$full_name', '$company_name', '$contact_email', '$contact_tel', '$student_type')";

      if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $param_full_name, $param_company_name, $param_contact_email, $param_contact_tel, $param_student_type);
        
        // Set parameters
        $param_full_name = $full_name;
        $param_company_name = $company_name;
        $param_contact_email = $contact_email;
        $param_contact_tel = $contact_tel;
        $param_student_type = $student_type;
        
        // Attempt to execute the prepared statemen
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
            // header("location: login.php");
            $message = 'Вашите податоци се успешно внесени. Доколку сте заинтересирани и за студенти од друга академија внесете уште еден запис';
            $message=urlencode($message);
            // htmlspecialchars($_SERVER["PHP_SELF"]);
            // header("Location:welcome.php?message=".$message);
            $url_header = $_SERVER["PHP_SELF"].'?message='.$message;
            
            header("Location:" . htmlspecialchars($url_header));
            // exit();
        } else if (if_POST()) {
            $message = 'Се извиниуваме настана некоја грешка. Obidete se povtorno.';
            $message=urlencode($message);
            $url_header = $_SERVER["PHP_SELF"].'?message='.$message;

            // header("Location:" . htmlspecialchars($url_header));
            // $_POST['message'] = 'Се извиниуваме настана некоја грешка. Obidete se povtorno.';

        }

        // Close statement
        mysqli_stmt_close($stmt);
      }

    // if ($link->query($sql) === TRUE) {
    //     echo "New record created successfully";
    //   } else {
    //     echo "Error: " . $sql . "<br>" . $link->error;
    //   }
      
    //   $link->close();
    // }
    }
  }


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"
  />

  <!-- Custom Fonts needed -->
  <!-- Ubuntu, san-serif-->
  <link 
    href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
    rel="stylesheet"
  />
  <!-- Vira Code, monospace -->
  <link 
    href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />

  <link rel="stylesheet" href="./style.css">

  <title>Вработи стидент од Brainster Labs</title>

</head>

<body>

  <div class="container-fluid bg-custom-color">
    <!-- navbar-home - start -->

    <!-- navbar-home - start -->
    <nav id="navbar-home"
      class="navbar navbar-expand-md navbar-light bg-custom-color font-weight-bold fixed-top shadow-lg">
      <a class="navbar-brand ml-md-5" href="./index.html">
        <div class="d-flex flex-column align-items-center">
          <img src="./img/logo.png" width="35" height="auto" alt="Logo of Brainster" loading="lazy">
          <span class="navbar-txt-logo pt-1">BRAINSTER</span>
        </div>
      </a>
      <button class="navbar-toggler btn-transparent" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent-home" aria-controls="navbarSupportedContent-home" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="fas fa-1_ipol_x fa-bars p-0"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent-home">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item pl-4">
            <a class="nav-link text-md-center" href="https://marketpreneurs.brainster.co/" target="_blank"><i
                class="fas fa-graduation-cap fa-1x px-2 d-none d-md-inline d-xl-none"></i><span
                class="d-md-none d-xl-inline">Академија за</span> маркетинг</a>
          </li>
          <li class="nav-item pl-4">
            <a class="nav-link text-md-center" href="https://codepreneurs.co/" target="_blank"><i
                class="fas fa-graduation-cap fa-1x px-2 d-none d-md-inline d-xl-none"></i><span
                class="d-md-none d-xl-inline">Академија за</span> програмирање</a>
          </li>
          <li class="nav-item pl-4 text-md-center">
            <a class="nav-link" href="https://design.brainster.co/" target="_blank"><i
                class="fas fa-graduation-cap fa-1x px-2 d-none d-md-inline d-xl-none"></i><span
                class="d-md-none d-xl-inline">Академија за</span> дизајн</a>
          </li>
          <li class="nav-item pl-4">
            <a class="btn btn-custom_colors disabled" type="submit" href="./vraboti.php">Вработи наш студент</a>
          </li>

      </div>
    </nav>
    <!-- navbar-home - end -->

    <!-- Body -->

    <!-- Vraboti nash student strana -->
    <div class="row bg-custom-color pt-5 vraboti">
      <div class="container-md">

        <h1 class="text-center p-5 font-weight-bold">Вработи студенти</h1>

        <form class="pt-5 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

          <div class="form-row">

            <div class="col-12 col-md-6 mb-3">
              <label for="fullName" class="font-weight-bold">Име и презиме</label>
              <input
                type="text"
                class="form-control font-italic p-4 
                  <?php if (if_POST()) {echo (! $full_name_err) ? 'is-valid' : 'is-invalid';} ?>"
                id="fullName"
                name="full_name"
                value="<?php 
                        if(if_POST()) {
                          echo trim($_POST['full_name']);
                        } 
                      ?>"
                placeholder="Вашето име и презиме"
              >
              <?php 
                if (if_POST()) {
                  echo (! $full_name_err) ? '<div class="valid-feedback">Благодариме</div>' : '<div class="invalid-feedback">' . $full_name_err . '</div>';
                }
              ?>
            </div>
            
            <div class="col-12 col-md-6 mb-3">
              <label for="companyName" class="font-weight-bold">Име на компанија</label>
              <input 
                type="text" 
                class="form-control font-italic p-4 
                  <?php if (if_POST()) {echo (! $company_name_err) ? 'is-valid' : 'is-invalid';} ?>" 
                id="companyName" 
                name="company_name" 
                value="<?php
                        if(if_POST()) {
                          echo trim($_POST['company_name']);
                          }
                        ?>"
                placeholder="Име на Вашата компанија"
              >
              <?php 
                if (if_POST()) {
                  echo (! $company_name_err) ? '<div class="valid-feedback">Благодариме</div>' : '<div class="invalid-feedback">' . $company_name_err . '</div>';
                }
              ?>
            </div>

          </div>

          <div class="form-row">

            <div class="col-12 col-md-6 mb-3">
              <label for="contactEmail" class="font-weight-bold">Имејл</label>
              <input 
                type="email" 
                class="form-control font-italic p-4 
                  <?php if (if_POST()) {echo (! $contact_email_err) ? 'is-valid' : 'is-invalid';} ?>" 
                id="contactEmail" 
                name="contact_email" 
                value="<?php
                        if(if_POST()) {
                          echo trim($_POST['contact_email']);
                          }
                        ?>"
                placeholder="Контакт имејл на Вашата компанија"
              >
              <?php 
                if (if_POST()) {
                  echo (! $contact_email_err) ? '<div class="valid-feedback">Благодариме</div>' : '<div class="invalid-feedback">' . $contact_email_err . '</div>';
                }
              ?>
            </div>

            <div class="col-12 col-md-6 mb-3">
              <label for="contactTelephone" class="font-weight-bold">Контакт телефон</label>
              <input 
                type="tel" 
                class="form-control font-italic p-4 
                  <?php if(if_POST()) {echo (! $contact_tel_err) ? 'is-valid' : 'is-invalid';} ?>" 
                id="contactTelephone" 
                name="contact_tel"
                value="<?php
                        if(if_POST()) {
                          echo trim($_POST['contact_tel']);
                          }
                        ?>"
                placeholder="Контакт телефон на Вашата компанија"
              >
              <?php 
                if (if_POST()) {
                  echo (! $contact_tel_err) ? '<div class="valid-feedback">Благодариме</div>' : '<div class="invalid-feedback">' . $contact_tel_err . '</div>';
                }
              ?>
            </div>
          </div>

          <div class="form-row d-flex align-items-end pb-5 mb-5">

            <div class="col-12 col-md-6 mb-3">
              <label for="studentType" class="font-weight-bold">Тип на студенти</label>
              <select class="custom-select custom-select-lg text-muted <?php if (if_POST()) {echo (! $student_type_err) ? 'is-valid' : 'is-invalid';} ?>" id="studentType" name="student_type">
                <option selected disabled>Изберете тип на студент</option>
                <option value="marketing" <?php
                                            if ( field_isset_not_empty('student_type', 'POST') ) {
                                              echo (option_is_selected("marketing", trim($_POST['student_type']), 'POST')) ? 'selected' : "";
                                             } ?>>Студенти од маркетинг</option>
                <option value="programming" <?php
                                              if ( field_isset_not_empty('student_type', 'POST') ) {
                                                echo (option_is_selected("programming", trim($_POST['student_type']), 'POST')) ? 'selected' : "";
                                              } 
                                                ?>>Студенти од програмирање</option>
                <option value="design" <?php
                                          if ( field_isset_not_empty('student_type', 'POST') ) {
                                            echo (option_is_selected("design", trim($_POST['student_type']), 'POST')) ? 'selected' : ""; 
                                          }
                                            ?>>Студенти од дизајн</option>
              </select>
              <?php 
                if (if_POST()) {
                  echo (! $student_type_err) ? '<div class="valid-feedback">Благодариме</div>' : '<div class="invalid-feedback">' . $student_type_err . '</div>';
                }
              ?>
            </div>

            <div class="col-12 col-md-6 mb-3">
              <button type="submit" class="btn btn-custom_colors btn-block btn-lg">ИСПРАТИ</button>
              <!-- <div style="width: 100%; margin-top: .25rem; font-size: 80%; color:  #FCD232 !important;"> -->

                <?php 
                  if (if_POST()) {
                    echo (! $student_type_err) ? '<div style="width: 100%; margin-top: .25rem; font-size: 80%; color:  #FCD232 !important;">Благодариме</div>' : '<div style="width: 100%; margin-top: .25rem; font-size: 80%; color:  #FCD232 !important;">'. $student_type_err .'</div>';
                  }
                ?>
              <!-- </div> -->
          </div>
        </form>
        <div class="col-12 text-center">
          <h3 class="p-5 font-weight-bold 
          <?php 
              if (if_POST()) {
                  if (!empty($message)) {
                    echo 'text-danger';
                  } 
              } else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['message']) && !empty(trim($_GET['message']))) {
                echo 'text-success';
              }
            ?>"><?php 
                if(if_POST()) {
                  if (!empty($message)) {
                    echo $message;
                  } 
                } else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['message']) && !empty(trim($_GET['message']))) {
                  echo trim($_GET['message']);
                }
  
            ?>
          </h3>

        </div>
      </div>

    </div>
    <!-- /Vraboti nash student strana -->

    <!-- Footer -->

    <div class="row text-center bg-dark text-light pt-3 fixed-bottom">
      <div class="col-12">
        <p>Изработено со <i class="fas fa-heart"></i> од студентите на Brainster</p>
      </div>
    </div>

  </div>







  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>

</body>
<script src="https://kit.fontawesome.com/280db70b77.js"></script>

</html>