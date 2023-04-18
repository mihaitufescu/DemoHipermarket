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
        $current_page= 'afisare_inchidere_casa';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">ID inchidere casa</th>
      <th scope="col">Serie casa</th>
      <th scope="col">Inventar monetar</th>
      <th scope="col">Pierderi</th>
      <th scope="col">Data inchidere casa</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(id_inchidere_casa) as randuri FROM inchidere_casa WHERE id_inchidere_casa = :bind_id");
     $stmt->bindParam(":bind_id", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM inchidere_casa WHERE id_inchidere_casa = :bind_id");
         $stmt->bindParam(":bind_id", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(id_inchidere_casa) as randuri FROM inchidere_casa WHERE id_inchidere_casa = :bind_id");
     $stmt->bindParam(":bind_id", $_POST['idInchidere']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE inchidere_casa SET id_inchidere_casa = :bind_id, serie_casa = :bind_serie_casa, inventar = :bind_bind_inventar, pierderi = :bind_pierderi, data_inchidere_casa = :bind_data WHERE id_inchidere_casa = :bind_id");
         $stmt->bindParam(":bind_id", $_POST['idInchidere']);
         $stmt->bindParam(":bind_serie_casa", $_POST['serieCasa']);
         $stmt->bindParam(":bind_inventar", $_POST['inventar']);
         $stmt->bindParam(":bind_pierderi", $_POST['pierderi']);
         $stmt->bindParam(":bind_data", $_POST['data']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista nicio inregistrare in tabel.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM inchidere_casa");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM inchidere_casa ORDER BY id_inchidere_casa DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM inchidere_casa ORDER BY id_inchidere_casa ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM inchidere_casa ORDER BY inventar ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM inchidere_casa ORDER BY inventar DESC");
                break;
            }

         default:
         {
             $stmt = $conn->prepare("SELECT * FROM inchidere_casa ORDER BY id_inchidere_casa ASC");
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
         <td><?= $result['id_inchidere_casa'] ?></td>
         <td><?= $result['serie_casa'] ?></td>
         <td><?= $result['inventar_monetar'] ?></td>
         <td><?= $result['pierderi'] ?></td>
         <td><?= $result['data_inchidere_casa'] ?></td>
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
        <option value="3">Dupa inventar crescator</option>
        <option value="4">Dupa inventar descrescator</option>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Sorteaza</button>
</form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?edit">
        <label>ID Inchidere casa</label>
        <input type="text" class="form-control mb-3" name="idInchidere" />
        <label>Serie casa de marcat</label>
        <input type="text" class="form-control mb-3" name="serieCasa" />
        <label>Inventar</label>
        <input type="text" class="form-control mb-3" name="inventar" />
        <label>Pierderi</label>
        <input type="text" class="form-control mb-3" name="pierderi" />
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