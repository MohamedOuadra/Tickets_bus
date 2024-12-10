<?= $this->extend('Views\side_bare_client') ?>

<?= $this->section('content') ?>

<style>
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
    .bus-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        width: 100%;
        max-width: 1000px;
        transition: transform 0.3s ease;
    }

    .bus-card:hover {
        transform: scale(1.05);
    }

    .bus-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex-grow: 1;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        color: #ff6600;
        border: 1px solid rgba(0, 0, 0, .125);
        border-right: none;
    }

    .card-title {
        font-size: 18px;
        color: #333;
    }

    .card-text {
        font-size: 14px;
        color: #666;
    }

    .card-footer {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
        margin-bottom: 15px;
        border: 1px solid rgba(0, 0, 0, .125);
        border-left: none;
    }

    .card-footer .price {
        font-size: 16px;
        color: #ff6600;
        font-weight: bold;
    }

    .card-footer .duration {
        font-size: 14px;
        color: #777;
    }

    .select-button {
        background-color: #ff6600;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: bold;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .select-button:hover {
        background-color: #e85500;
    }



    body {
        display: flex;
        justify-content: center;
        padding-top: 60px;
        /* align-items: center; */
        height: 100vh;
        margin: 0;
    }

    .search-form {
        display: flex;
        align-items: center;
        background: #fff;
        border: 2px solid #ff6600;
        border-radius: 30px;
        padding: 15px 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        gap: 10px;
        margin-bottom: 30px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    label {
        font-size: 14px;
        font-weight: bold;
        color: #ff6600;
        margin-bottom: 5px;
    }

    select,
    input[type="date"],
    input[type="text"] {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
        width: 250px;
    }

    .search-button {
        background-color: #ff6600;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 10px 20px;
        cursor: pointer;
        font-weight: bold;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .search-button:hover {
        background-color: #e85500;
    }

    .form-group i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #888;
    }

    .input-wrapper {
        position: relative;
    }
</style>
</head>

<body>
<?php if (!empty($routes)): ?>

    <form id="routeDateForm" method="post" action="<?= site_url('/ClientReservation/search'); ?>">
        <div class="search-form">
            <div class="form-group">
                <label for="route">Route</label>
                <select id="route" name="route" class="form-select" required>
                    <option value="">Choisir une route</option>
                    <?php
                    $affichées = [];  // Tableau pour suivre les routes déjà affichées
                    foreach ($routes as $route):
                        // Vérifier si la route a déjà été affichée
                        if (!in_array($route['id_route'], $affichées)):
                            $affichées[] = $route['id_route']; // Ajouter la route à la liste des affichées
                    ?>
                            <option value="<?= $route['id_route']; ?>">
                                <?= $route['ville_depart']; ?> - <?= $route['ville_arrivee']; ?>
                            </option>
                    <?php endif;
                    endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date_depart ">Date de voyage</label>
                <input type="date" id="date_depart" name="date_depart" required>
            </div>
            <button type="submit" class="search-button">Rechercher</button>
        </div>
    </form>


    <!-- Div où les résultats des bus seront affichés -->
    <?php
    $busAffiches = [];  // Tableau pour suivre les bus déjà affichés
    ?>

    <?php if (!empty($BusRoutes)): ?>
        <?php foreach ($BusRoutes as $BusRoute): ?>
            <?php if (!in_array($BusRoute['nom_bus'], $busAffiches)): ?>
                <div class="bus-list">
                    <div class='bus-card'>
                        <div class='bus-info'>
                            <div class='card-header'>
                                <span class='card-title'><?= $BusRoute['nom_bus']; ?></span>
                                <span class='card-text'>Départ : <?= $BusRoute['heure_depart'] ?> &nbsp;&nbsp; - &nbsp;&nbsp; Arrivée : <?= $BusRoute['heure_arrivee'] ?> </span>
                            </div>
                            <p class='card-text'>Ville de départ : <?= $BusRoute['ville_depart'] ?> </p>
                            <input type="hidden" name="id_siege" value="<?= $BusRoute['id_siege']; ?>">
                            <p class='card-text'>Ville d'arrivée : <?= $BusRoute['ville_arrivee'] ?> </p>
                        </div>
                        <div class='card-footer'>
                            <span class='price'> <?= $BusRoute['prix'] ?> DH</span>
                            <form method="post" action="<?= site_url('ClientReservation/showSeats'); ?>">
                                <button type="submit" class="select-button">Sélectionner</button>
                                <input type="hidden" name="id_bus" value="<?= $BusRoute['id_bus']; ?>">
                                <input type="hidden" name="id_route" value="<?= $BusRoute['id_route']; ?>">
                                <input type="hidden" name="date_depart" value="<?= $dateDepart; ?>">

                            </form>
                        </div>
                    </div>
                </div>
                <?php $busAffiches[] = $BusRoute['nom_bus']; ?> <!-- Ajouter le nom du bus au tableau -->
            <?php endif; ?>
        <?php endforeach; ?>
    <?php elseif (!empty($_POST['route'])): ?>
        <!-- Si le formulaire est soumis mais aucune donnée n'est trouvée pour cette route -->
        <p>Aucun bus trouvé pour cette route.</p>
    <?php endif; ?>
<?php endif; ?>


    <div>
    <?php if (!empty($siegereserves)): ?>
        <?php $i = 1; ?>
        <h2 class="mt-5">Liste des sieges</h2>
        <form id="reservationForm" method="POST" action="<?= base_url('/client_reservation/reserveSeat') ?>">
                <div class="grid">
                <script>
                    const grid = document.querySelector('.grid');
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'selected_seat'; // Nom du champ pour le numéro de siège
                    document.querySelector('form').appendChild(hiddenInput); // Ajout du champ caché au formulaire

                    for (let i = 1; i <= 40; i++) {
                        const div = document.createElement('div');
                        div.className = 'case rouge';
                        div.textContent = i;

                        // Ajout d'un écouteur d'événements pour chaque case
                        div.addEventListener('click', function() {
                            // Remplir le champ caché avec le numéro de la case
                            hiddenInput.value = div.textContent;

                            // Si la case n'est pas désactivée, on soumet le formulaire
                            if (!div.classList.contains('disabled')) {
                                document.querySelector('form').submit(); // Soumettre le formulaire
                            }
                        });

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

                                // Si la case devient bleue, on la désactive
                                if (newColorClass === 'bleu') {
                                    caseElement.classList.add('disabled');
                                }
                            }
                        });
                    }
                </script>
            </div>
            <?php 
                $datesAffichees = [];
            ?>
            <?php foreach ($Sieges as $Siege): ?>
                <?php foreach ($siegereserves as $siegereserve): ?>
                    <?php if ($Siege['id_siege'] == $siegereserve['id_siege']): ?>

                        <?php 
                        if (!in_array($siegereserve['date_depart'], $datesAffichees)): 
                            $datesAffichees[] = $siegereserve['date_depart'];?>
                        <?php endif; ?>

                        <script>
                            changeCaseColor(<?= $Siege['numero_siege']; ?>, 'bleu');
                        </script>

                        <input type="hidden" name="id_bus" value="<?= $siegereserve['id_bus']; ?>">
                        <input type="hidden" name="id_siege" value="<?= $siegereserve['id_siege']; ?>">
                        <input type="hidden" name="id_route" value="<?= $siegereserve['id_route']; ?>">
                        <input type="hidden" name="date_depart" value="<?= $siegereserve['date_depart']; ?>">
                        <input type="hidden" name="id_client" value="<?= $siegereserve['id_client']; ?>">
                        <input type="hidden" name="id_siege_reservation" value="<?= $siegereserve['id_siege_reservation']; ?>">

                        

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>

        </form>
    <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Désactiver les dates passées
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date_depart').setAttribute('min', today);

            // Gérer la soumission du formulaire
            document.querySelector('.search-button').addEventListener('click', function(e) {
                e.preventDefault();

                const route = document.getElementById('route').value;
                const date = document.getElementById('date_depart').value;

                if (!route || !date) {
                    alert('Veuillez remplir tous les champs avant de rechercher.');
                    return;
                }

                // Proceed with the form submission or any other action you want to take
                // Optionally, you could submit the form or make an AJAX request here.
                document.querySelector('form').submit(); // Submit the form if necessary
            });
        });
    </script>






<?= $this->endSection() ?>