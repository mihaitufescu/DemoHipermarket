<?php
include 'conexiune_bd.php';

?>
<html>
<meta charset="UTF-8">
<title>Hipermarket- baza de date</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<div class="container">
    <div class="card mb-3">
        <div class="card-body">
            <p class="card-title display-5 text-center"><strong>Aceasta aplicatie web este o implementare a unei interfate pentru o baze de date proiectate pentru a stoca informatii despre un hipermarket.</strong></p>
        </div>
    </div>
    <ul class="list-group" style="list-style-type: none;">
        <li class="nav-item dropdown mb-3">
          <a class="list-group-item" href="#" role="button" data-bs-toggle="dropdown">
            <h3 class="display-6 text-center"><i class="fa-regular fa-square-caret-down me-2"></i>MODIFICARE TABELE</h3>
          </a>
          <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" onclick="location.href = 'afisare_angajat.php'">Angajat</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_bilant.php'">Bilant</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_casa_de_marcat.php'">Casa de marcat</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_inchidere_casa.php'">Inchidere casa de marcat</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_raion.php'">Raion</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_repartitie_raion.php'">Repartitie raion</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_produs.php'">Produse</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_furnizor.php'">Furnizor</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_contract.php'">Contract</a></li>
          </ul>
        </li>
        <li class="list-group-item mb-3">
            <p class="display-6 text-center"><a onclick="location.href = 'statistica_tabele.php'" ><i class="fa-solid fa-arrow-right me-2"></i>STATISTICA TABELE</a></h3>
        </li>
    </ul>
</div>


</body>

</html>