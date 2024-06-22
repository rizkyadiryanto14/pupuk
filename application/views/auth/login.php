<?php $this->load->view('templates/header') ?>

<div class="container">
	<div class="mt-5">
		<div class="row">
			<div class="col-12 col-md-6 text-center mt-3 mx-auto p-3">
				<img src="<?= base_url('assets/images/logo.png') ?>" width="35%" class="mb-4" alt=""/>
				<br>
				<h1 class="h2" style="font-size: 28px;">Aplikasi Pengelolaan Pupuk <br>UD Wahyu</h1>
				<p class="lead">Masuk untuk mendapat akses ke sistem.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-5 mx-auto mt-6">
				<form action="<?= base_url('login') ?>" method="post">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
									<i class="fa fa-user"></i>
								</span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="Username" required>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
									<i class="fa fa-lock"></i>
								</span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
					<div class="input-group mb-3">
						<button type="submit" name="submit" value="login" class="btn btn-block btn-success">
							LOGIN
							<i class="fa fa-arrow-alt-circle-right"></i>
						</button>
					</div>
				</form>
				<div class="input-group mb-3">
					<button class="btn btn-block btn-warning" data-toggle="modal" data-target="#ceknik">
						CEK NIK
						<i class="fa fa-arrow-alt-circle-right"></i>
					</button>
				</div>
				<a href="<?= base_url('home') ?>"><i class="fas fa-arrow-left"></i> Kembali Ke Home</a>
			</div>
		</div>

		<div class="row">
			<div class="col-12 mx-auto mt-3 mb-3">
                    <span>
                        <p style="vertical-align: middle;" class="text-muted text-center">Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> - UD WAHYU. All rights reserved.
                        </p>
                    </span>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ceknik">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Cek Nik</h3>
			</div>
			<form action="<?= base_url('users/ceknik') ?>" method="post">
				<div class="modal-body">
					<label for="nik">Masukan NIK</label>
					<input type="text" name="nik" id="nik" class="form-control">
				</div>
				<div class="modal-footer">
					<button class="btn btn-warning" data-dismiss="modal">Close</button>
					<button class="btn btn-success" type="submit">Cek NIK</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('templates/footer') ?>
