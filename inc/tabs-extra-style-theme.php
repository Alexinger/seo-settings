<?php

// Added value 'file-style.css'
add_option('file-style', '');

// variables settings file style
$settings_texarea_style_name = get_option("file-style");
$settings_texarea_style_id = "file-style";

$settings_texarea_style = array(
	"wpautop"       => 0,
	"media_buttons" => 0,
	"textarea_rows" => 20,
	"teeny"         => 0,
	"dfw"           => 0,
	"tinymce"       => 0,
	"quicktags"     => 0,
	"drag_drop_upload" => false
);
?>

<form id="form-style">
	<h4 class="my-3">Дочерние стили из файла style-theme.css</h4>
	<div class="form-group">
		<?php wp_editor(stripslashes($settings_texarea_style_name), $settings_texarea_style_id, $settings_texarea_style); ?>
	</div>
	<div>
		<button type="button" id="style-submit-btn" class="btn btn-success float-right">Сохранить стили</button>
	</div>
</form>