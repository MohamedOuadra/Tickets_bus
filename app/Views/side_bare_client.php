<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Amoudou</title>

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
		<style>
		.sidebar-light .sidebar-menu .dropdown-toggle {
			color: #0b132b;
			font-weight: 500;
			margin: -4px 0px 0 -31px;
		}
		.sidebar-menu .dropdown-toggle {
			display: block;
			padding: 14px 6px 14px 67px;
			font-size: 15px;
			color: #fff;
			font-weight: 500;
			position: relative;
			border-radius: 8px;
			font-family: 'Inter', sans-serif;
			-webkit-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
		}
		.i_side_bare {
			margin: 0 42px 0 0;
		}
		.i_side_bare_client {
			margin: 0 42px 0 0;
		}
		i.icon-copy.dashboard.ion-android-film.i_side_bare {
			margin: 0px 45px 0 5px;
		}
		#accordion-menu{
			margin: 22px 0 0 0;
		}
		i.icon-copy.bi.bi-person-fill.client {
			color: black;
			font-size: xx-large;
		}
		</style>
		
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
							<i class="icon-copy bi bi-person-fill client"></i>
							</span>
							<?php 
								$id_client = session()->get('id');
								$prenom_client = session()->get('prenom');
								$nom_client = session()->get('nom');
							?>
							<span class="user-name">
							<?php
								echo $prenom_client.' '.$nom_client;
							?>
						</span>
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
				<a href="<?= base_url('/') ?>">
                    <img style="height: 126%;" src="<?= base_url('vendors/images/bus/final_logo.png') ?>" alt="" />
                </a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round  "></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li>
							<a href="<?= base_url('reserver') ?>" class="dropdown-toggle no-arrow">
								<i class="icon-copy dashboard bi bi-cash i_side_bare_client"></i>
								<span class="mtext">Book a ticket</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url("/reservations/$id_client") ?>" class="dropdown-toggle no-arrow">
								<i class="icon-copy dashboard dw dw-calendar1 i_side_bare_client"></i>
								<span class="mtext">Bookings</span>
							</a>
						</li>
						<li>
							<a href="<?= site_url('auth/logout'); ?>" class="dropdown-toggle no-arrow">
							<i class="icon-copy dashboard dw dw-logout i_side_bare"></i>
							<span class="mtext">logout</span>
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
