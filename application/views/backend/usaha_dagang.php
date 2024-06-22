<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Usaha Dagang</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Halaman Usaha Dagang</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<button class="btn btn-primary" data-toggle="modal" data-target="#tambahusahadagang">Tambah Usaha Dagang</button>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="usaha_dagang" class="table table-bordered">
									<thead>
									<tr>
										<th>No</th>
										<th>Nama Kios</th>
										<th>Kode Kios</th>
										<th>Subsektor</th>
										<th>Action</th>
									</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="tambahusahadagang">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Form Tambah Data</h3>
			</div>
			<form action="<?= base_url('usaha_dagang/insert') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_kios">Nama Kios</label>
						<input type="text" name="nama_kios" id="nama_kios" class="form-control">
					</div>
					<div class="form-group">
						<label for="kode_kios">Kode Kios</label>
						<input type="text" name="kode_kios" id="kode_kios" class="form-control">
					</div>
					<div class="form-group">
						<label for="subsektor">Subsektor</label>
						<input type="text" name="subsektor" id="subsektor" class="form-control">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Masukkan DataTables JS di sini -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function () {
		var dataTable = $('#usaha_dagang').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo base_url('usaha_dagang/get_data_usahadagang'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 1, 2, 3, 4],
				"orderable": false,
			}],
		});
	});
</script>

<?php $this->load->view('templates/footer') ?>
