<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>UD Wahyu</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url() ?>assets/images/logo.png" rel="icon">
	<link href="<?= base_url() ?>assets/images/logo.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url() ?>assets/landingpage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/landingpage/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/landingpage/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/landingpage/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/landingpage/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />


	<!-- Template Main CSS File -->
	<link href="<?= base_url() ?>assets/landingpage/css/style.css" rel="stylesheet">

	<!-- =======================================================
	* Template Name: Lumia
	* Template URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
	* Updated: Mar 17 2024 with Bootstrap v5.3.3
	* Author: BootstrapMade.com
	* License: https://bootstrapmade.com/license/
	======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
	<div class="container d-flex align-items-center">

		<div class="logo me-auto">
			<h1>
				<a href="<?= base_url('home') ?>">
					<img src="<?= base_url('assets/images/logo.png') ?>"  alt="">
					UD WAHYU
				</a>
			</h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html"><img src="<?= base_url() ?>assets/landingpage/img/logo.png" alt="" class="img-fluid"></a>-->
		</div>

		<nav id="navbar" class="navbar order-last order-lg-0">
			<ul>
				<li><a class="nav-link scrollto active" href="<?= base_url('home') ?>">Home</a></li>
				<li><a class="nav-link scrollto" href="<?= base_url('daftar_penerima') ?>">Daftar Penerima Subsidi</a></li>
				<li><a class="nav-link scrollto" href="#contact">Contact</a></li>
				<li><a class="nav-link scrollto" href="<?= base_url('auth') ?>">Login</a></li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

	</div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
	<div class="container text-center text-md-left" data-aos="fade-up">
		<h1>Welcome to <span>Ud Wahyu</span></h1>
		<h2>Menyediakan Beberapa Kebutuhan Anda</h2>
		<a href="#about" class="btn-get-started scrollto">Get Started</a>
	</div>
</section><!-- End Hero -->

<main id="main">

<section class="about">
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title text-center">Daftar Penerima Subsidi</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="subsidi" class="table table-bordered">
						<thead>
						<tr>
							<th>No</th>
							<th>Nama Petani</th>
							<th>NIK</th>
							<th>Alamat Petani</th>
							<th>Tempat Lahir</th>
							<th>Tanggal Lahir</th>
							<th>Kode Kios</th>
							<th>Nama Kios</th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">


	<div class="container d-md-flex py-4">

		<div class="me-md-auto text-center text-md-start">
			<div class="me-md-auto text-center text-md-start">
				<div class="copyright">
					&copy; Copyright <strong><span>UD WAHYU</span></strong>. All Rights Reserved
				</div>
			</div>
		</div>
	</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>assets/landingpage/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?= base_url() ?>assets/landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/landingpage/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url() ?>assets/landingpage/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url() ?>assets/landingpage/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url() ?>assets/landingpage/vendor/waypoints/noframework.waypoints.js"></script>
<script src="<?= base_url() ?>assets/landingpage/vendor/php-email-form/validate.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url() ?>assets/landingpage/js/main.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Masukkan DataTables JS di sini -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script>
	$(document).ready(function () {
		var dataTable = $('#subsidi').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo base_url('home/get_data_subsidi'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 1, 2, 3, 4, 5, 6, 7],
				"orderable": false,
			}],
		});
	});
</script>

</body>

</html>
