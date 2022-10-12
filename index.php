<?php

require_once '_connec.php';

$pdo = new PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);

// On veut afficher notre résultat via un tableau associatif (PDO::FETCH_ASSOC)
$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($friendsArray as $friend) { ?>
    <li> <?php echo  $friend['firstname'] . ' ' . $friend['lastname']; ?>
</li>
<?php } ?>


<form action="" method="get">
    <label for="firstname" class="form-label">Votre prénom :</label>
    <input type="text" name="firstname" id="firstname" class="form-control">

    <label for="lastname" class="form-label">Votre nom :</label>
    <input type="text" name="lastname" id="lastname" class="form-control">
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<?php 

if (isset($_GET['firstname']) && isset($_GET['lastname'])){
    $userfirstname = trim($_GET['firstname']);
    $userlastname = trim($_GET['lastname']);
    $query2 = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
    $statement2 = $pdo->prepare($query2);
    $statement2->bindValue(':firstname', $userfirstname, \PDO::PARAM_STR);
    $statement2->bindValue(':lastname', $userlastname, \PDO::PARAM_STR);
    
    $statement2->execute();
} else {
    echo "Insert your name plz";
}

?>

