<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche des Bus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #e3f2fd, #e1bee7);
            font-family: 'Arial', sans-serif;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(8, 60px);
            grid-gap: 10px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .case {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
            font-size: 20px;
            font-weight: bold;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        .vert {
            background: linear-gradient(45deg, #43a047, #66bb6a);
        }
        .rouge {
            background: linear-gradient(45deg, #e53935, #ef5350);
        }
        .case:hover {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestion des Réservations de Sièges</h1>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger"><?= session()->get('error') ?></div>
        <?php endif; ?>

        <!-- Formulaire pour sélectionner une route -->
        <form id="routeDateForm" method="post" action="<?= site_url('sieges/showbus'); ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="route" class="form-label">Sélectionnez une Route</label>
                    <select id="route" name="route" class="form-select" required>
                        <option value="">Choisir une route</option>
                        <?php 
                        $affichées = [];  // Tableau pour suivre les routes déjà affichées
                        foreach ($SiegeReservations as $SiegeReservation): 
                            // Vérifier si la route a déjà été affichée
                            if (!in_array($SiegeReservation['id_route'], $affichées)): 
                                $affichées[] = $SiegeReservation['id_route']; // Ajouter la route à la liste des affichées
                        ?>
                            <option value="<?= $SiegeReservation['id_route']; ?>">
                                <?= $SiegeReservation['ville_depart']; ?> - <?= $SiegeReservation['ville_arrivee']; ?>
                            </option>
                        <?php endif; endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="date_depart" class="form-label">Date de Départ</label>
                    <input type="date" id="date_depart" name="date_depart" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php 
        $busAffiches = [];  // Tableau pour suivre les bus déjà affichés
        ?>

        <?php if (!empty($BusRoutes)): ?>
            <h2 class="mt-5">Liste des Bus</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom du Bus</th>
                        <th>Voir les Sièges</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($BusRoutes as $BusRoute): ?>
                        <?php if (!in_array($BusRoute['nom_bus'], $busAffiches)): ?>
                            <tr>
                                <td><?= $BusRoute['nom_bus']; ?></td>
                                <td>
                                    <form method="post" action="<?= site_url('sieges/showsiege'); ?>">
                                        <button type="submit" class="btn btn-info">Voir les sièges</button>
                                        <input type="hidden" name="id_bus" value="<?= $BusRoute['id_bus']; ?>">
                                        <input type="hidden" name="id_siege" value="<?= $BusRoute['id_siege']; ?>">
                                        <input type="hidden" name="id_route" value="<?= $BusRoute['id_route']; ?>">
                                        <input type="hidden" name="date_depart" value="<?= $BusRoute['date_depart']; ?>">
                                    </form>
                                </td>
                            </tr>
                            <?php $busAffiches[] = $BusRoute['nom_bus']; ?>  <!-- Ajouter le nom du bus au tableau -->
                            <!-- <div class="grid">
                                <script>
                                    const grid = document.querySelector('.grid');
                                    for (let i = 1; i <= 40; i++) {
                                        const div = document.createElement('div');
                                        div.className = 'case ' + (i <= 20 ? 'vert' : 'rouge');
                                        div.textContent = i;
                                        grid.appendChild(div);
                                    }
                                </script>
                            </div> -->
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        <?php elseif (!empty($_POST['route'])): ?>
            <!-- Si le formulaire est soumis mais aucune donnée n'est trouvée pour cette route -->
            <p>Aucun bus trouvé pour cette route.</p>
        <?php endif; ?>

        <?php if (!empty($siegereserves)): ?>
            <?php $i = 1; ?>
            <h2 class="mt-5">Liste des sieges</h2>
            <div class="grid">
                <script>
                    const grid = document.querySelector('.grid');
                    for (let i = 1; i <= 40; i++) {
                        const div = document.createElement('div');
                        div.className = 'case ' + ('rouge');
                        div.textContent = i;
                        grid.appendChild(div);
                    }
                    function changeCaseColor(numero, newColorClass) {
                        const cases = document.querySelectorAll('.case');
                        cases.forEach((caseElement) => {
                            if (caseElement.textContent == numero) {
                                // Supprimer les anciennes classes de couleur
                                caseElement.classList.remove('vert', 'rouge', 'bleu');
                                // Ajouter la nouvelle classe de couleur
                                caseElement.classList.add(newColorClass);
                            }
                        });
                    }
                </script>
            </div>
            <?php foreach ($Sieges as $Siege): ?>
                <?php foreach ($siegereserves as $siegereserve): ?>
                    <?php if ($Siege['id_siege'] == $siegereserve['id_siege']): ?>
                        <script>
                            changeCaseColor(<?= $Siege['numero_siege']; ?>, 'bleu');
                        </script>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

</body>
</html>
