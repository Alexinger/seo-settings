<?php
// no required Billing
add_option('bil-field-first-name', ''); // должно быть обязательным по умолчанию
add_option('bil-field-last-name', 'checked');
add_option('bil-field-company', 'checked');
add_option('bil-field-country', 'checked');
add_option('bil-field-address-1', 'checked');
add_option('bil-field-address-2', 'checked');
add_option('bil-field-city', ''); // должно быть обязательным по умолчанию
add_option('bil-field-state', ''); // должно быть обязательным по умолчанию
add_option('bil-field-postcode', 'checked');
add_option('bil-field-phone', 'checked');
add_option('bil-field-email', ''); // должно быть обязательным по умолчанию
add_option('bil-field-orders', 'Пожелания к отделу доставки или реквизиты'); // дополнительное поле для реквизитов

// remove field Billing (все поля должны быть включенными по умолчанию)
add_option('bil-remove-field-first-name', '');
add_option('bil-remove-field-last-name', '');
add_option('bil-remove-field-company', '');
add_option('bil-remove-field-country', '');
add_option('bil-remove-field-address-1', '');
add_option('bil-remove-field-address-2', '');
add_option('bil-remove-field-city', '');
add_option('bil-remove-field-state', '');
add_option('bil-remove-field-postcode', '');
add_option('bil-remove-field-phone', '');
add_option('bil-remove-field-email', '');

//// no required Shipping
//add_option('ship-field-last-name', 'checked');
//add_option('ship-field-address', 'checked');
//add_option('ship-field-phone', 'checked');
//add_option('ship-field-postcode', 'checked');
//add_option('ship-field-state', 'checked');
//

//// remove field Shipping
//add_option('ship-remove-field-company', 'checked');
//add_option('ship-remove-field-country', 'checked');
//add_option('ship-remove-field-state', 'checked');
//add_option('ship-remove-field-postcode', 'checked');
//add_option('ship-remove-field-phone', 'checked');

