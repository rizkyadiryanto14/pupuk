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

	<div class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<button class="btn btn-primary" data-toggle="modal" data-target="#tambahpupuk">Tambah Pupuk</button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="pupuk" class="table table-striped">
							<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama</th>
								<th>Jenis</th>
								<th>Harga</th>
								<th>Status</th>
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
<!-- /.content-wrapper -->

<?php foreach ($data_pupuk as $item){ ?>
<div class="modal fade" id="ModalEditDojang">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Form Edit</h3>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<!--Modal Tambah-->
<div class="modal fade" id="tambahpupuk">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Form Tambah Pupuk
			</div>
			<form action="<?= base_url('pupuk/insert') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_pupuk">Nama Pupuk</label>
						<input type="text" name="nama_pupuk" id="nama_pupuk" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="jenis_pupuk">Jenis Pupuk</label>
						<input type="text" name="jenis_pupuk" id="jenis_pupuk" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="harga_pupuk">Harga Pupuk</label>
						<input type="number" name="harga_pupuk" id="harga_pupuk" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="status_pupuk">Status</label>
						<select name="status_pupuk" id="status_pupuk" class="form-control" required>
							<option selected disabled> Pilih Status</option>
							<option value="Masuk">Masuk</option>
							<option value="Keluar">Keluar</option>
						</select>
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
<!--./Modal Tambah-->




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Masukkan DataTables JS di sini -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function () {
		var dataTable = $('#pupuk').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo base_url('pupuk/get_data_pupuk'); ?>",
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
