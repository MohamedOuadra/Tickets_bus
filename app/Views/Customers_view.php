<!-- app/Views/some_page.php -->
<?= $this->extend('Views\side_bare') ?>

<?= $this->section('content') ?>

		<div class="main-container">
			<!-- Checkbox select Datatable End -->
            <!-- Export Datatable start -->
            <div class="card-box mb-30">
				<div class="pd-20">
					<!-- Bouton pour ouvrir la modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">
						Add Customer
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
					<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form id="addCustomerForm" method="post" action="<?= base_url('Customers/add') ?>">
									<?= csrf_field() ?> <!-- Important si CSRF est activé -->
									<div class="modal-body">
										<div class="form-group row">
											<label class="col-sm-12 col-md-2 col-form-label">First_name</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="text" id="prenom_client" name="prenom_client">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-12 col-md-2 col-form-label">Last_name</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="text" id="nom_client" name="nom_client">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-12 col-md-2 col-form-label">Phone</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" value="(+212) 6. .. .." type="tel" id="telephone_client" name="telephone_client">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-12 col-md-2 col-form-label">Useranme</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="text" id="email_client" name="email_client">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-12 col-md-2 col-form-label">Password</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="password" id="mot_de_passe" name="mot_de_passe">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add Customer</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Modale d'édition -->
					<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form id="editCustomerForm" method="post" action="<?= base_url('Customers/update') ?>">
									<?= csrf_field() ?>
									<div class="modal-body">
										<input type="hidden" id="edit_Customer_id" name="id_client">
										<div class="form-group row">
											<label class="col-sm-12 col-md-2 col-form-label">First_name</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="text" id="edit_prenom_client" name="prenom_client">
											</div>
										</div>
										<div class="form-group row flow">
											<label class="col-sm-12 col-md-2 col-form-label">Last_name</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="text" id="edit_nom_client" name="nom_client">
											</div>
										</div>
										<div class="form-group row flow">
											<label class="col-sm-12 col-md-2 col-form-label">Phone</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="tel" id="edit_telephone_client" name="telephone_client">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-12 col-md-2 col-form-label">Useranme</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="text" id="edit_email_client" name="email_client">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-12 col-md-2 col-form-label">Password</label>
											<div class="col-sm-12 col-md-10">
												<input class="form-control" type="password" id="edit_mot_de_passe" name="mot_de_passe">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update Customer</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Modale de confirmation de suppression -->
					<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form id="deleteCustomerForm" method="post" action="<?= base_url('Customers/delete') ?>">
									<?= csrf_field() ?>
									<div class="modal-body">
										<input type="hidden" id="delete_Customer_id" name="id_client">
										<p>Are you sure you want to delete this Customer?</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-danger">Delete Customer</button>
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
                                <th class="table-plus datatable-nosort">Id_Customer</th>
                                <th>Last_name</th>
								<th>First_name</th>
								<th>Phone</th>
								<th>Useranme</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php if (!empty($clients)): ?>
								<?php foreach ($clients as $client): ?>
									<tr>
										<td class="table-plus"><?= esc($client['id_client']) ?></td>
										<td><?= esc($client['nom_client']) ?></td>
										<td><?= esc($client['prenom_client']) ?></td>
										<td><?= esc($client['telephone_client']) ?></td>
										<td><?= esc($client['email_client']) ?></td>
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
															data-id="<?= esc($client['id_client']) ?>" 
															data-prenom="<?= esc($client['prenom_client']) ?>" 
															data-nom="<?= esc($client['nom_client']) ?>" 
															data-tele="<?= esc($client['telephone_client']) ?>" 
															data-email="<?= esc($client['email_client']) ?>" 
															data-mdp="<?= esc($client['mot_de_passe']) ?>" 
															data-toggle="modal" 
															data-target="#editCustomerModal">
														<i class="dw dw-edit2"></i>
														Edit
													</button>
													<button class="dropdown-item" 
															data-id="<?= esc($client['id_client']) ?>" 
															data-toggle="modal" 
															data-target="#deleteCustomerModal">
															<i class="dw dw-delete-3"></i>Delete
													</button>
												</div>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="6">No data found</td>
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
						document.getElementById('edit_Customer_id').value = this.getAttribute('data-id');
						document.getElementById('edit_prenom_client').value = this.getAttribute('data-nom');
						document.getElementById('edit_nom_client').value = this.getAttribute('data-nom');
						document.getElementById('edit_telephone_client').value = this.getAttribute('data-tele');
						document.getElementById('edit_email_client').value = this.getAttribute('data-email');
						document.getElementById('edit_mot_de_passe').value = this.getAttribute('data-mdp');
					});
				});
			});
		</script>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('.dropdown-item').forEach(function (button) {
					button.addEventListener('click', function () {
						document.getElementById('delete_Customer_id').value = this.getAttribute('data-id');
					});
				});
			});
		</script>
<?= $this->endSection() ?>

	
	
	