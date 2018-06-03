<?php

$col = 1;
add_option('array-count', $col);
add_option('title-shortcode-1', 'tov_title');

function addOption($name, $value){add_option($name, $value);}
function updateOption($name, $value){update_option($name, $value);}
function deleteOption($name){delete_option($name);}

?>

<form class="row" id="extra-shortcode">
	<div class="col-12">
		<span id="added-shortcode-fields" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Добавить поле</span>
	</div>
    <?php for ($col = 0; $col < get_option('array-count'); $col++): ?>
    <div class="row col-12 line-field-shortcode">
	    <div class="col-6">
		    <div class="d-flex align-items-baseline my-2">
			    <label for="formShortcodeTitle-<?php echo $col; ?>" class="mr-3 text-info">Название</label>
    			<input type="text" class="form-control" id="formShortcodeTitle-<?php echo $col; ?>" name="title-shortcode-<?php echo $col; ?>" placeholder="Название шорткода" value="<?php echo get_option('title-shortcode-1'); ?>">
	    	</div>
	    </div>
	    <div class="col-6">
		    <div class="d-flex align-items-baseline my-2">
			    <label for="formShortcodeParam-<?php echo $col; ?>" class="mr-3 text-info">Параметры</label>
			    <input type="text" class="form-control" id="formShortcodeParam-<?php echo $col; ?>" placeholder="Параметры">
		    </div>
	    </div>
        <i class="fa fa-times text-danger position-absolute fa-2x d-flex align-self-center" title="удалить"></i>
    </div>
    <?php endfor; ?>
	<div class="col-12">
		<button id="form-create-shortcode" class="btn btn-success pull-right">Сохранить</button>
	</div>
</form>
