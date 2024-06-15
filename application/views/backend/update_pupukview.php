<?php $this->load->view('templates/header') ?>

<?php $this->load->view('templates/navbar') ?>

<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Form Update Pupuk</h3>
					</div>
					<form action="<?= base_url('') ?>" method="post">
						<div class="card-body">
							<div class="form-group">
								<label for="nama_pupuk">Nama Pupuk</label>
								<input type="text" name="nama_pupuk" id="nama_pupuk" class="form-control" value="<?= $data_pupuk['nama_pupuk'] ?>">
							</div>
							<div class="form-group">
								<label for="jenis_pupuk">Jenis Pupuk</label>
								<input type="text" name="jenis_pupuk" id="jenis_pupuk" class="form-control" value="<?= $data_pupuk['jenis_pupuk'] ?>">
							</div>
							<div class="form-group">
								<label for="harga_pupuk">Harga Pupuk</label>
								<input type="text" name="harga_pupuk" id="harga_pupuk" class="form-control" value="<?= $data_pupuk['harga_pupuk'] ?>">
							</div>
							<div class="form-group">
								<label for="status_pupuk">Status Pupuk</label>
								<select name="status_pupuk" id="status_pupuk" class="form-control">
									<option selected disabled> Pilih Status Pupuk</option>
									<option value="masuk">Masuk</option>
									<option value="keluar">Keluar</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<a href="<?= base_url('pupuk') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
							<button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('templates/footer') ?>
