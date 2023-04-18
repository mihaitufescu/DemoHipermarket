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
        $current_page= 'afisare_bilant';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">Cod inregistrare</th>
      <th scope="col">ID angajat</th>
      <th scope="col">Capital</th>
      <th scope="col">Profit</th>
      <th scope="col">Pierderi</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(cod_inregistrare) as randuri FROM bilant WHERE cod_inregistrare = :bind_cod");
     $stmt->bindParam(":bind_cod", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM bilant WHERE cod_inregistrare = :bind_cod");
         $stmt->bindParam(":bind_cod", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(cod_inregistrare) as randuri FROM bilant WHERE cod_inregistrare = :bind_cod");
     $stmt->bindParam(":bind_cod", $_POST['codInregistrare']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE bilant SET cod_inregistrare = :bind_cod, id_angajat = :bind_id_angajat, capital = :bind_capital, profit = :bind_profit, pierderi = :bind_pierderi WHERE cod_inregistrare = :bind_cod");
         $stmt->bindParam(":bind_cod", $_POST['codInregistrare']);
         $stmt->bindParam(":bind_id_angajat", $_POST['idAngajat']);
         $stmt->bindParam(":bind_capital", $_POST['capital']);
         $stmt->bindParam(":bind_profit", $_POST['profit']);
         $stmt->bindParam(":bind_pierderi", $_POST['pierderi']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista nicio inregistrare in tabel.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM bilant");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM bilant ORDER BY cod_inregistrare DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM bilant ORDER BY cod_inregistrare ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM bilant ORDER BY profit ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM bilant ORDER BY profit DESC");
                break;
            }

         default:
         {
             $stmt = $conn->prepare("SELECT * FROM bilant ORDER BY cod_inregistrare ASC");
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
         <td><?= $result['cod_inregistrare'] ?></td>
         <td><?= $result['id_angajat'] ?></td>
         <td><?= $result['capital'] ?></td>
         <td><?= $result['profit'] ?></td>
         <td><?= $result['pierderi'] ?></td>
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
        <option value="3">Dupa profit crescator</option>
        <option value="4">Dupa profit descrescator</option>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Sorteaza</button>
</form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?edit">
        <label>Cod inregistrare</label>
        <input type="text" class="form-control mb-3" name="codInregistrare" />
        <label>ID Angajat</label>
        <input type="text" class="form-control mb-3" name="idAngajat" />
        <label>Capital</label>
        <input type="text" class="form-control mb-3" name="capital" />
        <label>Profit</label>
        <input type="text" class="form-control mb-3" name="profit" />
        <label>Pierderi</label>
        <input type="text" class="form-control mb-3" name="pierderi" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    <form>
 </div>
 </div>
 </div>
 </br>
</body>

</html>