<?php
include 'conexiune_bd.php';

?>
<html>
<meta charset="UTF-8">
<title>Hipermarket- baza de date</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">   
</head>
<style>
body {
  
}

</style>
<body style="background-color:#ffffff">
    <?php
        $current_page= 'index';
        require 'navbar.php';
    ?>
</br>
<div class="container">
<div class="card mb-3">
        <div class="card-body">
            <p class="card-title display-5 text-center"><b>Statistica tabel a angajatilor cu salariul de peste 2000 RON</b></p>
        </div>
</div>
<table class="table">
<thead>
      <th scope="col">#</th>
      <th scope="col">Functie</th>
      <th scope="col">Salariu</th>
</thead>
<tbody>
<?php $stmt = $conn->prepare("SELECT id_angajat, functie, salariu FROM angajat GROUP BY functie HAVING salariu >= 2000 ORDER BY salariu");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result)
 {
    
    ?>
     <tr>
         <td><?= $result['id_angajat'] ?></td>
         <td><?= $result['functie'] ?></td>
         <td><?= $result['salariu'] ?></td>
     </tr>
 
 <?php } ?>
 </tbody>
 </table>





 <div class="card mb-3">
        <div class="card-body">
            <p class="card-title display-5 text-center"><b>Statistica tabel a produselor in functie de tip cu data de expirare trecuta de 12.04.2023</b></p>
        </div>
</div>
 <table class="table">
<thead>
      <th scope="col">#</th>
      <th scope="col">Tip produs</th>
      <th scope="col">Data expirare</th>
</thead>
<tbody>
<?php $stmt = $conn->prepare("SELECT id_produs, tip_produs, data_expirare FROM produs GROUP BY tip_produs HAVING data_expirare > '2023-04-12' ORDER BY data_expirare");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result)
 {
    ?>
     <tr>
         <td><?= $result['id_produs'] ?></td>
         <td><?= $result['tip_produs'] ?></td>
         <td><?= $result['data_expirare'] ?></td>
     </tr>
 
 </div>
 <?php } ?>
 </tbody>
 </table>
</body>

</html>