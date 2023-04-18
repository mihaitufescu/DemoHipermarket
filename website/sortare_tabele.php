<?php
include 'conexiune_bd.php';

?>
<html>
<meta charset="UTF-8">
<title>Hipermarket- baza de date</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">   
</head>
<style>
body {
  overflow-y:hidden;
}


</style>
<body style="background-color:#ffffff">
    <?php
        $current_page= 'index';
        require 'navbar.php';
    ?>

</br>
<div class="d-flex p-2 bd-highlight ms-3"><h4>Ce doresti sa utilizezi?</h4></div>
<div id="optiuni" class="bg-light border  aligns-items-center justify-content-center pt-2 ps-1 pe-1" style="height:100%">
    <ul class="list-group">
        <li class="nav-item dropdown">
          <a class="list-group-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><h3>Afisare tabele</h3></a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Angajat</a></li>
            <li><a class="dropdown-item" href="#">Bilant</a></li>
            <li><a class="dropdown-item" href="#">Casa de marcat</a></li>
            <li><a class="dropdown-item" href="#">Inchidere casa de marcat</a></li>
            <li><a class="dropdown-item" href="#">Raion</a></li>
            <li><a class="dropdown-item" href="#">Repartitie raion</a></li>
            <li><a class="dropdown-item" href="#">Produse</a></li>
            <li><a class="dropdown-item" href="#">Furnizor</a></li>
            <li><a class="dropdown-item" href="#">Contract</a></li>
          </ul>
          
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <h3><a onclick="location.href = 'sortare_tabele.php'" >Sortare tabel</a></h3>
            <span class="badge bg-primary rounded-pill">9</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <h3><a onclick="location.href = 'modificare_tabele.php'">Modificare tabel</a></h3>
            <span class="badge bg-primary rounded-pill">9</span>
        </li>
        <li class="nav-item dropdown">
          <a class="list-group-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><h3>Operatii tabele</h3></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Statistica tabele</a></li>
            <li><a class="dropdown-item" href="#">Adaugare constrangeri</a></li>
            <li><a class="dropdown-item" href="#">Subcereri corelate</a></li>
          </ul>
          
        </li>
    </ul>
</div>
</body>

</html>