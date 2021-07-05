<div class="card-group bg-white border rounded p-3 my-2">
    <h4 class="w-100 font-weight-bold text-center border-bottom border-dark mb-3 mt-4 pb-3">Сохраняем данные для AmoCRM</h4>
    <form id="form-amocrm" class="w-100 my-3 border d-flex flex-column p-4 rounded bg-light shadow-sm">
        <div class="form-check-inline align-items-center flex-column" style="row-gap: 20px;">
            <div class="d-flex align-items-baseline w-responsive">
                <label for="amocrm" class="mr-2 no-break">Email куда отправлять письма</label>
                <input id="amocrm-to-email" type="text" name="amocrm" value="<?php echo get_option("amocrm-to-email"); ?>" placeholder="Здесь ввести email" class="w-100"><br>
            </div>
            <div class="d-flex align-items-baseline">
                <button id="btnSaveAmoSrmEmail" type="submit" class="btn btn-primary ml-2 btnSaveAmoSrmEmail"><span class="fa fa-refresh mr-2"></span>Обновить поля</button>
            </div>
        </div>
    </form>
</div>
