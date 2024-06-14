<?php $this->load->view('templates/header') ?>

<?php $this->load->view('templates/navbar') ?>

<?php $this->load->view('templates/sidebar') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Pemesanan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Halaman Pemesanan</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<button class="btn btn-primary" data-toggle="modal" data-target="#tambahpemesanan">Tambah Pesanan</button>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="pemesanan" class="table table-striped">
									<thead>
									<tr>
										<th>No</th>
										<th>Pupuk</th>
										<th>Jumlah</th>
										<th>Harga</th>
										<th>Pembayaran</th>
										<th>Action</th>
									</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Riwayat Pemesanan</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="pemesanan" class="table table-striped">
									<thead>
									<tr>
										<th>No</th>
										<th>Pupuk</th>
										<th>Jumlah</th>
										<th>Harga</th>
										<th>Pembayaran</th>
									</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="tambahpemesanan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="card-title">Form Tambah Pemesanan</h3>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('pemesanan/insert') ?>" method="post">
					<div class="form-group">
						<label for="id_users">Users</label>
						<select name="id_users" id="id_users" class="form-control">
							<option selected disabled>-- Pilih Users --</option>
						</select>						</div>
					<div class="form-group">
						<label for="id_pupuk">Pupuk</label>
						<select name="id_pupuk" id="id_pupuk" class="form-control">
							<option selected disabled>-- Pilih Pupuk --</option>
						</select>					</div>
					<div class="form-group">
						<label for="jumlah">Jumlah</label>
						<input type="number" name="jumlah" class="form-control" id="jumlah" required>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Masukkan DataTables JS di sini -->
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-vvzWW7LzPfbN5mmy"></script>
	<script>
		$(document).ready(function() {
			$('#pemesanan').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "<?= base_url('pemesanan/get_data_pemesanan') ?>",
					"type": "POST"
				},
				"columns": [
					{ "data": 0 },
					{ "data": 1 },
					{ "data": 2 },
					{ "data": 3 },
					{ "data": 4 },
					{ "data": 5 }
				]
			});

			$(document).ready(function() {
				$(document).on('click', '.bayar-sekarang', function() {
					var id_pesanan = $(this).data('id-pesanan');
					console.log('Tombol "Bayar Sekarang" diklik, ID Pesanan:', id_pesanan);

					$.ajax({
						url: '<?= base_url('pemesanan/get_snap_token') ?>',
						method: 'POST',
						data: { id_pesanan: id_pesanan },
						success: function(response) {
							var data = JSON.parse(response);
							console.log('Response dari server:', data);

							if (data.success) {
								console.log('Snap Token:', data.snap_token);
								snap.pay(data.snap_token, {
									onSuccess: function(result) {
										console.log('Pembayaran berhasil:', result);
										// Tambahkan logika setelah pembayaran berhasil
									},
									onPending: function(result) {
										console.log('Pembayaran tertunda:', result);
										// Tambahkan logika untuk pembayaran tertunda
									},
									onError: function(result) {
										console.log('Pembayaran gagal:', result);
										// Tambahkan logika untuk pembayaran gagal
									},
									onClose: function() {
										console.log('Widget Snap ditutup');
										// Tambahkan logika saat widget ditutup
									}
								});
							} else {
								alert(data.message);
							}
						},
						error: function(xhr, status, error) {
							console.error('Gagal memuat token pembayaran:', status, error);
						}
					});
				});
			});
		});
		$(document).ready(function() {
			$.ajax({
				url: "<?php echo base_url('pemesanan/api_pupuk') ?>",
				method: 'GET',
				dataType: 'json',
				success: function(response) {
					var $selectPupuk = $('#id_pupuk');
					response.forEach(function(pupuk) {
						var $option = $('<option>', {
							value: pupuk.id_pupuk,
							text: pupuk.nama_pupuk
						});
						$selectPupuk.append($option);
					});
				},
				error: function(xhr, status, error) {
					console.error('Gagal mengambil data kegiatan:', status, error);
				}
			});
		});

		$(document).ready(function() {
			$.ajax({
				url: "<?php echo base_url('pemesanan/api_users') ?>",
				method: 'GET',
				dataType: 'json',
				success: function(response) {
					var $selectUsers = $('#id_users');
					response.forEach(function(users) {
						var $option = $('<option>', {
							value: users.id_users,
							text: users.nama
						});
						$selectUsers.append($option);
					});
				},
				error: function(xhr, status, error) {
					console.error('Gagal mengambil data kegiatan:', status, error);
				}
			});
		});
	</script>


<?php $this->load->view('templates/footer') ?>
