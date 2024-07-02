<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Update Pengiriman</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Halaman Update Pengiriman</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							Form update pengiriman
						</h3>
					</div>
					<form action="<?= base_url('pengiriman/update/' . $data_pengiriman['id_pengiriman']) ?>" method="post">
						<div class="card-body">
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
								<input type="datetime-local" name="timestamp" id="timestamp" value="<?= $data_pengiriman['timestamp'] ?>" class="form-control" required>
							</div>
						</div>
						<div class="card-footer">
							<a href="<?= base_url('pengiriman') ?>" class="btn btn-warning">
								<i class="fas fa-arrow-left"></i>
								Kembali
							</a>
							<button class="btn btn-primary" type="submit">
								<i class="fas fa-save"></i>
								Update
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
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
