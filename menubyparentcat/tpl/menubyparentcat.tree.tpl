<!--
/**
 * Menu by Parent Category for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0
 * Filename: plugins/menubyparentcat/tpl/menubyparentcat.tree.tpl
 * Purpose:  Основной шаблон вывода меню на сайте.
 *           Формирует красивое вертикальное Bootstrap 5 меню с иконками Font Awesome,
 *           поддержкой раскрывающихся подменю (аккордеон), подсчётом количества страниц,
 *           автоматическим выделением активных пунктов и поддержкой прямых ссылок.
 *           Полностью адаптивен, работает без JavaScript (только Bootstrap Collapse).
 * Date: 2025-11-27
 * @package menubyparentcat
 * @version 2.2.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2025 https://github.com/webitproff/cot-menubyparentcat
 * @license BSD
 */
-->

<!-- BEGIN: MAIN -->
<style>.pointer{cursor:pointer !important}</style>
<!-- Минимальный CSS-хак: делает курсор pointer для кликабельных заголовков категорий -->


<!-- 
Выводим заголовок меню (например "Руководство пользователя"), 
если он задан в переменной $root_title файла menubyparentcat.functions.php 
-->
<!-- IF {MENU_TITLE} -->
<ul class="nav flex-column">
	<li class="nav-item">
		<p class="text-uppercase small fw-bold text-muted px-0">{MENU_TITLE}</p>
	</li>
</ul>
<hr class="my-2 opacity-25">
<!-- Горизонтальная линия-разделитель после заголовка -->
<!-- ENDIF -->

<div id="mbp-accordion">
  <!-- Контейнер-аккордеон. ID используется как data-bs-parent для всех collapse-блоков -->
  <!-- Если убрать data-bs-parent или сам id="mbp-accordion" — можно будет раскрывать несколько категорий одновременно -->
  <ul class="nav flex-column">

    <!-- BEGIN: CATEGORY -->
    <!-- Цикл по всем категориям-разделителям, добавленным через админку -->
    <li class="nav-item">

      <!-- IF {CAT_HAS_PAGES} -->
      <!-- Если в категории есть хотя бы одна видимая страница — делаем раскрывающееся подменю -->
      <a class="nav-link d-flex align-items-center collapsed pointer"
         data-bs-toggle="collapse"
         data-bs-target="#mbp-collapse-{CAT_CODE}"
         aria-expanded="<!-- IF {CAT_IS_ACTIVE} -->true<!-- ELSE -->false<!-- ENDIF -->">
        <i class="fa-regular fa-folder me-2"></i>
        <span>{CAT_TITLE}</span>
        <!-- Бейдж с количеством страниц в категории -->
        <span class="ms-auto badge bg-secondary rounded-pill">{CAT_COUNT}</span>
        <!-- Стрелочка вниз, поворачивается автоматически через Bootstrap -->
        <i class="fas fa-angle-down ms-2"></i>
      </a>

      <!-- Раскрывающийся блок с подстраницами -->
      <div class="collapse<!-- IF {CAT_IS_ACTIVE} --> show<!-- ENDIF -->"
           id="mbp-collapse-{CAT_CODE}"
           data-bs-parent="#mbp-accordion">
        <ul class="nav flex-column ps-4 pt-1">
          <!-- BEGIN: SUBPAGE -->
          <!-- Цикл по всем страницам, вручную добавленным в эту категорию -->
          <li class="nav-item">
            <a href="{PAGE_URL}" class="nav-link<!-- IF {PAGE_IS_ACTIVE} --> active<!-- ENDIF -->">
              <i class="fa-solid fa-file me-2"></i>
              <span>{PAGE_TITLE}</span>
            </a>
          </li>
          <!-- END: SUBPAGE -->
        </ul>
      </div>

      <!-- ELSE -->
      <!-- Если в категории нет страниц — просто выводим её как неактивный заголовок -->
      <div class="nav-link d-flex align-items-center text-muted">
        <i class="fa-regular fa-folder me-2"></i>
        <span>{CAT_TITLE}</span>
      </div>
      <!-- ENDIF -->

    </li>
    <!-- END: CATEGORY -->

    <!-- BEGIN: DIRECT_PAGE -->
    <!-- Прямые страницы — добавленные вручную без привязки к категории (выносятся наверх или вниз) 
	блок DIRECT_PAGE проектная идея, которая пока, в самом конструкторе меню, не реализована в menubyparentcat.tools.php,
	возможно появится в будущих версиях, если будет заказ или донаты
	-->
    <li class="nav-item">
      <a href="{PAGE_URL}" class="nav-link d-flex align-items-center<!-- IF {PAGE_IS_ACTIVE} --> active<!-- ENDIF -->">
        <i class="fa-solid fa-file me-2"></i>
        <span>{PAGE_TITLE}</span>
      </a>
    </li>
    <!-- END: DIRECT_PAGE -->

  </ul>
</div>
<hr class="my-2 opacity-25">
<!-- END: MAIN -->