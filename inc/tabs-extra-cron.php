<?php
add_option('title-cron', 'добавить email');
?>
	<form class="row" id="wp-cron">
		<div class="alert alert-primary alert-primary col-10 d-flex m-auto justify-content-center my-2 py-1">Задать планировщик по доступности сайта</div>
	 <div class="form-group col-6 my-4">
		<label for="formEmailCron">Email для отправки сообщений</label>
		<input type="email" class="form-control" name="title-cron" id="formEmailCron" placeholder="Добавить email для отправки" value="<?php echo get_option('title-cron') ?>">
	</div>
	<div class="form-group col-6 my-4">
		<label for="formGroupExample">Доступность сайта</label>
		<input type="text" class="form-control" id="formGroupExample" placeholder="Another input">
	</div>
		<div class="col-12">
			<button id="form-send-cron" class="btn btn-success pull-right">Отправить</button>
		</div>
	</form>

<?php

