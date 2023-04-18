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
        $current_page= 'afisare_furnizor';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">ID furnizor</th>
      <th scope="col">Numar telefon furnizor</th>
      <th scope="col">Adresa</th>
      <th scope="col">Nume furnizor</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(id_furnizor) as randuri FROM furnizor WHERE id_furnizor = :bind_id");
     $stmt->bindParam(":bind_id", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM furnizor WHERE id_furnizor = :bind_id");
         $stmt->bindParam(":bind_id", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(id_furnizor) as randuri FROM furnizor WHERE id_furnizor = :bind_id");
     $stmt->bindParam(":bind_id", $_POST['idfurnizor']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE furnizor SET id_furnizor = :bind_id, nr_telefon_furnizor = :bind_numar_telefon, adresa = :bind_adresa, nume_furnizor = :bind_nume_furnizor WHERE id_furnizor = :bind_id");
         $stmt->bindParam(":bind_id", $_POST['idfurnizor']);
         $stmt->bindParam(":bind_numar_telefon", $_POST['nrTelefon']);
	 $stmt->bindParam(":bind_adresa", $_POST['adresa']);
	 $stmt->bindParam(":bind_nume_furnizor", $_POST['numeFurnizor']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista o inregistrare in baza de date asociata idului furnizat.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM furnizor");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM furnizor ORDER BY id_furnizor DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM furnizor ORDER BY id_furnizor ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM furnizor ORDER BY nume_furnizor ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM furnizor ORDER BY nume_furnizor DESC");
                break;
            }

         default:
         {
             $stmt = $conn->prepare("SELECT * FROM furnizor ORDER BY id_furnizor ASC");
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
         <td><?= $result['id_furnizor'] ?></td>
         <td><?= $result['nr_telefon_furnizor'] ?></td>
	 <td><?= $result['adresa'] ?></td>
	 <td><?= $result['nume_furnizor'] ?></td>
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
        <option value="3">Dupa nume crescator</option>
        <option value="4">Dupa nume descrescator</option>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Sorteaza</button>
</form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?edit">
        <label>ID furnizor</label>
        <input type="text" class="form-control mb-3" name="idfurnizor" />
        <label>Numar telefon furnizor</label>
        <input type="text" class="form-control mb-3" name="nrTelefon" />
        <label>Adresa furnizor</label>
        <input type="text" class="form-control mb-3" name="adresa" />
	<label>Nume furnizor</label>
        <input type="text" class="form-control mb-3" name="numeFurnizor" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    <form>
 </div>
 </div>
 </div>
 </br>
</body>

</html>