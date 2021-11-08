<?php

// Added value Delivery
add_option('check-delivery', 'checked');
add_option('tabs-check-delivery-name', 'Доставка');
add_option('tabs-check-delivery-number', 10);
add_option('tabs-check-delivery-content', 'Здесь можно вставить шорткод для Доставки');

// Added value Garant
add_option('check-garant', 'checked');
add_option('tabs-check-garant-name', 'Гарантия');
add_option('tabs-check-garant-number', 11);
add_option('tabs-check-garant-content', 'Здесь можно вставить шорткод для Гарантии');

// Added value Bay
add_option('check-bay', 'checked');
add_option('tabs-check-bay-name', 'Оплата');
add_option('tabs-check-bay-number', 12);
add_option('tabs-check-bay-content', 'Здесь можно вставить шорткод для Оплаты');

// variables settings bay
$settings_texarea_bay_name = get_option("tabs-check-bay-content");
$settings_texarea_bay_id = "tabs-check-bay-content";

// variables settings garant
$settings_texarea_garant_name = get_option("tabs-check-garant-content");
$settings_texarea_garant_id = "tabs-check-garant-content";

// variables settings delivery
$settings_texarea_delivery_name = get_option("tabs-check-delivery-content");
$settings_texarea_delivery_id = "tabs-check-delivery-content";

$settings_texarea = array(
	"wpautop"       => 0,
	"media_buttons" => 1,
	"textarea_rows" => 5,
	"teeny"         => 0,
	"dfw"           => 0,
	"tinymce"       => 1,
	"quicktags"     => 1,
	"drag_drop_upload" => false
);
?>
<form id="form-tabs">
	<div class="tab-content py-3 position-relative">
		<div class="tab-pane active in" id="delivery" role="tabpanel">
			<div class="form-check my-3 pl-0">
				<label class="form-check-label">
					<input type="checkbox" name="check-delivery" class="check-delivery" <?php echo get_option("check-delivery"); ?>>
				</label>
                Добавить новую вкладку к товару
            </div>

			<div class="d-none tabs-check-delivery">
                <div class="col-12">
                    <div class="form-group col-6 row">
                        <label for="tabs-check-delivery-name" class="col-6 col-form-label">Название вкладки</label>
                        <div class="col-4">
                            <input class="form-control" type="text" name="tabs-check-delivery-name" value="<?php echo get_option("tabs-check-delivery-name"); ?>" id="tabs-check-delivery-name">
                        </div>
                    </div>

                    <div class="form-group col-6 row">
                        <label for="tabs-check-delivery-number" class="col-6 col-form-label">Приоритет</label>
                        <div class="col-4">
                            <input class="form-control" type="number" min="1" max="50" name="tabs-check-delivery-number" value="<?php echo get_option("tabs-check-delivery-number"); ?>" id="tabs-check-delivery-number">
                        </div>
                    </div>
                </div>

				<div class="form-group">
					<?php wp_editor(stripslashes($settings_texarea_delivery_name), $settings_texarea_delivery_id, $settings_texarea); ?>
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="garant" role="tabpanel">
			<div class="form-check my-3 pl-0">
				<label class="form-check-label">
					<input type="checkbox" name="check-garant" class="check-garant" <?php echo get_option('check-garant'); ?>>
                    Добавить новую вкладку к товару
				</label>
			</div>

			<div class="d-none tabs-check-garant">
                <div class="col-12">
				<div class="form-group col-6 row">
					<label for="tabs-check-garant-name" class="col-6 col-form-label">Название вкладки</label>
					<div class="col-4">
						<input class="form-control" type="text" name="tabs-check-garant-name" value="<?php echo get_option("tabs-check-garant-name"); ?>" id="tabs-check-garant-name">
					</div>
				</div>

				<div class="form-group col-6 row">
					<label for="tabs-check-garant-number" class="col-6 col-form-label">Приоритет</label>
					<div class="col-4">
						<input class="form-control" type="number" min="1" max="50" name="tabs-check-garant-number" value="<?php echo get_option("tabs-check-garant-number"); ?>" id="tabs-check-garant-number">
					</div>
				</div>
                </div>
				<div class="form-group">
					<?php wp_editor(stripslashes($settings_texarea_garant_name), $settings_texarea_garant_id, $settings_texarea); ?>
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="bay" role="tabpanel">
			<div class="form-check my-3 pl-0">
				<label class="form-check-label">
					<input type="checkbox" name="check-bay" class="check-bay" <?php echo get_option('check-bay'); ?>>
                    Добавить новую вкладку к товару
				</label>
			</div>

			<div class="d-none tabs-check-bay">
                <div class="col-12">
				<div class="form-group col-6 row">
					<label for="tabs-check-bay-name" class="col-6 col-form-label">Название вкладки</label>
					<div class="col-4">
						<input class="form-control" name="tabs-check-bay-name" type="text" value="<?php echo get_option("tabs-check-bay-name"); ?>" id="tabs-check-bay-name">
					</div>
				</div>

				<div class="form-group col-6 row">
					<label for="tabs-check-bay-number" class="col-6 col-form-label">Приоритет</label>
					<div class="col-4">
						<input class="form-control" type="number" min="1" max="50" name="tabs-check-bay-number" value="<?php echo get_option("tabs-check-bay-number"); ?>" id="tabs-check-bay-number">
					</div>
				</div>
                </div>
				<div class="form-group">
					<?php wp_editor(stripslashes($settings_texarea_bay_name), $settings_texarea_bay_id, $settings_texarea); ?>
				</div>
			</div>
		</div>
		<div>
			<button type="button" id="submit-btn" class="btn btn-success float-right">Сохранить</button>
		</div>
	</div>
</form>