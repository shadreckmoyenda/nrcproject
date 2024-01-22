<?php
  //-- ======= Header ======= -->
  require page('includes/header');

  //-- ======= navbar ======= -->
  require page('includes/navbar');
  

  //-- ======= Hero Section ======= -->
  require section('hero');
   
?>

  <main id="main">
    
<?php
  //-- ======= About Us Section ======= -->
  require section('about');
    
  //-- ======= studyhere ======= -->
  require section('studyhere');


  //-- ======= faculties ======= -->
  require section('faculties');

    
  //-- ======= programmes ======= -->
  require section('programmes');


  //-- ======= whyhere ======= -->
  require section('whyus');


  //-- ======= Entry requirements section ======= -->
  require section('entry_requirements');


  //-- ======= Call to apply section ======= -->
  require section('cta');
?>

  </main>

<?php
  //-- ======= Footer ======= -->
  require page('includes/footer');
?>