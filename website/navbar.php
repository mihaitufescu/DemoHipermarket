<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" onclick="location.href = 'index.php'">Acasa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Modificare tabele</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" onclick="location.href = 'afisare_angajat.php'">Angajat</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_bilant.php'">Bilant</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_casa_de_marcat.php'">Casa de marcat</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_inchidere_casa.php'">Inchidere casa de marcat</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_raion.php'">Raion</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_repartitie_raion.php'">Repartitie raion</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_produs.php'">Produse</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_furnizor.php'">Furnizor</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'afisare_contract.php'">Contract</a></li>
            <li><a class="dropdown-item" onclick="location.href = 'inserare_date.php'">Inserare date</a></li>
          </ul>
      </li> 
      <li class="nav-item">
          <a class="nav-link" onclick="location.href = 'statistica_tabele.php'">Statistica tabele</a>
      </li>
      </ul>
    </div>
  </div>
</nav>


</body>
</html>


