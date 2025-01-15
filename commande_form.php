<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de commande</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="traitement_commande.php" method="POST">
            <div class="row">
                <div class="col-25">
                <label for="nom_client">Nom du client:</label>
                </div>
            <div class="col-75">
                <input type="text" id="nom_client" name="nom_client" required>
            </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="produit">Produit:</label>
                </div>
            <div class="col-75">
                <input type="text" id="produit" name="produit" required>
                </div>
            </div>

            <div class="row">
            <div class="col-25">
                <label for="categorie">Catégorie:</label>
                </div>
                <div class="col-75">
                <select id="categorie" name="categorie" required>
                    <option value="">Sélectionnez une catégorie</option>
                    <option value="noAlcWine">Vins non alcoolisés</option>
                    <option value="babyProducts">Produits pour bébés</option>
                    <option value="toys">Produits pour bébés</option>
                    <option value="newElectricCars">Voitures électriques neuves</option>
                    <option value="others">Autres</option>
                </select>
                </div>
                </div>
            

                <div class="row">
                <div class="col-25">
                <label for="quantite">Quantité:</label>
                </div>
                <div class="col-75">
                <input type="number" id="quantite" name="quantite" min="1" required>
                </div>
                </div>

                <div class="row">
                <div class="col-25">
                <label for="date_livraison">Date de livraison:</label>
                </div>
                <input type="date" id="date_livraison" name="date_livraison" required>
                </div>
                </div>
                <br>
            <div class="row">
            <input type="submit" value="Submit">
            </div>
        </form>    
    </div>
</body>
</html>