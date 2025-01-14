<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de commande</title>
</head>
<body>
    <form action="traitement_commande.php" method="POST">
        <div class="form-group">
            <label for="nom_client">Nom du client:</label>
            <input type="text" id="nom_client" name="nom_client" required>
        </div>

        <div class="form-group">
            <label for="produit">Produit:</label>
            <input type="text" id="produit" name="produit" required>
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie:</label>
            <select id="categorie" name="categorie" required>
                <option value="">Sélectionnez une catégorie</option>
                <option value="noAlcWine">Vins non alcoolisés</option>
                <option value="babyProducts">Produits pour bébés</option>
                <option value="toys">Produits pour bébés</option>
                <option value="newElectricCars">Voitures électriques neuves</option>
                <option value="others">Autres</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantite">Quantité:</label>
            <input type="number" id="quantite" name="quantite" min="1" required>
        </div>

        <div class="form-group">
            <label for="date_livraison">Date de livraison:</label>
            <input type="date" id="date_livraison" name="date_livraison" required>
        </div>

        <button type="submit">Calculer la commande</button>
    </form>    
    <?php
        // logique php
    ?>
</body>
</html>