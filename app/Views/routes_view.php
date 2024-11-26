<!-- app/Views/some_page.php -->
<?= $this->extend('Views\side_bare') ?>

<?= $this->section('content') ?>

		<div class="main-container">
			<!-- Checkbox select Datatable End -->
            <!-- Export Datatable start -->
            <div class="card-box mb-30">
				<div class="pd-20">
					<!-- Bouton pour ouvrir la modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRouteModal">
						Add Route
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
					<div class="modal fade" id="addRouteModal" tabindex="-1" role="dialog" aria-labelledby="addRouteModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form id="addRouteForm" method="post" action="<?= base_url('routes/add') ?>">
									<?= csrf_field() ?> <!-- Important si CSRF est activé -->
									<div class="modal-body">
										<div class="form-group">
											<label for="ville_depart">Departure City</label>
											<input type="text" class="form-control" id="ville_depart" name="ville_depart" required>
										</div>
										<div class="form-group">
											<label for="ville_arrivee">Arrival City</label>
											<input type="text" class="form-control" id="ville_arrivee" name="ville_arrivee" required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add Route</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Modale d'édition -->
					<div class="modal fade" id="editRouteModal" tabindex="-1" role="dialog" aria-labelledby="editRouteModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form id="editRouteForm" method="post" action="<?= base_url('routes/update') ?>">
									<?= csrf_field() ?>
									<div class="modal-body">
										<input type="hidden" id="edit_route_id" name="id_route">
										<div class="form-group">
											<label for="edit_ville_depart">Departure City</label>
											<input type="text" class="form-control" id="edit_ville_depart" name="ville_depart" required>
										</div>
										<div class="form-group">
											<label for="edit_ville_arrivee">Arrival City</label>
											<input type="text" class="form-control" id="edit_ville_arrivee" name="ville_arrivee" required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update Route</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Modale de confirmation de suppression -->
					<div class="modal fade" id="deleteRouteModal" tabindex="-1" role="dialog" aria-labelledby="deleteRouteModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form id="deleteRouteForm" method="post" action="<?= base_url('routes/delete') ?>">
									<?= csrf_field() ?>
									<div class="modal-body">
										<input type="hidden" id="delete_route_id" name="id_route">
										<p>Are you sure you want to delete this route?</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-danger">Delete Route</button>
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
                                <th class="table-plus datatable-nosort">Id_Route</th>
                                <th>Departure City</th>
								<th>Arrival City</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php if (!empty($routes)): ?>
								<?php foreach ($routes as $route): ?>
									<tr>
										<td class="table-plus"><?= esc($route['id_route']) ?></td>
										<td><?= esc($route['ville_depart']) ?></td>
										<td><?= esc($route['ville_arrivee']) ?></td>
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
															data-id="<?= esc($route['id_route']) ?>" 
															data-depart="<?= esc($route['ville_depart']) ?>" 
															data-arrive="<?= esc($route['ville_arrivee']) ?>" 
															data-toggle="modal" 
															data-target="#editRouteModal">
														<i class="dw dw-edit2"></i>
														Edit
													</button>
													<button class="dropdown-item" 
															data-id="<?= esc($route['id_route']) ?>" 
															data-toggle="modal" 
															data-target="#deleteRouteModal">
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
						document.getElementById('edit_route_id').value = this.getAttribute('data-id');
						document.getElementById('edit_ville_depart').value = this.getAttribute('data-depart');
						document.getElementById('edit_ville_arrivee').value = this.getAttribute('data-arrive');
					});
				});
			});
		</script>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('.dropdown-item').forEach(function (button) {
					button.addEventListener('click', function () {
						document.getElementById('delete_route_id').value = this.getAttribute('data-id');
					});
				});
			});
		</script>
<?= $this->endSection() ?>

	
	
	