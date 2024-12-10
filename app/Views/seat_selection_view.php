<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seats</title>
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

        <?php echo $id_bus; ?>
        <?php echo $id_route; ?>
        <?php echo $date_depart; ?>

    <div class="container mt-5">
        <h1 class="mb-4">Gestion des Réservations de Sièges</h1>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger"><?= session()->get('error') ?></div>
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


        <?php echo $id_bus; ?>
        <?php echo $id_route; ?>
        <?php echo $date_depart; ?>


    </div>

</body>
</html>
