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
        $current_page= 'afisare_produs';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">ID produs</th>
      <th scope="col">ID raion</th>
      <th scope="col">ID furnizor</th>
      <th scope="col">Nume produs</th>
      <th scope="col">Tip produs</th>
      <th scope="col">Data expirare</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(id_produs) as randuri FROM produs WHERE id_produs = :bind_id");
     $stmt->bindParam(":bind_id", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM produs WHERE id_produs = :bind_id");
         $stmt->bindParam(":bind_id", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(id_produs) as randuri FROM produs WHERE id_produs = :bind_id");
     $stmt->bindParam(":bind_id", $_POST['idProdus']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE produs SET id_produs = :bind_id, id_raion = :bind_id_raion, id_furnizor = :bind_id_furnizor, nume_produs = :bind_nume_produs, tip_produs = :bind_tip, data_expirare = :bind_data  WHERE id_produs = :bind_id");
         $stmt->bindParam(":bind_id", $_POST['idProdus']);
         $stmt->bindParam(":bind_id_raion", $_POST['idRaion']);
         $stmt->bindParam(":bind_id_furnizor", $_POST['idFurnizor']);
         $stmt->bindParam(":bind_nume_produs", $_POST['numeProdus']);
         $stmt->bindParam(":bind_tip", $_POST['tip']);
	 $stmt->bindParam(":bind_data", $_POST['data']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista nicio inregistrare in tabel.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM produs");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM produs ORDER BY id_produs DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM produs ORDER BY id_produs ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM produs ORDER BY data_expirare ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM produs ORDER BY data_expirare DESC");
                break;
            }

         default:
         {
             $stmt = $conn->prepare("SELECT * FROM produs ORDER BY id_produs ASC");
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
         <td><?= $result['id_produs'] ?></td>
         <td><?= $result['id_raion'] ?></td>
         <td><?= $result['id_furnizor'] ?></td>
         <td><?= $result['nume_produs'] ?></td>
 	 <td><?= $result['tip_produs'] ?></td>
	 <td><?= $result['data_expirare'] ?></td>
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
        <option value="3">Dupa data expirare crescator</option>
        <option value="4">Dupa data expirare descrescator</option>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Sorteaza</button>
</form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?edit">
        <label>ID Produs</label>
        <input type="text" class="form-control mb-3" name="idProdus" />
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
    <form>
 </div>
 </div>
 </div>
 </br>
</body>

</html>