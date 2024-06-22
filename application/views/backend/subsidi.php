<?php $this->load->view('templates/header') ?>

<?php $this->load->view('templates/navbar') ?>

<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Pupuk</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Halaman Pupuk</li>
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
						<button class="btn btn-primary" data-toggle="modal" data-target="#tambahsubsidi">Tambah Data</button>
						<button class="btn btn-success" data-toggle="modal" data-target="#importsubsidi">Import Excel</button>
						<a href="<?= base_url('subsidi/downloadtemplate') ?>" class="btn btn-warning">Download Template</a>
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
									<th>Action</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="importsubsidi">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Import Excel</h3>
			</div>
			<form action="<?= base_url('subsidi/import') ?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="file_import">File Import</label>
						<input type="file" name="file_import" id="file_import" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-warning" data-dismiss="modal">Close</button>
					<button class="btn btn-success" type="submit">Import</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="tambahsubsidi">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">
					Form Tambah Subsidi
				</div>
			</div>
			<form action="<?= base_url('subsidi/insert') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama">Nama Petani</label>
						<input type="text" name="nama" id="nama" class="form-control">
					</div>
					<div class="form-group">
						<label for="nama">Nik</label>
						<input type="text" name="nik" id="nik" class="form-control">
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control">
					</div>
					<div class="form-group">
						<label for="tanggal_lahir">Tanggal Lahir</label>
						<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
					</div>
					<div class="form-group">
						<label for="tempat">Tempat Lahir</label>
						<input type="text" name="tempat" id="tempat" class="form-control">
					</div>
					<div class="form-group">
						<label for="kode_kios">Kode kios</label>
						<input type="text" name="kode_kios" id="kode_kios" class="form-control">
					</div>
					<div class="form-group">
						<label for="nama_kios">Nama kios</label>
						<input type="text" name="nama_kios" id="nama_kios" class="form-control">
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
		var dataTable = $('#subsidi').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo base_url('subsidi/get_data_subsidi'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 1, 2, 3, 4, 5, 6, 7, 8],
				"orderable": false,
			}],
		});
	});
</script>

<?php $this->load->view('templates/footer') ?>

