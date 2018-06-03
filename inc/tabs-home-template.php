<?php

$filename = 'tabs-home-template.php';
$time = microtime(true);
$endtime = $time - $filename;

?>

<table class="table bg-white table-bordered table-maket">
    <thead class="text-center">
    <tr>
        <th scope="col">№</th><th scope="col">Макет</th><th scope="col">Опции</th><th scope="col">Статус</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th class="text-center align-middle fa-2x">1</th>
        <td class="m-3" style="max-width: 225px;width: 225px;">
            <canvas id="canvas-tmp-1" width="200" height="180" class="d-flex"></canvas>
        </td>
        <td>
            <ul class="list-group-item">
                <li><input type="checkbox" name="maket1-fx-header" class="checkbox mr-3" />Закрепить шапку</li>
                <li><input type="checkbox" name="maket1-fx-sidebar-left" class="checkbox mr-3" />Закрепить левый сайдбар</li>
                <li><input type="checkbox" name="maket1-fx-footer" class="checkbox mr-3" />Закрепить футер</li>
            </ul>
            <div class="lead font-weight-normal my-1">банер - меню - левый сайдбар - подвал</div>
        </td>
        <td>
            <i class="fa fa-check-circle fa-3x text-success"></i>
        </td>
    </tr>

    <tr>
        <th class="text-center align-middle fa-2x">2</th>
        <td class="m-3" style="max-width: 225px;width: 225px;">
            <canvas id="canvas-tmp-2" width="200" height="180" class="d-flex"></canvas>
        </td>
        <td>
            <ul class="list-group-item">
                <li><input type="checkbox" name="maket2-fx-header" class="checkbox mr-3" />Закрепить шапку</li>
                <li><input type="checkbox" name="maket2-fx-sidebar-right" class="checkbox mr-3" />Закрепить правый сайдбар</li>
                <li><input type="checkbox" name="maket2-fx-footer" class="checkbox mr-3" />Закрепить footer</li>
            </ul>
            <div class="lead font-weight-normal my-1">банер - меню - правый сайдбар - подвал</div>
        </td>
        <td>
            <i class="fa fa-check-circle fa-3x text-muted"></i>
        </td>
    </tr>

    <tr>
        <th class="text-center align-middle fa-2x">3</th>
        <td class="m-3" style="max-width: 225px;width: 225px;">
            <canvas id="canvas-tmp-3" width="200" height="180" class="d-flex"></canvas>
        </td>
        <td>
            <ul class="list-group-item">
                <li><input type="checkbox" name="maket3-fx-header" class="checkbox mr-3" />Закрепить шапку</li>
                <li><input type="checkbox" name="maket3-fx-sidebar-left" class="checkbox mr-3" />Закрепить сайдбар слева</li>
                <li><input type="checkbox" name="maket3-fx-widget-right" class="checkbox mr-3" />Закрепить виджет справа</li>
                <li><input type="checkbox" name="maket3-fx-footer" class="checkbox mr-3" />Закрепить footer</li>
            </ul>
            <div class="lead font-weight-normal my-1">банер - меню - левый сайдбар - правый виджет - подвал</div>
        </td>
        <td>
            <i class="fa fa-check-circle fa-3x text-muted"></i>
        </td>
    </tr>

    <tr>
        <th class="text-center align-middle fa-2x">4</th>
        <td class="m-3" style="max-width: 225px;width: 225px;">
            <canvas id="canvas-tmp-4" width="200" height="180" class="d-flex"></canvas>
        </td>
        <td>
            <ul class="list-group-item">
                <li><input type="checkbox" name="maket4-fx-header" class="checkbox mr-3" />Закрепить шапку</li>
                <li><input type="checkbox" name="maket4-fx-widget-left" class="checkbox mr-3" />Закрепить виджет слева</li>
                <li><input type="checkbox" name="maket4-fx-sidebar-right" class="checkbox mr-3" />Закрепить сайдбар справа</li>
                <li><input type="checkbox" name="maket4-fx-footer" class="checkbox mr-3" />Закрепить footer</li>
            </ul>
            <div class="lead font-weight-normal mb-1">меню - левый виджет - правый сайдбар - подвал</div>
        </td>
        <td>
            <i class="fa fa-check-circle fa-3x text-muted"></i>
        </td>
    </tr>

    <tr>
        <th class="text-center align-middle fa-2x">5</th>
        <td class="m-3" style="max-width: 225px;width: 225px;">
            <canvas id="canvas-tmp-5" width="200" height="180" class="d-flex"></canvas>
        </td>
        <td>
            <ul class="list-group-item">
                <li><input type="checkbox" name="maket5-fx-header" class="checkbox mr-3" />Закрепить шапку</li>
                <li><input type="checkbox" name="maket5-fx-footer" class="checkbox mr-3" />Закрепить footer</li>
