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
        $current_page= 'afisare_raion';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">ID Raion</th>
      <th scope="col">Nume Raion</th>
      <th scope="col">Numar angajati repartizati</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(id_raion) as randuri FROM raion WHERE id_raion = :bind_id_raion");
     $stmt->bindParam(":bind_id_raion", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM raion WHERE id_raion = :bind_id_raion");
         $stmt->bindParam(":bind_id_raion", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(id_angajat) as randuri FROM raion WHERE id_raion = :bind_id_raion");
     $stmt->bindParam(":bind_id_raion", $_POST['idRaion']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE raion SET id_raion = :bind_id_raion, nume_raion = :bind_nume_raion, numar_angajati_repartizati = :bind_numar_angajati_repartizati WHERE id_angajat = :bind_id_angajat");
         $stmt->bindParam(":bind_id_raion", $_POST['idRaion']);
         $stmt->bindParam(":bind_nume_raion", $_POST['numeRaion']);
         $stmt->bindParam(":bind_numar_angajati_repartizati", $_POST['nrAngajati']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista o inregistrare in baza de date asociata idului furnizat.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM raion");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM raion ORDER BY id_raion DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM raion ORDER BY id_raion ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM raion ORDER BY nume_raion ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM raion ORDER BY nume_raion DESC");
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
         <td><?= $result['id_raion'] ?></td>
         <td><?= $result['nume_raion'] ?></td>
         <td><?= $result['numar_angajati_repartizati'] ?></td>
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
        <option value="1">Dupa id descrescator</option>
        <option value="2">Dupa id crescator</option>
        <option value="3">Dupa nume raion crescator</option>
        <option value="4">Dupa nume raion descrescator</option>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Sorteaza</button>
</form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?edit">
        <label>ID Raion</label>
        <input type="text" class="form-control mb-3" name="idRaion" />
        <label>Nume raion</label>
        <input type="text" class="form-control mb-3" name="numeRaion" />
        <label>Numar angajati repartizati</label>
        <input type="text" class="form-control mb-3" name="nrAngajati" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    <form>
 </div>
 </div>
 </div>
 </br>
</body>

</html>