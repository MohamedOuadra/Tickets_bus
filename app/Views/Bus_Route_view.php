<?= $this->extend('Views\side_bare') ?>

<?= $this->section('content') ?>
	<div class="main-container">
		<!-- Checkbox select Datatable End -->
		<!-- Export Datatable start -->
		<div class="card-box mb-30">
			<div class="pd-20">
				<!-- Bouton pour ouvrir la modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBusRouteModal">
					Add Bus_Route
				</button>

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

				<!-- Modal contenant le formulaire -->
				<div class="modal fade" id="addBusRouteModal" tabindex="-1" role="dialog" aria-labelledby="addBusRouteModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form id="addBusRouteForm" method="post" action="<?= base_url('bus_route/add') ?>">
								<?= csrf_field() ?> <!-- Important si CSRF est activé -->
								<div class="modal-body">
									<div class="form-group row">
										<div class="col-sm-12 col-md-10">
											<select name="id_route" id="id_route" class="custom-select col-12">
												<?php if (!empty($routes)): ?>
													<option selected="">Choose A Route</option>
													<?php foreach ($routes as $route): ?>
														<option value="<?= esc($route['id_route']) ?>"><?= esc($route['ville_depart'] . ' - ' . $route['ville_arrivee']) ?></option>
													<?php endforeach; ?>
												<?php else: ?>
													<tr>
														<td colspan="6">Aucune donnée trouvée</td>
													</tr>
												<?php endif; ?>
											</select>
										</div>	
									</div>
									<div class="form-group row">
										<div class="col-sm-12 col-md-10">
											<select name="id_bus" id="id_bus" class="custom-select col-12">
												<?php if (!empty($buses)): ?>
													<option selected="">Choose A Bus</option>
													<?php foreach ($buses as $bus): ?>
														<option value="<?= esc($bus['id_bus']) ?>"><?= esc($bus['nom_bus']) ?></option>
													<?php endforeach; ?>
												<?php else: ?>
													<tr>
														<td colspan="6">Aucune donnée trouvée</td>
													</tr>
												<?php endif; ?>
											</select>
										</div>	
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">Departure_time</label>
										<div class="col-sm-12 col-md-10">
											<input class="form-control time-picker" id="heure_depart" name="heure_depart" placeholder="Select time" type="text">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">Arrival_time</label>
										<div class="col-sm-12 col-md-10">
											<input class="form-control time-picker" id="heure_arrivee" name="heure_arrivee" placeholder="Select time" type="text">
										</div>
									</div>
									<div class="form-group">
										<label for="ville_arrivee">Cost</label>
										<input type="number" class="form-control" id="prix" name="prix" required>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Add Bus_Route</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Modale d'édition -->
				<div class="modal fade" id="editBusRouteModal" tabindex="-1" role="dialog" aria-labelledby="editBusRouteModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form id="editBusRouteForm" method="post" action="<?= base_url('bus_route/update') ?>">
								<?= csrf_field() ?>
								<div class="modal-body">
									<input type="hidden" id="edit_bus_route_id" name="id_bus_route">
									<div class="form-group row">
										<div class="col-sm-12 col-md-10">
											<select name="id_route" id="edit_route_name" class="custom-select col-12">
												<?php if (!empty($routes)): ?>
													<option selected="">Choose A Route</option>
													<?php foreach ($routes as $route): ?>
														<option value="<?= esc($route['id_route']) ?>"><?= esc($route['ville_depart'] . ' - ' . $route['ville_arrivee']) ?></option>
													<?php endforeach; ?>
												<?php else: ?>
													<tr>
														<td colspan="6">Aucune donnée trouvée</td>
													</tr>
												<?php endif; ?>
											</select>
										</div>	
									</div>
									<div class="form-group row">
										<div class="col-sm-12 col-md-10">
											<select name="id_bus" id="edit_bus_name" class="custom-select col-12">
												<?php if (!empty($buses)): ?>
													<option selected="">Choose A Bus</option>
													<?php foreach ($buses as $bus): ?>
														<option value="<?= esc($bus['id_bus']) ?>"><?= esc($bus['nom_bus']) ?></option>
													<?php endforeach; ?>
												<?php else: ?>
													<tr>
														<td colspan="6">Aucune donnée trouvée</td>
													</tr>
												<?php endif; ?>
											</select>
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
				</div>
				<!-- Modale de confirmation de suppression -->
				<div class="modal fade" id="deleteBusRouteModal" tabindex="-1" role="dialog" aria-labelledby="deleteBusRouteModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form id="deleteBusRouteForm" method="post" action="<?= base_url('bus_route/delete') ?>">
								<?= csrf_field() ?>
								<div class="modal-body">
									<input type="hidden" id="delete_bus_route_id" name="id_bus_route">
									<p>Are you sure you want to delete this bus_route?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-danger">Delete Bus_Route</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="pb-20">
				<table
					class="table hover multiple-select-row data-table-export nowrap"
				>
					<thead>
						<tr>
							<th class="table-plus datatable-nosort">Id_Bus_Route</th>
							<th>Bus</th>
							<th>Route</th>
							<th>Heure_Depart</th>
							<th>Heure_Arrivee</th>
							<th>Cost</th>
							<th class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($bus_routes)): ?>
							<?php foreach ($bus_routes as $bus_route): ?>
								<tr>
								<td class="table-plus"><?= esc($bus_route['id_bus_route']) ?></td>
								<td><?= esc($bus_route['nom_bus']) ?></td>
								<td><?= esc($bus_route['ville_depart'] . ' - ' . $bus_route['ville_arrivee']) ?></td>
								<td><?= esc($bus_route['heure_depart']) ?></td>
								<td><?= esc($bus_route['heure_arrivee']) ?></td>
								<td><?= esc($bus_route['prix']) ?> DH</td>	
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
										<button class="dropdown-item"
												data-id="<?= esc($bus_route['id_bus_route']) ?>" 
												data-id-bus="<?= esc($bus_route['id_bus']) ?>" 
												data-id-route="<?= esc($bus_route['id_route']) ?>" 
												data-depart="<?= esc($bus_route['heure_depart']) ?>" 
												data-arrivee="<?= esc($bus_route['heure_arrivee']) ?>" 
												data-cost="<?= esc($bus_route['prix']) ?>" 
												data-toggle="modal" 
												data-target="#editBusRouteModal">
											<i class="dw dw-edit2"></i> Edit
										</button>
										<button class="dropdown-item" 
											data-id="<?= esc($bus_route['id_bus_route']) ?>" 
											data-toggle="modal" 
											data-target="#deleteBusRouteModal">
											<i class="dw dw-delete-3"></i>Delete
										</button>
											
										</div>
									</div>
								</td>								
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="6">Aucune donnée trouvée</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
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
	</script>
	
<?= $this->endSection() ?>
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
										<button class="dropdown-item"
												data-id="<?= esc($bus_route['id_bus_route']) ?>" 
												data-id-bus="<?= esc($bus_route['id_bus']) ?>" 
												data-id-route="<?= esc($bus_route['id_route']) ?>" 
												data-depart="<?= esc($bus_route['heure_depart']) ?>" 
												data-arrivee="<?= esc($bus_route['heure_arrivee']) ?>" 
												data-cost="<?= esc($bus_route['prix']) ?>" 
												data-toggle="modal" 
												data-target="#editBusRouteModal">
											<i class="dw dw-edit2"></i> Edit
										</button>
										<button class="dropdown-item" 
											data-id="<?= esc($bus_route['id_bus_route']) ?>" 
											data-toggle="modal" 
											data-target="#deleteBusRouteModal">
											<i class="dw dw-delete-3"></i>Delete
										</button>
											
										</div>
									</div>
								</td>