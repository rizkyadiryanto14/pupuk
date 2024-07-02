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
					<h1 class="m-0">Penyaluran</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Halaman Penyaluran</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<?php if ($this->session->userdata('role') == 'admin') : ?>
					<button class="btn btn-primary" data-toggle="modal" data-target="#tambahpesanan">Tambah Data</button>
					<?php endif; ?>
					<?php if ($this->session->userdata('role') == 'user') : ?>
						<h3 class="card-title">Halaman Penyaluran</h3>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="pengiriman" class="table table-bordered">
							<thead>
							<tr>
								<th>No</th>
								<th>Pesanan</th>
								<th>Status Pengiriman</th>
								<th>Waktu</th>
								<?php if ($this->session->userdata('role') == 'admin') :  ?>
								<th>Action</th>
								<?php endif; ?>
							</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="tambahpesanan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">
					<h3 class="">Form Tambah Pengiriman</h3>
				</div>
			</div>
			<form action="<?= base_url('pengiriman/insert') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="id_pesanan">Pesanan</label>
						<select name="id_pesanan" id="id_pesanan" class="form-control" required>
							<option selected disabled>Pilih Pesanan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="status_pengiriman">Status Pengiriman</label>
						<select name="status_pengiriman" id="status_pengiriman" class="form-control" required>
							<option selected disabled>Pilih Status</option>
							<option value="Diproses">Diproses</option>
							<option value="Menunggu Dikirim">Menunggu Dikirim</option>
							<option value="Sudah Dikirim">Sudah Dikirim</option>
							<option value="Sudah Diterima">Sudah Diterima</option>
						</select>
					</div>
					<div class="form-group">
						<label for="timestamp">Waktu</label>
						<input type="datetime-local" name="timestamp" id="timestamp" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Masukkan DataTables JS di sini -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function () {
		var dataTable = $('#pengiriman').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo base_url('pengiriman/get_data_pengiriman'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 1, 2, 3, 4],
				"orderable": false,
			}],
		});
	});

	$.ajax({
		url: "<?= base_url('pengiriman/listing_pesanan') ?>",
		method: 'GET',
		dataType: 'json',
		success: function(response) {
			var $selectPupuk = $('#id_pesanan');
			response.forEach(function(pesanan) {
				var $option = $('<option>', {
					value: pesanan.id_pesanan,
					text: 'Jumlah ' +  pesanan.jumlah + ' | ' +  pesanan.nama_pupuk
				});
				$selectPupuk.append($option);
			});
		},
		error: function(xhr, status, error) {
			console.error('Gagal mengambil data pupuk:', status, error);
		}
	});
</script>

<?php $this->load->view('templates/footer') ?>
