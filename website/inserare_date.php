<?php
include 'conexiune_bd.php';

?>
<!doctype html>
<html>
<meta charset="UTF-8">
<title>Hipermarket- baza de date</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">   
</head>
<style>


</style>
<body style="background-color:#ffffff">
    <?php
        $current_page= 'afisare_angajat';
        require 'navbar.php';

        if (isset($_GET['insert']))
        {
            switch ($_POST['tabel'])
            {
                case 'casa':
                {
                    $stmt = $conn->prepare("INSERT INTO casa_de_marcat (nume_model, data_revizie) VALUES (:nume, :data)");
                    $stmt->bindParam(":nume", $_POST['numeModel']);
                    $stmt->bindParam(":data", $_POST['data']);
                    $stmt->execute();
                    break;
                }
                case 'bilant':
                    {
                        $stmt = $conn->prepare("INSERT INTO bilant (capital, profit, pierderi) VALUES (:capital, :profit, :pierderi)");
                        $stmt->bindParam(":capital", $_POST['capital']);
                        $stmt->bindParam(":profit", $_POST['profit']);
                        $stmt->bindParam(":pierderi", $_POST['pierderi']);
                        $stmt->execute();
                        break;
                    }
                case 'inchidere':
                    {
                        $stmt = $conn->prepare("INSERT INTO inchidere_casa (serie_casa, inventar_monetar, pierderi, data_inchidere_casa) VALUES (:capital, :profit, :pierderi, :data)");
                        $stmt->bindParam(":capital", $_POST['serieCasa']);
                        $stmt->bindParam(":profit", $_POST['inventar']);
                        $stmt->bindParam(":pierderi", $_POST['pierderi']);
                        $stmt->bindParam(":data", $_POST['data']);
                            $stmt->execute();
                            break;
                    }
                case 'furnizor':
                    {
                        $stmt = $conn->prepare("INSERT INTO furnizor (nr_telefon_furnizor, adresa, nume_furnizor) VALUES (:numar, :adresa, :nume)");
                        $stmt->bindParam(":numar", $_POST['nrTelefon']);
                        $stmt->bindParam(":adresa", $_POST['adresa']);
                        $stmt->bindParam(":nume", $_POST['numeFurnizor']);
                            $stmt->execute();   
                            break; 
                    }
                case 'raion':
                    {
                        $stmt = $conn->prepare("INSERT INTO raion (nume_raion, numar_angajati_repartizati) VALUES (:nume, :nr)");
                        $stmt->bindParam(":nume", $_POST['numeRaion']);
                        $stmt->bindParam(":nr", $_POST['nrAngajati']);
                        $stmt->execute();    
                        break;
                    }
                case 'contract':
                    {
                        $stmt = $conn->prepare("INSERT INTO contract (id_furnizor, data_incheiere_contract, data_expirare_contract, contravaloare) VALUES (:id, :data_incheiere, :data_expirare, :contravaloare)");
                        $stmt->bindParam(":id", $_POST['idFurnizor']);
                        $stmt->bindParam(":data_incheiere", $_POST['dataIncheiere']);
                        $stmt->bindParam(":data_expirare", $_POST['dataExpirare']);
                        $stmt->bindParam(":contravaloare", $_POST['contravaloare']);
                        $stmt->execute();  
                        break;  
                    }
                case 'repartitie_raion':
                    {
                        $stmt = $conn->prepare("INSERT INTO repartitie_raion (id_angajat, id_raion, data) VALUES (:id_a, :id_r, :data)");
                        $stmt->bindParam(":id_a", $_POST['idAngajat']);
                        $stmt->bindParam(":id_r", $_POST['idRaion']);
                        $stmt->bindParam(":data", $_POST['data']);
                        $stmt->execute(); 
                        break;         
                    }
                case 'angajat':
                    {
                        $stmt = $conn->prepare("INSERT INTO angajat (serie_casa, functie, salariu, nume_angajat, nr_telefon, data_angajare, id_manager) VALUES (:serie, :functie, :salariu, :nume, :nr, :data, :id)");
                        $stmt->bindParam(":serie", $_POST['serieCasa']);
                        $stmt->bindParam(":functie", $_POST['functie']);
                        $stmt->bindParam(":salariu", $_POST['salariu']);
                        $stmt->bindParam(":nume", $_POST['numeAngajat']);
                        $stmt->bindParam(":nr", $_POST['nrTelefon']);
                        $stmt->bindParam(":data", $_POST['dataAngajat']);
                        $stmt->bindParam(":id", $_POST['idManager']);
                        $stmt->execute();  
                        break;          
                    }                   
            }
        }
    ?>
