<div class="card-group bg-white border rounded p-3 my-2">
    <h3 class="text-monospace font-weight-bold badge-primary p-1 rounded">google_sheet</h3>
    <span class="ml-2 mt-2 text-monospace">[google_sheet params=""]</span>
    <h4 class="w-100 font-weight-bold text-center border-bottom border-dark mb-3 mt-4 pb-3">Возможные вариант params</h4>
    <div class="w-100 mt-1 mb-3 d-flex flex-wrap">
        <code class="rounded notice no-break py-1">
            <span class="font-weight-bold">title</span>
            <span class="font-italic text-dark">='Здесь название прайса'</span>
        </code>
        <code class="rounded notice no-break py-1">
            <span class="font-weight-bold">title_color</span>
            <span class="font-italic text-dark">='Здесь цвет названия прайса (green, white, black, ...) или (#232e33, #354fff, #3a3ef1, ...)'</span>
        </code>
        <code class="rounded notice no-break py-1">
            <span class="font-weight-bold">table_bg</span>
            <span class="font-italic text-dark">='Здесь цвет таблицы (green, white, black, ...) или (#232e33, #354fff, #3a3ef1, ...)'</span>
        </code>
        <code class="rounded notice no-break py-1">
            <span class="font-weight-bold">table_color_value</span>
            <span class="font-italic text-dark">='Здесь цвет значений в таблице (green, white, black, ...) или (#232e33, #354fff, #3a3ef1, ...)'</span>
        </code>
    </div>
    <h4 class="w-100 font-weight-bold text-center border-bottom border-dark mb-3 mt-4 pb-3">Как подключить таблицу?</h4>
    <span>В строке url взять только вот эту выделенную часть</span>
    <code>https://docs.google.com/spreadsheets/d/<span class="font-weight-bold text-body">19Tv0hdhBAmniibBTt2TKlXRtdhki6Rr3KSRMh-AcpTc</span>/edit#gid=<span class="font-weight-bold text-body">0</span></code>
    <form id="form-shortcode" class="w-100 my-3 border d-flex flex-column p-4 rounded bg-light shadow-sm">
        <div class="form-check-inline align-items-center flex-column" style="row-gap: 20px;">
            <div class="d-flex align-items-baseline w-responsive">
                <label for="url" class="mr-2 no-break">Чать кода из URL</label>
                <input id="tabs-shortcode-url" type="text" name="url" value="<?php echo get_option("tabs-shortcode-url"); ?>" placeholder="Здесь вставить этот код (19Tv0hdhBAmniibBTt2TKlXRtdhki6Rr3KSRMh-AcpTc)" class="w-100"><br>
            </div>
            <div class="d-flex align-items-baseline w-responsive">
                <label for="number-pae" class="mr-2 no-break">Номер страницы</label>
                <input id="tabs-shortcode-page" type="number" name="number" value="<?php echo get_option("tabs-shortcode-page"); ?>" placeholder="Здесь вставить номер вкладки, он стоит после (/edit#gid=), в данном примере 0" class="w-100"><br>
            </div>
            <div class="d-flex align-items-baseline">
                <button id="btnSaveShortcode" type="submit" class="btn btn-primary ml-2 btnSaveShortcode"><span class="fa fa-refresh mr-2"></span>Обновить данные</button>
            </div>
        </div>
    </form>
    <div class="flex-column flex-center mb-3 w-100">
        <div>Текущая таблица, которую можно здесь редактировать</div>
        <iframe src="https://docs.google.com/spreadsheets/d/<?php echo get_option('tabs-shortcode-url') ?>/edit#gid=<?php echo get_option('tabs-shortcode-page')?>" width="100%" height="450" align="left">
            Ваш браузер не поддерживает плавающие фреймы!
        </iframe>
    </div>
</div>
