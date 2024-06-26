<?php
include_once("functions.php");

$pdo = connectToDB();

$sql = "
CREATE TABLE IF NOT EXISTS filiere(
    codfil INT AUTO_INCREMENT PRIMARY KEY,
    libfil VARCHAR(255) NOT NULL,
    createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedait TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS matiere(
    codmat INT AUTO_INCREMENT PRIMARY KEY,
    libmat VARCHAR(255) NOT NULL,
    nbrecredit INT NOT NULL,
    createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedait TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS etudiant(
    numma VARCHAR(40) PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenoms VARCHAR(255) NOT NULL,
    date_naissance VARCHAR(20) NOT NULL,
    codfil INT,
    FOREIGN KEY (codfil) REFERENCES filiere(codfil),
    createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedait TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS releve(
    numma VARCHAR(40),
    codmat INT,
    note DOUBLE NOT NULL,
    FOREIGN KEY (numma) REFERENCES etudiant(numma),
    FOREIGN KEY (codmat) REFERENCES matiere(codmat),
    PRIMARY KEY (numma, codmat),
    createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedat TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
";

try {
    $pdo->exec($sql);
    echo "Table crées avec succès ! <br>";
} catch (PDOException $e) {
    echo "Erreur ! <br>" . $e->getMessage();
}

//creation de quelques filière
$tab = ["L3-Mathématique", "L3-Informatique", "GIL2", "GIL3", "GIL5", "L3-Physique"];
$sql = 'INSERT INTO filiere (libfil) VALUES(?)';
$req = $pdo->prepare($sql);

for ($i = 0; $i < count($tab); $i++) {
    try {
        $req->execute([$tab[$i]]);
        echo "Filière insérée ! <br>";
    } catch (PDOException $e) {
        echo "erreur d'insersion de filière ! " . $e->getMessage();
    }
}

//section de l'id de GIL2
$sql = 'SELECT * FROM filiere';
$req = $pdo->prepare($sql);
$req->execute();
$reqs = $req->fetchAll();

foreach ($reqs as $a) {
    if ($a['libfil'] == "GIL2") {
        $id = $a['codfil'];
        break;
    }
}

//insersion de 10 étudiants dans la filière GIL2 par requète sql
$table = [
    array(
        'numma' => '1275391',
        'nom' => 'MIINHOUESSE',
        'prenoms' => 'Chancelle',
        'date_naissance' => '01/01/2001',
        'codfil' => $id
    ),
    array(
        'numma' => '1275500',
        'nom' => 'MIKIN',
        'prenoms' => 'Jean ',
        'date_naissance' => '01/01/2000',
        'codfil' => $id
    ),
    array(
        'numma' => '12754916',
        'nom' => 'TOTO',
        'prenoms' => 'Tata',
        'date_naissance' => '05/05/2005',
        'codfil' => $id
    ),
    array(
        'numma' => '2753716',
        'nom' => 'DANSOU',
        'prenoms' => 'Christophe',
        'date_naissance' => '02/02/2002',
        'codfil' => $id
    ),
    array(
        'numma' => '2753848',
        'nom' => 'TANTAN',
        'prenoms' => 'Baké',
        'date_naissance' => '03/03/1997',
        'codfil' => $id
    ),
    array(
        'numma' => '2743914',
        'nom' => 'DOBO',
        'prenoms' => 'Divine ',
        'date_naissance' => '23/07/1996',
        'codfil' => $id
    ),
    array(
        'numma' => '2754945',
        'nom' => 'AHAH',
        'prenoms' => 'Viviane',
        'date_naissance' => '22/04/2003',
        'codfil' => $id
    ),
    array(
        'numma' => '3754587',
        'nom' => 'SOSA',
        'prenoms' => 'Tobi',
        'date_naissance' => '02/12/1997',
        'codfil' => $id
    ),
    array(
        'numma' => '4743817',
        'nom' => 'TONTO',
        'prenoms' => 'Toni',
        'date_naissance' => '15/05/2000',
        'codfil' => $id
    ),
    array(
        'numma' => '8478590',
        'nom' => 'MIKINHOUESSE',
        'prenoms' => 'Patrice',
        'date_naissance' => '30/03/2003',
        'codfil' => $id
    ),
];
$sql = 'INSERT INTO etudiant (numma, nom, prenoms, date_naissance,codfil) VALUES (?,?,?,?,?)';
$req = $pdo->prepare($sql);

for ($i = 0; $i < count($table); $i++) {
    try {
        $req->execute([$table[$i]['numma'], $table[$i]['nom'], $table[$i]['prenoms'], $table[$i]['date_naissance'], $table[$i]['codfil']]);
        echo "Etudiant stocké avec succès ! <br>";
    } catch (PDOException $e) {
        echo "Erreur d'insertion " . $e->getMessage();
    }
}

//insersion des de cinq matière par sql
$tabmat = [
    array(
        'libmat' => "Fondamentaux des SE",
        'nbrecredit' => 5
    ),
    array(
        'libmat' => "Probabilité",
        'nbrecredit' => 4
    ),
    array(
        'libmat' => "Analyse Différentielle",
        'nbrecredit' => 6
    ),
    array(
        'libmat' => "Propagation des Ondes",
        'nbrecredit' => 3
    ),
    array(
        'libmat' => "Service des Réseau Classique",
        'nbrecredit' => 6
    ),
];
$sql = "INSERT INTO matiere (libmat, nbrecredit) VALUES (?,?)";
$req = $pdo->prepare($sql);

for ($i = 0; $i < count($tabmat); $i++) {
    try {
        $req->execute([$tabmat[$i]['libmat'], $tabmat[$i]['nbrecredit']]);
        echo "Matière insérée avec succès ! <br>";
    } catch (PDOException $e) {
        echo "Erreur d'insertion de matière ! " . $e->getMessage() . "<br>";
    }
}