<!--                <li class="form-wrap">-->
<!--                    <label class="form-check-label" for="inlineRadio1">В 2-е колонки</label>-->
<!--                    <input type="radio" name="maket5-rubrika-2" class="form-check-input mr-3" id="inlineRadio1" />-->
<!---->
<!--                    <label class="form-check-label" for="inlineRadio2">В 3-е колонки</label>-->
<!--                    <input type="radio" name="maket5-rubrika-3" class="form-check-input mr-3" id="inlineRadio2" />-->
<!---->
<!--                    <label class="form-check-label" for="inlineRadio3">В 4-е колонки</label>-->
<!--                    <input type="radio" name="maket5-rubrika-4" class="form-check-input mr-3" id="inlineRadio3" />-->
<!--                </li>-->
            </ul>
            <div class="form-check form-check-inline d-flex mt-2 ml-2">
                <input class="form-check-input" type="radio" name="maket5-rubrika" id="exampleRadios1" value="rubrika-1" checked>
                <label class="form-check-label" for="exampleRadios1">
                    В 2-е колонки
                </label>
            </div>
            <div class="form-check form-check-inline d-flex mt-2 ml-2">
                <input class="form-check-input" type="radio" name="maket5-rubrika" id="exampleRadios2" value="rubrika-2">
                <label class="form-check-label" for="exampleRadios2">
                    В 3-е колонки
                </label>
            </div>
            <div class="form-check form-check-inline d-flex mt-2 ml-2">
                <input class="form-check-input" type="radio" name="maket5-rubrika" id="exampleRadios3" value="rubrika-3">
                <label class="form-check-label" for="exampleRadios3">
                    В 4-е колонки
                </label>
            </div>
            <div class="lead font-weight-normal mb-1">меню - категории столбцами - подвал</div>
        </td>
        <td>
            <i class="fa fa-check-circle fa-3x text-muted"></i>
        </td>
    </tr>

    <tr>
        <th class="text-center align-middle fa-2x">6</th>
        <td class="m-3" style="max-width: 225px;width: 225px;">
            <canvas id="canvas-tmp-6" width="200" height="180" class="d-flex"></canvas>
        </td>
        <td>
            <ul class="list-group-item">
                <li><input type="checkbox" name="maket6-fx-header" class="checkbox mr-3" />Закрепить шапку</li>
                <li><input type="checkbox" name="maket6-fx-footer" class="checkbox mr-3" />Закрепить footer</li>
            </ul>
            <div class="lead font-weight-normal mb-1">меню - категории списком - подвал</div>
        </td>
        <td>
            <i class="fa fa-check-circle fa-3x text-muted"></i>
        </td>
    </tr>
    <tr>
        <th colspan="3" class="text-center">
            <small class="text-muted">Последнее обновление: <?php echo date("d.m.Y", $endtime); ?></small>
        </th>
        <td>
            <button type="submit" class="btn maket6-submit btn-outline-success btn-sm">Сохранить</button>
        </td>
    </tr>
    </tbody>
</table>
