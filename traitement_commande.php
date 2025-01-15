<?php
// Constantes pour les taxes
define('TAXE_FEDERALE', 0.05);
define('TAXE_PROVINCIALE', 0.0995);
define('PRIX_UNITAIRE', 20.00);

// Validation des donneés
function validerDonnees($donnees) {
    $erreurs = [];

    if(empty($donnees['nom'])) {
        $erreurs[] = "Le nom du client est requis.";
    }

    if(empty($donnees['produit'])) {
        $erreurs[] = "Le produit est requis.";
    }

    if(empty($donnees['categorie'])) {
        $erreurs[] = "La categorie est requise.";
    }

    if(!is_numeric($donnees['quantite']) || $donnees['quantite'] < 1) {
        $erreurs[] = "Le nom du client est requis.";
    }

    if(empty($donnees['date_livraison'])) {
        $erreurs[] = "La date de livraison est requise.";
    }

    return $erreurs;
}

function estExempte($categorie) {
    $categoriesExemptee = ['vins', 'bebes', 'jouets', 'voitures'];
    return in_array($categorie, $categoriesExemptee);
}

// Calculer taxes
function calculerTaxes($sousTotal, $categorie) {
    $taxeFederale = $sousTotal * TAXE_FEDERALE;
    $taxeProvinciale = estExempte($categorie) ? 0 : $sousTotal * TAXE_PROVINCIALE;

    return [
        'federale' => $taxeFederale, 
        'provinciale' => $taxeProvincial
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erreurs = validerDonnees($POST);

    if(empty($erreurs)) {
        $sousTotal = $_POST['quantite'] * PRIX_UNITAIRE;
        $taxes = calculerTaxes($sousTotal, $_POST['categorie']);
        $total = $sousTotal + $taxes['federale'] + $taxes['provinciale'];

        // Afficher résumer
        echo "<h1>Résumé de la commande</h1>";
        echo "<p>Nom du client : " . htmlspecialchars($_POST['nom']) . "</p>";
        echo "<p>Produit : " . htmlspecialchars($_POST['produit']) . "</p>";
        echo "<p>Catégorie : " . htmlspecialchars($_POST['categorie']) . "</p>";
        echo "<p>Quantité : " . htmlspecialchars($_POST['quantite']) . "</p>";
        echo "<p>Sous-total : " . number_format($sousTotal, 2) . " $</p>";
        echo "<p>Taxe fédérale (5%) : " . number_format($taxes['federale'], 2) . " $</p>";
    }
}

?>