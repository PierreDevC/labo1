<?php
// Constantes pour les taux de taxes
define('TAXE_FEDERALE', 0.05);
define('TAXE_PROVINCIALE', 0.0995);
define('PRIX_UNITAIRE', 20.00);

// Fonction pour valider les données
function validerDonnees($donnees) {
    $erreurs = [];
    
    if (empty($donnees['nom_client'])) {
        $erreurs[] = "Le nom du client est requis.";
    }
    
    if (empty($donnees['produit'])) {
        $erreurs[] = "Le produit est requis.";
    }
    
    if (empty($donnees['categorie'])) {
        $erreurs[] = "La catégorie est requise.";
    }
    
    if (!is_numeric($donnees['quantite']) || $donnees['quantite'] < 1) {
        $erreurs[] = "La quantité doit être un nombre positif.";
    }
    
    if (empty($donnees['date_livraison'])) {
        $erreurs[] = "La date de livraison est requise.";
    }
    
    return $erreurs;
}

// Fonction pour vérifier si la catégorie est exemptée de taxe provinciale
function estExempte($categorie) {
    $categoriesExemptees = ['vins', 'bebes', 'jouets', 'voitures'];
    return in_array($categorie, $categoriesExemptees);
}

// Fonction pour calculer les taxes
function calculerTaxes($sousTotal, $categorie) {
    $taxeFederale = $sousTotal * TAXE_FEDERALE;
    $taxeProvinciale = estExempte($categorie) ? 0 : $sousTotal * TAXE_PROVINCIALE;
    
    return [
        'federale' => $taxeFederale,
        'provinciale' => $taxeProvinciale
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erreurs = validerDonnees($_POST);
    
    if (empty($erreurs)) {
        $sousTotal = $_POST['quantite'] * PRIX_UNITAIRE;
        $taxes = calculerTaxes($sousTotal, $_POST['categorie']);
        $total = $sousTotal + $taxes['federale'] + $taxes['provinciale'];
        
        // Affichage du résumé
        echo "<h1>Résumé de la commande</h1>";
        echo "<p>Nom du client : " . htmlspecialchars($_POST['nom_client']) . "</p>";
        echo "<p>Produit : " . htmlspecialchars($_POST['produit']) . "</p>";
        echo "<p>Catégorie : " . htmlspecialchars($_POST['categorie']) . "</p>";
        echo "<p>Quantité : " . htmlspecialchars($_POST['quantite']) . "</p>";
        echo "<p>Sous-total : " . number_format($sousTotal, 2) . " $</p>";
        echo "<p>Taxe fédérale (5%) : " . number_format($taxes['federale'], 2) . " $</p>";
        
        if (estExempte($_POST['categorie'])) {
            echo "<p>Taxe provinciale (9.95%) : Exemptée</p>";
        } else {
            echo "<p>Taxe provinciale (9.95%) : " . number_format($taxes['provinciale'], 2) . " $</p>";
        }
        
        echo "<p>Total TTC : " . number_format($total, 2) . " $</p>";
        echo "<p>Date de livraison : " . htmlspecialchars($_POST['date_livraison']) . "</p>";
        
        // Vérification de la date de livraison
        if (strtotime($_POST['date_livraison']) < strtotime('today')) {
            echo "<p class='error'>Attention : La date de livraison est dans le passé!</p>";
        }
    } else {
        // Affichage des erreurs
        echo "<h2>Erreurs :</h2>";
        foreach ($erreurs as $erreur) {
            echo "<p class='error'>" . $erreur . "</p>";
        }
    }
}
?>