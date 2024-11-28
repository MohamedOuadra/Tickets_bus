<?= $this->extend('Views\side_bare') ?>

<?= $this->section('content') ?>
    <div class="main-container">
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <!-- Bouton pour ouvrir la modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBusModal">
                Add Bus
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
                <div class="modal fade" id="addBusModal" tabindex="-1" role="dialog" aria-labelledby="addBusModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="addBusForm" method="post" action="<?= base_url('buses/add') ?>">
                                <?= csrf_field() ?> <!-- Important si CSRF est activé -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nom_bus">Bus Name</label>
                                        <input type="text" class="form-control" id="nom_bus" name="nom_bus" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre_sieges">number of seats</label>
                                        <input type="number" class="form-control" id="nombre_sieges" name="nombre_sieges" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Bus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modale d'édition -->
                <div class="modal fade" id="editBusModal" tabindex="-1" role="dialog" aria-labelledby="editBusModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="editBusForm" method="post" action="<?= base_url('buses/update') ?>">
                                <?= csrf_field() ?>
                                <div class="modal-body">
                                    <input type="hidden" id="edit_bus_id" name="id_bus">
                                    <div class="form-group">
                                        <label for="edit_name_bus">Bus Name</label>
                                        <input type="text" class="form-control" id="edit_name_bus" name="nom_bus" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_nombre_sieges">number of seats</label>
                                        <input type="number" class="form-control" id="edit_nombre_sieges" name="nombre_sieges" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Bus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modale de confirmation de suppression -->
                <div class="modal fade" id="deleteBusModal" tabindex="-1" role="dialog" aria-labelledby="deleteBusModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="deleteBusForm" method="post" action="<?= base_url('buses/delete') ?>">
                                <?= csrf_field() ?>
                                <div class="modal-body">
                                    <input type="hidden" id="delete_Bus_id" name="id_bus">
                                    <p>Are you sure you want to delete this Bus?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete Bus</button>
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
                            <th class="table-plus datatable-nosort">id_bus</th>
                            <th>Bus Name</th>
                            <th>number of seats</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($buses)): ?>
                            <?php foreach ($buses as $buse): ?>
                                <tr>
                                    <td class="table-plus"><?= esc($buse['id_bus']) ?></td>
                                    <td><?= esc($buse['nom_bus']) ?></td>
                                    <td><?= esc($buse['nombre_sieges']) ?></td>
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
                                                        data-id="<?= esc($buse['id_bus']) ?>" 
                                                        data-bus="<?= esc($buse['nom_bus']) ?>" 
                                                        data-sieges="<?= esc($buse['nombre_sieges']) ?>" 
                                                        data-toggle="modal" 
                                                        data-target="#editBusModal">
                                                    <i class="dw dw-edit2"></i>
                                                    Edit
                                                </button>
                                                <button class="dropdown-item" 
                                                        data-id="<?= esc($buse['id_bus']) ?>" 
                                                        data-toggle="modal" 
                                                        data-target="#deleteBusModal">
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
                    document.getElementById('edit_bus_id').value = this.getAttribute('data-id');
                    document.getElementById('edit_name_bus').value = this.getAttribute('data-bus');
                    document.getElementById('edit_nombre_sieges').value = this.getAttribute('data-sieges');
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.dropdown-item').forEach(function (button) {
                button.addEventListener('click', function () {
                    document.getElementById('delete_Bus_id').value = this.getAttribute('data-id');
                });
            });
        });
    </script>
<?= $this->endSection() ?>

	
	
	