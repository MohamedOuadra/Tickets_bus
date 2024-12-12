<?= $this->extend('Views\side_bare_client') ?>

<?= $this->section('content') ?>
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
            cursor: pointer; /* Pour indiquer que la case est cliquable */
        }
        .vert {
            background: linear-gradient(45deg, #43a047, #66bb6a);
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
        .rouge {
            background: linear-gradient(45deg, #188800, #0ed600);
        }
        .bleu {
            background: #b0bec5; /* Couleur grise pour la désactivation */
        }
        .disabled {
            background: #b0bec5; /* Couleur grise pour la désactivation */
            cursor: not-allowed; /* Modifie le curseur pour indiquer que l'élément est désactivé */
            pointer-events: none; /* Désactive les événements de clic */
        }
        .case:hover {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }
    </style>
</head>
<body>
    <div>
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
                <form method="POST" action="<?= base_url('reservations/update_siege') ?>">
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
                                <input type="hidden" name="id_client" value="<?= $id_client ?>">
                                <input type="hidden" name="id_siege_reservation" value="<?= $siegereserve['id_siege_reservation']; ?>">

                                <?php foreach ($reservation_currents as $reservation_current): ?>
                                    <input type="hidden" name="id_reservation_current" value="<?= $reservation_current['id_reservation']; ?>">
                                <?php endforeach; ?>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>

                </form>
        <?php endif; ?>

    </div>
    <?= $this->endSection() ?>

