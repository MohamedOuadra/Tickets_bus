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
							<th>Departure_Date</th>
							<th>Reservation_Date</th>
							<th class="datatable-nosort">Action</th>
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
								<td>
									<div class="dropdown">
										<a
											class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
											href="#"
											role="button"
											data-toggle="dropdown"
										>
											<i class="dw dw-more"></i>
										</a>
										<div
											class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
										>
										<form id="editReservationForm" method="post" action="<?= base_url('Reservation/update') ?>">
											<input type="hidden" name="id_bus" value="<?= $reservation['id_bus']; ?>">
											<input type="hidden" name="id_siege" value="<?= $reservation['id_siege']; ?>">
											<input type="hidden" name="id_route" value="<?= $reservation['id_route']; ?>">
											<input type="hidden" name="date_depart" value="<?= $reservation['date_depart']; ?>">											
											<input type="hidden" name="id_client" value="<?= $reservation['id_client']; ?>">
											<input type="hidden" name="id_reservation" value="<?= $reservation['id_reservation']; ?>">
											<button class="dropdown-item" type="submit">
												<i class="dw dw-edit2"></i> Edit
											</button>
										</form>
										<form id="deleteReservationForm" method="post" action="<?= base_url('Reservation/delete') ?>">
											<input type="hidden" value="<?= $reservation['id_reservation'] ?>" name="id_reservation">
											<button class="dropdown-item" type="submit" >
												<i class="dw dw-delete-3"></i>Delete
											</button>
										</form>
											
										</div>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
		
<?= $this->endSection() ?>
