<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('styles/core.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('styles/icon-font.min.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('styles/dataTables.bootstrap4.min.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('styles/responsive.bootstrap4.min.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('styles/style.css') ?>" />

		
	</head>
	<body>
		
		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
			</div>
			<div class="header-right">
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="<?= base_url('vendors/images/photo1.jpg') ?>" alt="" />
							</span>
							<span class="user-name">Ross C. Lopez</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="right-sidebar">
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
                    <ul id="accordion-menu">
                        <li>
							<a href="sitemap.html" class="dropdown-toggle no-arrow">
								<span class="mtext">Dashboard</span>
							</a>
						</li>
                        <li>
							<a href="sitemap.html" class="dropdown-toggle no-arrow">
                                <i class="icon-copy fa fa-bus" aria-hidden="true"></i>    
								<span class="mtext">Buses</span>
							</a>
						</li>
                        <li>
							<a href="sitemap.html" class="dropdown-toggle no-arrow">
								<span class="mtext">Routes</span>
							</a>
						</li>
                        <li>
							<a href="sitemap.html" class="dropdown-toggle no-arrow">
								<span class="mtext">Bookings</span>
							</a>
						</li>
                        <li>
							<a href="sitemap.html" class="dropdown-toggle no-arrow">
								<span class="mtext">Seats</span>
							</a>
						</li>
                        <li>
							<a href="sitemap.html" class="dropdown-toggle no-arrow">
								<span class="mtext">Custmors</span>
							</a>
						</li>
                        <li>
							<a href="sitemap.html" class="dropdown-toggle no-arrow">
								<span class="mtext">Add New Admin</span>
							</a>
						</li>
                    </ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
            <!-- Section pour le contenu spécifique à chaque page -->
            <?= $this->renderSection('content') ?>
        </div>
		
		<!-- welcome modal end -->
		<!-- js -->
		<script src="<?= base_url('scripts/core.js') ?>"></script>
		<script src="<?= base_url('scripts/script.min.js') ?>"></script>
		<script src="<?= base_url('scripts/process.js') ?>"></script>
		<script src="<?= base_url('scripts/layout-settings.js') ?>"></script>
		<script src="<?= base_url('js/jquery.dataTables.min.js') ?>"></script>
		<script src="<?= base_url('js/dataTables.bootstrap4.min.js') ?>"></script>
		<script src="<?= base_url('js/dataTables.responsive.min.js') ?>"></script>
		<script src="<?= base_url('js/responsive.bootstrap4.min.js') ?>"></script>
		<script src="<?= base_url('js/dataTables.buttons.min.js') ?>"></script>
		<script src="<?= base_url('js/buttons.bootstrap4.min.js') ?>"></script>
		<script src="<?= base_url('js/buttons.print.min.js') ?>"></script>
		<script src="<?= base_url('js/buttons.html5.min.js') ?>"></script>
		<script src="<?= base_url('js/buttons.flash.min.js') ?>"></script>
		<script src="<?= base_url('js/pdfmake.min.js') ?>"></script>
		<script src="<?= base_url('js/vfs_fonts.js') ?>"></script>
		<script src="<?= base_url('scripts/datatable-setting.js') ?>"></script>
	</body>
</html>
