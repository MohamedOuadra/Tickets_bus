<?= $this->extend('Views\side_bare') ?>

<?= $this->section('content') ?>
	<div class="main-container">
		<!-- Checkbox select Datatable End -->
		<!-- Export Datatable start -->
		<div class="card-box mb-30">
			<div class="pd-20">

				<!-- Affichage des messages de succès ou d'erreur -->
				<?php if (session()->getFlashdata('success')): ?>
					<div class="alert alert-success" role="alert">
						<?= session()->getFlashdata('success') ?>
					</div>
				<?php endif; ?>

				<?php if (session()->getFlashdata('error')): ?>
					<div class="alert alert-danger" role="alert">
						<?= session()->getFlashdata('error') ?>
					</div>
				<?php endif; ?>

				<!-- Modale d'édition -->
				<!-- <div class="modal fade" id="editReservationModal" tabindex="-1" role="dialog" aria-labelledby="editReservationModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form id="editReservationForm" method="post" action="<?= base_url('Reservation/update') ?>">
								<?= csrf_field() ?>
								<div class="modal-body">
									<input type="hidden" id="edit_Reservation_id" name="id_reservation">
									<div class="form-group row">
                                    <th>Customers</th>
                                    <th>Phone Number</th>
                                    <th>Bus Name</th>
                                    <th>Route Name</th>
                                    <th>number_of_Seat</th>
                                    <th>Cost</th>
                                    <th>Date_Depart</th>
                                    <th>Date_Reservation</th>
                                    'id_siege' => $this->request->getPost('id_siege'),
                                    'id_client' => $this->request->getPost('id_client'),
                                    'id_route' => $this->request->getPost('id_route'),
                                    'ticket_code' => $this->request->getPost('ticket_code'),
                                    'date_reservation' => $this->request->getPost('date_reservation'),
										<div class="col-sm-12 col-md-10">
                                            <label class="col-sm-12 col-md-2 col-form-label">First_name</label>
											<input class="form-control" type="text" id="edit_name_client" name="id_client" >
										</div>	
									</div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-10">
                                            <label class="col-sm-12 col-md-2 col-form-label">Last_name</label>
											<input class="form-control" type="text" id="edit_prenom_client" name="id_client" >
										</div>	
									</div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-10">
                                            <label class="col-sm-12 col-md-2 col-form-label">Phone</label>
											<input class="form-control" type="tel" id="edit_telephone_client" name="id_client" >
										</div>	
									</div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-10">
                                            <label class="col-sm-12 col-md-2 col-form-label">First_name</label>
											<input class="form-control" type="text" id="edit_prenom_client" name="id_client" >
										</div>	
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">Departure_time</label>
										<div class="col-sm-12 col-md-10">
											<input class="form-control time-picker" id="edit_heure_depart" name="heure_depart" placeholder="Select time" type="text">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">Arrival_time</label>
										<div class="col-sm-12 col-md-10">
											<input class="form-control time-picker" id="edit_heure_arrivee" name="heure_arrivee" placeholder="Select time" type="text">
										</div>
									</div>
									<div class="form-group">
										<label for="ville_arrivee">Cost</label>
										<input type="number" class="form-control" id="edit_cost" name="prix" required>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Update Bus_Route</button>
								</div>
							</form>
						</div>
					</div>
				</div> -->
				<!-- Modale de confirmation de suppression -->
				<!-- <div class="modal fade" id="deleteReservationModal" tabindex="-1" role="dialog" aria-labelledby="deleteReservationModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form id="deleteReservationForm" method="post" action="<?= base_url('Reservation/delete') ?>">
								<?= csrf_field() ?>
								<div class="modal-body">
									<input type="hidden" id="delete_Reservation_id" name="id_reservation">
									<p>Are you sure you want to delete this booking?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-danger">Delete booking</button>
								</div>
							</form>
						</div>
					</div>
				</div> -->
			</div>
			<div class="pb-20">
				<table
					class="table hover multiple-select-row data-table-export nowrap"
				>
					<thead>
						<tr>
                        <th class="table-plus datatable-nosort">Ticket_bus</th>
							<th>Customers</th>
							<th>Phone Number</th>
							<th>Bus Name</th>
							<th>Route Name</th>
							<th>Seat</th>
							<th>Cost</th>
							<th>Date_Depart</th>
							<th>Date_Reservation</th>
							<!-- <th class="datatable-nosort">Action</th> -->
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($reservations as $reservation): ?>
							<tr>
								<td><?= $reservation['ticket_code'] ?></td>
								<td><?= $reservation['nom_client'] ?></td>
								<td><?= $reservation['telephone_client'] ?></td>
								<td><?= $reservation['nom_bus'] ?></td>
								<td><?= $reservation['ville_depart'] . ' --> ' . $reservation['ville_arrivee'] ?></td>
								<td><?= $reservation['numero_siege'] ?></td>
								<td><?= $reservation['prix']?></td> 
								<td><?= $reservation['date_depart']?></td> 
								<td><?= $reservation['date_reservation'] ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
	<!-- <script>
		document.addEventListener('DOMContentLoaded', function () {
			document.querySelectorAll('.dropdown-item').forEach(function (button) {
				button.addEventListener('click', function () {
					// Récupérer les données depuis les attributs data-*
					const idBusRoute = this.getAttribute('data-id');
					const idBus = this.getAttribute('data-id-bus');
					const idRoute = this.getAttribute('data-id-route');
					const heureDepart = this.getAttribute('data-depart');
					const heureArrivee = this.getAttribute('data-arrivee');
					const prix = this.getAttribute('data-cost');

					// Remplir les champs du modal
					document.getElementById('edit_bus_route_id').value = idBusRoute;
					document.getElementById('edit_heure_depart').value = heureDepart;
					document.getElementById('edit_heure_arrivee').value = heureArrivee;
					document.getElementById('edit_cost').value = prix;

					// Sélectionner les bonnes options dans les listes déroulantes
					const busSelect = document.getElementById('edit_bus_name');
					const routeSelect = document.getElementById('edit_route_name');

					if (busSelect) {
						busSelect.value = idBus;
					}

					if (routeSelect) {
						routeSelect.value = idRoute;
					}
				});
			});
		});

	</script>
	<script>
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('.dropdown-item').forEach(function (button) {
					button.addEventListener('click', function () {
						document.getElementById('delete_bus_route_id').value = this.getAttribute('data-id');
					});
				});
			});
	</script> -->
	
<?= $this->endSection() ?>
