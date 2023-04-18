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
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">ID Angajat</th>
      <th scope="col">Serie casa</th>
      <th scope="col">Functie</th>
      <th scope="col">Salariu</th>
      <th scope="col">Nume angajat</th>
      <th scope="col">Numar telefon</th>
      <th scope="col">Data angajare</th>
      <th scope="col">ID manager</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(id_angajat) as randuri FROM angajat WHERE id_angajat = :bind_id");
     $stmt->bindParam(":bind_id", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM angajat WHERE id_angajat = :bind_id");
         $stmt->bindParam(":bind_id", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(id_angajat) as randuri FROM angajat WHERE id_angajat = :bind_id");
     $stmt->bindParam(":bind_id", $_POST['idAngajat']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE angajat SET functie = :bind_functie, salariu = :bind_salariu, nume_angajat = :bind_nume_angajat, nr_telefon = :bind_nr_telefon, data_angajare = :bind_data_angajare, id_manager = :bind_id_manager WHERE id_angajat = :bind_id");
         $stmt->bindParam(":bind_id", $_POST['idAngajat']);
         $stmt->bindParam(":bind_functie", $_POST['functie']);
         $stmt->bindParam(":bind_salariu", $_POST['salariu']);
         $stmt->bindParam(":bind_nume_angajat", $_POST['numeAngajat']);
         $stmt->bindParam(":bind_nr_telefon", $_POST['numarTelefon']);
         $stmt->bindParam(":bind_data_angajare", $_POST['dataAngajare']);
         $stmt->bindParam(":bind_id_manager", $_POST['idManager']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista nicio inregistrare in tabel.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM angajat");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM angajat ORDER BY id_angajat DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM angajat ORDER BY id_angajat ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM angajat ORDER BY salariu ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM angajat ORDER BY salariu DESC");
                break;
            }

         default:
         {
             $stmt = $conn->prepare("SELECT * FROM angajat ORDER BY id_angajat ASC");
             break;
         }
     }
 }
 $stmt->execute();

 $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
 foreach ($results as $result)

 {
    ?>
 
     <tr>
         <td><?= $result['id_angajat'] ?></td>
         <td><?= $result['serie_casa'] ?></td>
         <td><?= $result['functie'] ?></td>
         <td><?= $result['salariu'] ?></td>
         <td><?= $result['nume_angajat'] ?></td>
         <td><?= $result['nr_telefon'] ?></td>
         <td><?= $result['data_angajare'] ?></td>
         <td><?= $result['id_manager'] ?></td>
     </tr>

 <?php } ?>
 </tbody>
    </table>
    <p>
  <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapseExample">
    Ordonare tabel
  </button>
  <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapseExample">
    Editare intrare
  </button>
  <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapseExample">
    Afisare raion la care lucreaza un angajat
  </button>
</p>
<div class="collapse mb-3" id="collapse1">
  <div style="width: 30%" class="card card-body">
    <form class="mb-3" method="get" action="">
    <label class="mb-1">Ordoneaza</label>
    <select class="form-select mb-1"  name="orderby">
        <option selected></option>
        <option value="1">Dupa id descrescator</option>
        <option value="2">Dupa id crescator</option>
        <option value="3">Dupa salariu crescator</option>
        <option value="4">Dupa salariu descrescator</option>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Sorteaza</button>
</form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?edit">
        <label>ID Angajat</label>
        <input type="text" class="form-control mb-3" name="idAngajat" />
        <label>Functie</label>
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
 <?php
 if (isset($_GET['afisare_raion']))
 {
     $stmt = $conn->prepare("SELECT nume_raion from raion WHERE id_raion IN (SELECT repartitie_raion.id_raion FROM repartitie_raion INNER JOIN angajat ON repartitie_raion.id_angajat = angajat.id_angajat and angajat.id_angajat = :bind_id)");
     $stmt->bindParam(":bind_id", $_POST['idAngajat']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);

     echo 'RAIONUL ANGAJATULUI ESTE: ' . $result['nume_raion'];
 }
 
 ?> 
 <div class="collapse" id="collapse3">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?afisare_raion">
        <label>ID Angajat</label>
        <input type="text" class="form-control mb-3" name="idAngajat" />
        <button type="submit" class="btn btn-warning btn-sm">Executa</button>
    </form>
 </div>
 </div>
 </div>
 </br>
</body>

</html>