</br>
<div class="container">
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapseExample">
    Inserare angajat
    </button>
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapseExample">
    Inserare bilant
    </button>
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapseExample">
    Inserare casa
    </button>
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapseExample">
    Inserare contract
    </button>
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapseExample">
    Inserare furnizor
    </button>
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapseExample">
    Inserare inchidere casa
    </button>
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapseExample">
    Inserare produs
    </button>
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapseExample">
    Inserare raion
    </button>
    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapseExample">
    Inserare repartitie
    </button>
    <div class="collapse" id="collapse1">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
        <input type="text" name="tabel" value="angajat" hidden/>
        <label>Functie</label>
        <input type="text" class="form-control mb-3" name="serieCasa" />
        <label>Serie casa</label>
        <input type="text" class="form-control mb-3" name="functie" />
        <label>Salariu</label>
        <input type="text" class="form-control mb-3" name="salariu" />
        <label>Nume angajat</label>
        <input type="phone" class="form-control mb-3" name="numeAngajat" />
        <label>Numar telefon</label>
        <input type="text" class="form-control mb-3" name="numarTelefon" />
        <label>Data angajare</label>
        <input type="text" class="form-control mb-3" name="dataAngajare" />
        <label>ID Manager</label>
        <input type="text"  class="form-control mb-3" name="idManager" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
    <input type="text" name="tabel" value="bilant" hidden/>
        <label>Capital</label>
        <input type="text" class="form-control mb-3" name="capital" />
        <label>Profit</label>
        <input type="text" class="form-control mb-3" name="profit" />
        <label>Pierderi</label>
        <input type="text" class="form-control mb-3" name="pierderi" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>
 <div class="collapse" id="collapse3">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
        <input type="text" name="tabel" value="casa" hidden/>
        <label>Nume model casa de marcat</label>
        <input type="text" class="form-control mb-3" name="numeModel" />
        <label>Data revizie</label>
        <input type="text" class="form-control mb-3" name="data" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>
 <div class="collapse" id="collapse4">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
    <input type="text" name="tabel" value="contract" hidden/>
        <label>ID Angajat</label>
        <input type="text" class="form-control mb-3" name="idAngajat" />
        <label>Data incheiere contract</label>
        <input type="text" class="form-control mb-3" name="dataIncheiere" />
	<label>Data expirare contract</label>
        <input type="text" class="form-control mb-3" name="dataExpirare" />
	<label>Contravaloare contract</label>
        <input type="text" class="form-control mb-3" name="contravaloare" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>
 <div class="collapse" id="collapse5">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
    <input type="text" name="tabel" value="furnizor" hidden/>
        <label>Numar telefon furnizor</label>
        <input type="text" class="form-control mb-3" name="nrTelefon" />
        <label>Adresa furnizor</label>
        <input type="text" class="form-control mb-3" name="adresa" />
	<label>Nume furnizor</label>
        <input type="text" class="form-control mb-3" name="numeFurnizor" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>

 <div class="collapse" id="collapse6">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
    <input type="text" name="tabel" value="inchidere" hidden/>
        <label>Serie casa de marcat</label>
        <input type="text" class="form-control mb-3" name="serieCasa" />
        <label>Inventar</label>
        <input type="text" class="form-control mb-3" name="inventar" />
        <label>Pierderi</label>
        <input type="text" class="form-control mb-3" name="pierderi" />
        <label>Data inchidere casa</label>
        <input type="text" class="form-control mb-3" name="data" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>
 <div class="collapse" id="collapse7">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
    <input type="text" name="tabel" value="produs" hidden/>
        <label>ID Raion</label>
        <input type="text" class="form-control mb-3" name="idRaion" />
        <label>ID Furnizor</label>
        <input type="text" class="form-control mb-3" name="idFurnizor" />
        <label>Nume produs</label>
        <input type="text" class="form-control mb-3" name="numeProdus" />
        <label>Tip produs</label>
	<input type="text" class="form-control mb-3" name="tip" />
        <label>Data inchidere casa</label>
        <input type="text" class="form-control mb-3" name="data" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>
 <div class="collapse" id="collapse8">
 <input type="text" name="tabel" value="raion" hidden/>
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
        <label>Nume raion</label>
        <input type="text" class="form-control mb-3" name="numeRaion" />
        <label>Numar angajati repartizati</label>
        <input type="text" class="form-control mb-3" name="nrAngajati" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>
 <div class="collapse" id="collapse9">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?insert">
    <input type="text" name="tabel" value="repartitie" hidden/>
        <label>ID Angajat</label>
        <input type="text" class="form-control mb-3" name="idAngajat" />
        <label>ID raion</label>
        <input type="text" class="form-control mb-3" name="idRaion" />
        <label>Data repartitie</label>
        <input type="text" class="form-control mb-3" name="data" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    </form>
 </div>
 </div>

 </div>
 </br>
</body>

</html>