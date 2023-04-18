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
        $current_page= 'afisare_contract';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">ID contract</th>
      <th scope="col">ID furnizor</th>
      <th scope="col">Data incheiere contract</th>
      <th scope="col">Data expirare contract</th>
      <th scope="col">Contravalorea</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(id_contract) as randuri FROM contract WHERE id_contract = :bind_id");
     $stmt->bindParam(":bind_id", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM contract WHERE id_contract = :bind_id");
         $stmt->bindParam(":bind_id", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(id_contract) as randuri FROM contract WHERE id_contract = :bind_id");
     $stmt->bindParam(":bind_id", $_POST['idContract']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE contract SET id_contract = :bind_id, id_furnizor = :bind_id_furnizor, data_incheiere_contract = :bind_data_incheiere, data_expirare_contract = :bind_data_expirare,  contravaloare = :bind_contravaloare WHERE id_contract = :bind_id");
         $stmt->bindParam(":bind_id", $_POST['idContract']);
         $stmt->bindParam(":bind_id_furnizor", $_POST['idAngajat']);
	 $stmt->bindParam(":bind_data_incheiere", $_POST['dataIncheiere']);
	 $stmt->bindParam(":bind_data_expirare", $_POST['dataExpirare']);
         $stmt->bindParam(":bind_contravaloare", $_POST['contravaloare']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista o inregistrare in baza de date asociata idului furnizat.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM contract");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM contract ORDER BY id_contract DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM contract ORDER BY id_contract ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM contract ORDER BY contravaloare ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM contract ORDER BY contravaloare DESC");
                break;
            }

         default:
         {
             $stmt = $conn->prepare("SELECT * FROM contract ORDER BY id_contract ASC");
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
         <td><?= $result['id_contract'] ?></td>
         <td><?= $result['id_furnizor'] ?></td>
	 <td><?= $result['data_incheiere_contract'] ?></td>
	 <td><?= $result['data_expirare_contract'] ?></td>
         <td><?= $result['contravaloare'] ?></td>
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
        <option value="3">Dupa contravaloare crescator</option>
        <option value="4">Dupa contravaloare descrescator</option>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Sorteaza</button>
</form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?edit">
        <label>ID Contract</label>
        <input type="text" class="form-control mb-3" name="idContract" />
        <label>ID Angajat</label>
        <input type="text" class="form-control mb-3" name="idAngajat" />
        <label>Data incheiere contract</label>
        <input type="text" class="form-control mb-3" name="dataIncheiere" />
	<label>Data expirare contract</label>
        <input type="text" class="form-control mb-3" name="dataExpirare" />
	<label>Contravaloare contract</label>
        <input type="text" class="form-control mb-3" name="contravaloare" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    <form>
 </div>
 </div>
 </div>
 </br>
</body>

</html>