<!-- app/Views/some_page.php -->
<?= $this->extend('Views\side_bare') ?>

<?= $this->section('content') ?>
<style>
	.card-box {
    border-radius: 10px; /* Bordures arrondies */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
}

.card-box:hover {
    transform: translateY(-5px); /* Légère élévation */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    background-color: #f4f4f4; /* Couleur de fond */
}

.card-box .widget-icon i {
    font-size: 30px;
    transition: color 0.3s ease;
}



</style>
		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">
				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= esc($count_bus) ?></div>
									<div class="font-14 text-secondary weight-500">
										Buses
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ffebcd">
										<i class="icon-copy dw dw-bus"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= esc($count_route) ?></div>
									<div class="font-14 text-secondary weight-500">
										Routes
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ada0ad">
										<i class="icon-copy ion-android-film"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= esc($count_bus_route) ?></div>
									<div class="font-14 text-secondary weight-500">
										Buses_Route
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#3efaff">
										<span class="icon-copy ti-control-shuffle"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= esc($count_reservation) ?></div>
									<div class="font-14 text-secondary weight-500">
										Bookings
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#e1e757">
										<i class="icon-copy dw dw-calendar1"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= esc($count_siege) ?></div>
									<div class="font-14 text-secondary weight-500">
										Seats
									</div>
									<!-- <div class="weight-700 font-24 text-dark"><?= esc($count_siegereservation) ?></div>
									<div class="font-14 text-secondary weight-500">
										Seats_reservations
									</div> -->
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff90d4">
										<i class="icon-copy dw dw-bench"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= esc($count_client) ?></div>
									<div class="font-14 text-secondary weight-500">
										Customers
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon">
										<i class="icon-copy dw dw-user1"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= esc($earning)?> DH</div>
									<div class="font-14 text-secondary weight-500">Earnings</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i class="icon-copy fa fa-money" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?= $this->endSection() ?>