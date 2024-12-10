<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Bookings</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
    />
    <!-- Font-awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->

    <?php 
        require 'style_home.php'
    ?>
    <style>
        .card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
        }

        .card-body {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
        }

        .modal-header {
            border-bottom: 2px solid #6c757d;
        }

        .modal-footer {
            border-top: 2px solid #6c757d;
        }

        .fw-bold {
            color: #495057;
        }

    </style>

</head>
<body>
    <?php if (!empty($reservations)): ?>
        <div class="modal fade show" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true" style="display: block;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="reservationModalLabel">Détails de la Réservation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($reservations as $reservation): ?>
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Ticket Bus :</div>
                                        <div class="col-sm-8"><?= $reservation['ticket_code'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Customer :</div>
                                        <div class="col-sm-8"><?= $reservation['nom_client'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Phone Number :</div>
                                        <div class="col-sm-8"><?= $reservation['telephone_client'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Bus Name :</div>
                                        <div class="col-sm-8"><?= $reservation['nom_bus'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Route Name :</div>
                                        <div class="col-sm-8"><?= $reservation['ville_depart'] . ' --> ' . $reservation['ville_arrivee'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Seat :</div>
                                        <div class="col-sm-8"><?= $reservation['numero_siege'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Cost :</div>
                                        <div class="col-sm-8"><?= number_format($reservation['prix'], 2) ?> MAD</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Date Depart :</div>
                                        <div class="col-sm-8"><?= $reservation['date_depart'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4 fw-bold">Date Reservation :</div>
                                        <div class="col-sm-8"><?= $reservation['date_reservation'] ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


    
    <header>
        <nav>
            <ul>
                <li><a href="#" class="nav-item">Home</a></li>
                <li><a href="#about" class="nav-item">About</a></li>
            </ul>
            <div>
                <a href="<?= base_url('auth/login') ?>" class="login nav-item" ><i class="fas fa-sign-in-alt" style="margin-right: 0.4rem;"></i>Login</a>
                <a href="#pnr-enquiry" class="pnr nav-item">PNR Enquiry</a>
            </div>
        </nav>
    </header>
    

    <section class="home">
        <div id="route-search-form">
            <h1>Simple Bus Ticket Booking System</h1>

            <p class="text-center">Welcome to Simple Bus Ticket Booking System. Login now to manage bus tickets and much more. OR, simply scroll down to check the Ticket status using Passenger Name Record (PNR number)</p>
            <br>
            <center>
            <a href="#pnr-enquiry"><button class="btn btn-primary">Scroll Down <i class="fa fa-arrow-down"></i></button></a>
            </center>
            
        </div>
    </section>
    <div id="block">
        <section id="pnr-enquiry">
            <div id="pnr-form">
                <h2>PNR ENQUIRY</h2>
                <form action="<?= base_url('home_pnr/show_pnr') ?>" method="POST">
                    <div>
                        <input type="text" name="pnr" id="pnr" placeholder="Enter PNR">
                    </div>
                    <button type="submit" name="pnr-search" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">Submit</button>
                </form>
            </div>
        </section>
        <section id="about">
            <div>
                <h1>About Us</h1>
                <h4>Wanna know were it all started?</h4>
                <p>
                    Lorem ipsum dolor sit amet consecteturadipisicing elit. Perferendis soluta voluptas eaque, numquam veritatis aperiam expedita deleniti, nesciunt cum alias velit. Cupiditate commodi
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus cum nisi ea optio unde aliquam quia reprehenderit atque eum tenetur! 
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed placeat debitis corporis voluptates modi quibusdam quidem voluptatibus illum, maiores sequi.
                </p>
            </div>
        </section>
        <footer>
            <p>
                <i class="far fa-copyright"></i> <?php echo date('Y');?> - Simple Bus Ticket Booking System | Made with &#10084;&#65039; by Students_Licence_Excellence
            </p>
        </footer>
    </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- External JS -->
    <script src="<?= base_url('scripts\main.js') ?>"></script>
    <script>
        // Automatically show the modal
        var reservationModal = new bootstrap.Modal(document.getElementById('reservationModal'), {});
        reservationModal.show();
    </script>
</body>
</html>