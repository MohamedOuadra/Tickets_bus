<?= $this->extend('Views\side_bare') ?>

<?= $this->section('content') ?>

    <div class="main-container">

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
                background: linear-gradient(45deg, #188800, #0ed600);
            }
            .bleu {
                background: linear-gradient(45deg, #ff9d9d, #da4441);
            }
            .legend {
                margin-top: 20px;
            }

            .legend-item {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }

            .legend-color {
                width: 20px;
                height: 20px;
                margin-right: 10px;
                border-radius: 5px;
            }
            /* .case:hover {
                transform: scale(1.1);
                transition: transform 0.2s ease;
            } */
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
                color: #0b132b;
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
                color: #0b132b;
                font-weight: bold;
            }

            .card-footer .duration {
                font-size: 14px;
                color: #777;
            }

            .select-button {
                background-color: #0b132b;
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
                background-color:#0b132b;
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
                border: 2px solid #0b132b;
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
                color: #0b132b;
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
                background-color: #0b132b;
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
                background-color:#0b132b;
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
        <div class="container mt-5">
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger"><?= session()->get('error') ?></div>
            <?php endif; ?>

            <!-- Formulaire pour sélectionner une route -->
            <form id="routeDateForm" method="post" action="<?= site_url('sieges/showbus'); ?>">
                <div class="search-form">
                    <div class="form-group">
                        <label for="route" >Select a Route</label>
                        <select id="route" name="route" class="form-select" required>
                            <option value="">Choose a route</option>
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
                    <div class="form-group">
                        <label for="date_depart" >Departure Date</label>
                        <input type="date" id="date_depart" name="date_depart"  required>
                    </div>
                    <button type="submit" class="search-button">Search</button>

                </div>
            </form>

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
                                        <span class='card-text'>Departure : <?= $BusRoute['heure_depart'] ?> &nbsp;&nbsp; - &nbsp;&nbsp; Arrival : <?= $BusRoute['heure_arrivee'] ?> </span>
                                    </div>
                                    <p class='card-text'>Departure City : <?= $BusRoute['ville_depart'] ?> </p>
                                    <input type="hidden" name="id_siege" value="<?= $BusRoute['id_siege']; ?>">
                                    <p class='card-text'>Arrival City : <?= $BusRoute['ville_arrivee'] ?> </p>
                                </div>
                                <div class='card-footer'>
                                    <span class='price'> <?= $BusRoute['prix'] ?> DH</span>
                                    <form method="post" action="<?= site_url('sieges/showsiege'); ?>">
                                        <button type="submit" class="select-button">Select</button>
                                        <input type="hidden" name="id_bus" value="<?= $BusRoute['id_bus']; ?>">
                                        <input type="hidden" name="id_siege" value="<?= $BusRoute['id_siege']; ?>">
                                        <input type="hidden" name="id_route" value="<?= $BusRoute['id_route']; ?>">
                                        <input type="hidden" name="date_depart" value="<?= $BusRoute['date_depart']; ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php $busAffiches[] = $BusRoute['nom_bus']; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php elseif (!empty($_POST['route'])): ?>
                <!-- Si le formulaire est soumis mais aucune donnée n'est trouvée pour cette route -->
                <p>No buses found for this route.</p>
            <?php endif; ?>

            <?php if (!empty($siegereserves)): ?>
                <?php $i = 1; ?>
                <h2 class="mt-5">List of seats</h2>
                <!-- Légende -->
                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-color rouge"></div>
                        <span>Not Reserved</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color bleu"></div>
                        <span>Reserved</span>
                    </div>
                </div>
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
    </div>
<?= $this->endSection() ?>