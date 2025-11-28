<!--
/**
 * Menu by Parent Category for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0
 * Filename: plugins/menubyparentcat/tpl/menubyparentcat.admin.tpl
 * Purpose:  Шаблон админки плагина «Меню по родительской категории».
 *           Содержит форму добавления/редактирования элемента меню и таблицу со всеми текущими пунктами.
 *           Полностью адаптивен под Bootstrap 5 (используется в админ-теме Cotonti Siena).
 *           Поддерживает переключение между типами «Категория» и «Страница» через JavaScript.
 * Date: 2025-11-27
 * @package menubyparentcat
 * @version 2.2.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2025 https://github.com/webitproff/cot-menubyparentcat
 * @license BSD
 */
-->

<!-- BEGIN: MAIN -->
<div class="container-fluid py-4">
    <!-- Основной заголовок страницы в админке -->
    <h2>{PHP.L.menubyparentcat_title}</h2>

    <!-- Подключаем стандартный шаблон вывода системных предупреждений админки -->
	<!-- сюда выводим всё, что приходит в cot_display_messages($t); из cot_message(), cot_error() -->
    {FILE "{PHP.cfg.themes_dir}/admin/{PHP.cfg.admintheme}/warnings.tpl"}

    <!-- ==================== ФОРМА ДОБАВЛЕНИЯ / РЕДАКТИРОВАНИЯ ==================== -->
    <div class="card mb-4 border-{FORM_TYPE_COLOR}">
        <!-- Цвет заголовка формы меняется: success при добавлении, warning при редактировании -->
        <div class="card-header bg-{FORM_TYPE_COLOR}-subtle text-{FORM_TYPE_COLOR}-emphasis">
            {FORM_HEADER}
        </div>
        <div class="card-body">
            <form method="post" class="row g-3" action="{FORM_ACTION}">
                <!-- Выбор типа элемента: Категория или Страница -->
                <div class="col-md-2">
                    <label class="form-label">{PHP.L.menubyparentcat_type}</label>
                    <select name="item_type" class="form-select" id="mbpcat_type_selector">
                        <option value="cat" {EDIT_TYPE_CAT}>{PHP.L.menubyparentcat_type_cat}</option>
                        <option value="page" {EDIT_TYPE_PAGE}>{PHP.L.menubyparentcat_type_page}</option>
                    </select>
                </div>

                <!-- Блок выбора категории (показывается только при выборе типа cat) -->
				<!-- Если в id="mbpcat_type_selector" выбрали категории - тут выбираем подкатегорию -->
                <div class="col-md-4" id="mbpcat_cat_box">
                    <label class="form-label">{PHP.L.menubyparentcat_code}</label>
                    {EDIT_CAT_SELECT}
                </div>

                <!-- Блок выбора страницы (показывается только при выборе типа page) -->
				<!-- Если в id="mbpcat_type_selector" выбрали статью - тут выбираем статьи -->
                <div class="col-md-4" id="mbpcat_page_box">
                    <label class="form-label">{PHP.L.menubyparentcat_code}</label>
                    {EDIT_PAGE_SELECT}
                </div>

                <!-- Порядок сортировки (для категорий — общий, для страниц — внутри своей категории) -->
                <div class="col-md-1">
                    <label class="form-label">{PHP.L.menubyparentcat_order}</label>
                    <input type="number" name="sortorder" class="form-control" value="{EDIT_SORTORDER}">
                </div>

                <!-- Переопределение заголовка (необязательно) -->
                <div class="col-12">
                    <label class="form-label">{PHP.L.menubyparentcat_title_override}</label>
                    <input type="text" name="title_override" class="form-control" value="{EDIT_TITLE}">
                </div>

                <!-- Чекбокс «Включать в меню» -->
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="include" id="mbpcat_include" {EDIT_INCLUDE}>
                        <label class="form-check-label" for="mbpcat_include">{PHP.L.menubyparentcat_include}</label>
                    </div>
                </div>

                <!-- Скрытое поле X (защита от повторной отправки) и xg (CSRF-токен) -->
                {FORM_XG_HIDDEN}
				<!-- Сейчас не используется! осталось просто для напоминания о 
				post/get - cot_xp()/cot_xg()
				и можно удалить 
				-->

                <!-- Кнопки «Сохранить/Добавить» и «Отмена» -->
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-{FORM_TYPE_COLOR}">{FORM_SUBMIT}</button>
                    <a href="{CANCEL_URL}" class="btn btn-secondary ms-2">{PHP.L.menubyparentcat_cancel}</a>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== СПИСОК ВСЕХ ЭЛЕМЕНТОВ МЕНЮ ==================== -->
    <div class="card mb-4">
        <div class="card-header">{PHP.L.menubyparentcat_list_header}</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>{PHP.L.menubyparentcat_type}</th>
                        <th>{PHP.L.menubyparentcat_code}</th>
                        <th>{PHP.L.menubyparentcat_title_override}</th>
                        <th>{PHP.L.menubyparentcat_include}</th>
                        <th>{PHP.L.menubyparentcat_order}</th>
                        <th>{PHP.L.menubyparentcat_actions}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- BEGIN: ITEM_ROW -->
                    <!-- Цикл вывода каждой строки дерева меню в нашей таблице -->
                    <tr>
                        <td>{ITEM_ID}</td>
                        <td>{ITEM_TYPE}</td>
                        <td>{ITEM_CODE}</td>
                        <td>{ITEM_TITLE}</td>
                        <td>{ITEM_INCLUDE}</td>
                        <td>{ITEM_SORTORDER}</td>
                        <td>
                            <a href="{ITEM_EDIT_URL}" class="btn btn-sm btn-outline-warning">{PHP.L.menubyparentcat_edit}</a>
                            <a href="{ITEM_DELETE_URL}" class="btn btn-sm btn-outline-danger confirmLink">{PHP.L.menubyparentcat_delete}</a>
							 <!-- confirmLink - здесь это штатный класс CMF Cotonti для подтверждения операций -->
                        </td>
                    </tr>
                    <!-- END: ITEM_ROW -->

                    <!-- Если элементов нет — показываем сообщение -->
                    <!-- IF {ITEM_ROW_COUNT} =< 0 -->
                    <tr>
                        <td colspan="7" class="text-center text-muted">{PHP.L.menubyparentcat_no_items}</td>
                    </tr>
                    <!-- ENDIF -->
					<!-- ITEM_ROW_COUNT в логике menubyparentcat.tools.php пока не прописан и участок как шаблон, если кому пригодится -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==================== JavaScript для переключения блоков ==================== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelector = document.getElementById('mbpcat_type_selector');
        const catBox       = document.getElementById('mbpcat_cat_box');
        const pageBox      = document.getElementById('mbpcat_page_box');

        function toggleTypeBoxes() {
            if (typeSelector.value === 'cat') {
                catBox.style.display  = 'block';
                pageBox.style.display = 'none';
            } else {
                catBox.style.display  = 'none';
                pageBox.style.display = 'block';
            }
        }

        typeSelector.addEventListener('change', toggleTypeBoxes);
        toggleTypeBoxes(); // Вызываем сразу при загрузке, чтобы правильно показать нужный блок
    });
</script>
<!-- END: MAIN -->