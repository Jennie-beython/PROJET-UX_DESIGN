<?php
require 'vendor/autoload.php';
$faker = Faker\Factory::create();

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=products_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Génération des données fictives
try {
    for ($i = 1; $i <= 1000; $i++) {
        $name = ucfirst($faker->word); // Nom du produit avec majuscule
        $description = $faker->sentence(10); // Description aléatoire
        $price = $faker->randomFloat(2, 10, 1000); // Prix entre 10 et 1000
        
        // Image aléatoire unique depuis Unsplash
        $uniqueId = uniqid(); // Assure une URL unique
        $image_url = "https://source.unsplash.com/200x200/?clothing,fashion&" . $uniqueId;

        // Insertion dans la base de données
        $sql = "INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $price, $image_url]);

        echo "Produit $i inséré avec succès.<br>";
    }

    echo "Toutes les données ont été générées avec succès !";
} catch (PDOException $e) {
    die("Erreur lors de l'insertion des données : " . $e->getMessage());
}
?>
