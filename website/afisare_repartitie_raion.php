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
        $current_page= 'afisare_repartizare_raion';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">ID Angajat</th>
      <th scope="col">ID Raion</th>
      <th scope="col">Data repartizare</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(id_angajat) as randuri FROM repartitie_raion WHERE id_angajat = :bind_id_angajat");
     $stmt->bindParam(":bind_id_angajat", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM raion WHERE id_angajat = :bind_id_angajat");
         $stmt->bindParam(":bind_id_angajat", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(id_angajat) as randuri FROM raion WHERE id_angajat = :bind_id_angajat");
     $stmt->bindParam(":bind_id_angajat", $_POST['idAngajat']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE raion SET id_angajat = :bind_id_angajat, id_raion = :bind_id_raion, data = :bind_data WHERE id_angajat = :bind_id_angajat");
         $stmt->bindParam(":bind_id_angajat", $_POST['idAngajat']);
         $stmt->bindParam(":bind_id_raion", $_POST['idRaion']);
         $stmt->bindParam(":bind_data", $_POST['data']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista o inregistrare in baza de date asociata idului furnizat.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM repartitie_raion");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM repartitie_raion ORDER BY id_angajat DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM repartitie_raion ORDER BY id_raion ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM repartitie_raion ORDER BY data ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM raion ORDER BY data DESC");
                break;
            }

         default:
         {
             $stmt = $conn->prepare("SELECT * FROM raion ORDER BY id_raion ASC");
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
         <td><?= $result['id_raion'] ?></td>
         <td><?= $result['data'] ?></td>
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
</p>
<div class="collapse mb-3" id="collapse1">
  <div style="width: 30%" class="card card-body">
    <form class="mb-3" method="get" action="">
    <label class="mb-1">Ordoneaza</label>
    <select class="form-select mb-1"  name="orderby">
        <option selected></option>
        <option value="1">Dupa id angajat descrescator</option>
        <option value="2">Dupa id angajat crescator</option>
        <option value="3">Dupa data repartitie crescator</option>
        <option value="4">Dupa data repartitie descrescator</option>
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
        <label>ID raion</label>
        <input type="text" class="form-control mb-3" name="idRaion" />
        <label>Data repartitie</label>
        <input type="text" class="form-control mb-3" name="data" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    <form>
 </div>
 </div>
 </div>
 </br>
</body>

</html>