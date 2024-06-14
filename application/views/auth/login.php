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
						<input type="text" name="email" class="form-control" placeholder="Email" required>
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

<?php $this->load->view('templates/footer') ?>
