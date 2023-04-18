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
        $current_page= 'afisare_casa_de_marcat';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<table class="table mb-5">
  <thead>
    <tr>
      <th scope="col">Serie casa</th>
      <th scope="col">Nume model</th>
      <th scope="col">Date revizie</th>
    </tr>
  </thead>
  
  <tbody>
<?php
 

 if (isset($_GET['delete']))
 {
     $stmt = $conn->prepare("SELECT COUNT(serie_casa) as randuri FROM casa_de_marcat WHERE serie_casa = :bind_serie");
     $stmt->bindParam(":bind_serie", $_GET['delete']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("DELETE FROM casa_de_marcat WHERE serie_casa = :bind_serie");
         $stmt->bindParam(":bind_serie", $_GET['delete']);
         $stmt->execute();          
     }
 } else if (isset($_GET['edit'])) {
     $stmt = $conn->prepare("SELECT COUNT(serie_casa) as randuri FROM casa_de_marcat WHERE serie_casa = :bind_serie");
     $stmt->bindParam(":bind_serie", $_POST['serieCasa']);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
     if ($result['randuri'] > 0)
     {
         $stmt = $conn->prepare("UPDATE casa_de_marcat SET serie_casa = :bind_serie, nume_model = :bind_nume_model, data_revizie = :bind_data WHERE serie_casa = :bind_serie");
         $stmt->bindParam(":bind_serie", $_POST['serieCasa']);
         $stmt->bindParam(":bind_nume_model", $_POST['numeModel']);
         $stmt->bindParam(":bind_data", $_POST['data']);
         $stmt->execute();          
     }
     else
         echo 'Nu exista o inregistrare in baza de date asociata idului furnizat.';
 }

 if (!isset($_GET['orderby']))
     $stmt = $conn->prepare("SELECT * FROM casa_de_marcat");
 else
 {
     switch ($_GET['orderby'])
     {
         case 1:
         {
             $stmt = $conn->prepare("SELECT * FROM casa_de_marcat ORDER BY serie_casa DESC");
             break;
         }

         case 2:
         {
             $stmt = $conn->prepare("SELECT * FROM casa_de_marcat ORDER BY serie_casa ASC");
             break;
         }

         case 3:
         {
             $stmt = $conn->prepare("SELECT * FROM casa_de_marcat ORDER BY data_revizie ASC");
             break;
         }

         case 4:
            {
                $stmt = $conn->prepare("SELECT * FROM casa_de_marcat ORDER BY data_revizie DESC");
                break;
            }

         default:
         {
             $stmt = $conn->prepare("SELECT * FROM casa_de_marcat ORDER BY serie_casa ASC");
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
         <td><?= $result['serie_casa'] ?></td>
         <td><?= $result['nume_model'] ?></td>
         <td><?= $result['data_revizie'] ?></td>
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
        <option value="3">Dupa data crescator</option>
        <option value="4">Dupa data descrescator</option>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Sorteaza</button>
</form>
 </div>
 </div>
 <div class="collapse" id="collapse2">
  <div style="width: 30%" class="card card-body">
    <form method="post" action="?edit">
        <label>Serie casa de marcat</label>
        <input type="text" class="form-control mb-3" name="serieCasa" />
        <label>Nume model casa de marcat</label>
        <input type="text" class="form-control mb-3" name="numeModel" />
        <label>Data revizie</label>
        <input type="text" class="form-control mb-3" name="data" />
        <button type="submit" class="btn btn-warning btn-sm">Editare</button>
    <form>
 </div>
 </div>
 </div>
 </br>
</body>

</html>