?>
<form id="table-field-submit">
    <table class="table table-hover table-bordered table-sm w-100">
    <thead>
        <tr class="text-center">
            <th rowspan="2" class="text-uppercase w-25" style="vertical-align: middle;">Название поля</th>
            <th colspan="2" class="text-uppercase">Оплата</th>
            <th colspan="2" class="text-uppercase">Доставка</th>
        </tr>
        <tr class="text-center">
            <th class="font-weight-normal text-secondary">не обязательные поля<i class="fa fa-asterisk ml-1 text-danger" style="font-size: 8px; vertical-align: super;"></i></th>
            <th class="font-weight-normal text-secondary">удалить</th>
            <th class="font-weight-normal text-secondary">не обязательные поля<i class="fa fa-asterisk ml-1 text-danger" style="font-size: 8px; vertical-align: super;"></i></th>
            <th class="font-weight-normal text-secondary">удалить</th>
        </tr>
    </thead>
        <tr>
            <td class="pl-3">Имя</td>
            <td class="text-center"><input type="checkbox" name="bil-field-first-name" class="bil-field-first-name header-check" <?php echo get_option("bil-field-first-name"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-first-name" class="bil-remove-field-first-name last-check" <?php echo get_option("bil-remove-field-first-name"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-last-name" class="ship-field-first-name" <?php echo get_option("ship-field-first-name"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-last-name" class="ship-remove-field-first-name" <?php echo get_option("ship-remove-field-first-name"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Фамилия</td>
            <td class="text-center"><input type="checkbox" name="bil-field-last-name" class="bil-field-last-name header-check" <?php echo get_option("bil-field-last-name"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-last-name" class="bil-remove-field-last-name last-check" <?php echo get_option("bil-remove-field-last-name"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-last-name" class="ship-field-last-name" <?php echo get_option("ship-field-last-name"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-last-name" class="ship-remove-field-last-name" <?php echo get_option("ship-remove-field-last-name"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Название компании</td>
            <td class="text-center"><input type="checkbox" name="bil-field-company" class="bil-field-company header-check" <?php echo get_option("bil-field-company"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-company" class="bil-remove-field-company last-check" <?php echo get_option("bil-remove-field-company"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-company" class="ship-field-company" <?php echo get_option("ship-field-company"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-company" class="ship-remove-field-company" <?php echo get_option("ship-remove-field-company"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Страна</td>
            <td class="text-center"><input type="checkbox" name="bil-field-country" class="bil-field-country header-check" <?php echo get_option("bil-field-country"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-country" class="bil-remove-field-country last-check" <?php echo get_option("bil-remove-field-country"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-country" class="ship-field-country" <?php echo get_option("ship-field-country"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-country" class="ship-remove-field-country" <?php echo get_option("ship-remove-field-country"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Адрес - 1</td>
            <td class="text-center"><input type="checkbox" name="bil-field-address-1" class="bil-field-address-1 header-check" <?php echo get_option("bil-field-address-1"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-address-1" class="bil-remove-field-address-1 last-check" <?php echo get_option("bil-remove-field-address-1"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-address-1" class="ship-field-address-1" <?php echo get_option("ship-field-address-1"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-address-1" class="ship-remove-field-address-1" <?php echo get_option("ship-remove-field-address-1"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Адрес - 2</td>
            <td class="text-center"><input type="checkbox" name="bil-field-address-2" class="bil-field-address-2 header-check" <?php echo get_option("bil-field-address-2"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-address-2" class="bil-remove-field-address-2 last-check" <?php echo get_option("bil-remove-field-address-2"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-address-2" class="ship-field-address-2" <?php echo get_option("ship-field-address-2"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-address-2" class="ship-remove-field-address-2" <?php echo get_option("ship-remove-field-address-2"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Город</td>
            <td class="text-center"><input type="checkbox" name="bil-field-city" class="bil-field-city header-check" <?php echo get_option("bil-field-city"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-city" class="bil-remove-field-city last-check" <?php echo get_option("bil-remove-field-city"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-city" class="ship-field-city" <?php echo get_option("ship-field-city"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-city" class="ship-remove-field-city" <?php echo get_option("ship-remove-field-city"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Область/регион</td>
            <td class="text-center"><input type="checkbox" name="bil-field-state" class="bil-field-state header-check" <?php echo get_option("bil-field-state"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-state" class="bil-remove-field-state last-check" <?php echo get_option("bil-remove-field-state"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-state" class="ship-field-state" <?php echo get_option("ship-field-state"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-state" class="ship-remove-field-state" <?php echo get_option("ship-remove-field-state"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Индекс</td>
            <td class="text-center"><input type="checkbox" name="bil-field-postcode" class="bil-field-postcode header-check" <?php echo get_option("bil-field-postcode"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-postcode" class="bil-remove-field-postcode last-check" <?php echo get_option("bil-remove-field-postcode"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-postcode" class="ship-field-postcode" <?php echo get_option("ship-field-postcode"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-postcode" class="ship-remove-field-postcode" <?php echo get_option("ship-remove-field-postcode"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Телефон</td>
            <td class="text-center"><input type="checkbox" name="bil-field-phone" class="bil-field-phone header-check" <?php echo get_option("bil-field-phone"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-phone" class="bil-remove-field-phone last-check" <?php echo get_option("bil-remove-field-phone"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-phone" class="ship-field-phone" <?php echo get_option("ship-field-phone"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-phone" class="ship-remove-field-phone" <?php echo get_option("ship-remove-field-phone"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">E-mail</td>
            <td class="text-center"><input type="checkbox" name="bil-field-email" class="bil-field-email header-check" <?php echo get_option("bil-field-email"); ?>></td>
            <td class="text-center"><input type="checkbox" name="bil-remove-field-email" class="bil-remove-field-email last-check" <?php echo get_option("bil-remove-field-email"); ?>></td>
            <td class="text-center"><input type="checkbox" name="ship-field-email" class="ship-field-email" <?php echo get_option("ship-field-email"); ?> disabled></td>
            <td class="text-center"><input type="checkbox" name="ship-remove-field-email" class="ship-remove-field-email" <?php echo get_option("ship-remove-field-email"); ?> disabled></td>
        </tr>
        <tr>
            <td class="pl-3">Примечание к заказу</td>
            <td colspan="4" class="text-center" style="margin: 0;padding: 0;"><input type="text" name="bil-field-orders" class="bil-field-email header-orders w-100" style="border: 0;height: 32px;" value="<?php echo get_option("bil-field-orders"); ?>" /></td>
        </tr>
    </table>
	<div>
		<button type="button" id="table-field-submit-btn" class="btn btn-success float-right">Сохранить</button>
	</div>
</form>