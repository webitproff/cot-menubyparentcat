<?php

/**
 * Menu by Parent Category for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0
 * Filename: plugins/menubyparentcat/inc/menubyparentcat.functions.php
 * Purpose:  Содержит основные функции плагина, в первую очередь — cot_menubyparentcat_build_tree(),
 *           которая генерирует готовое HTML-меню на основе данных из таблицы cot_menubyparentcat_items.
 *           Используется в шаблонах сайта через {PHP.cot_menubyparentcat_build_tree()} или прямым вызовом.
 * Date: 2025-11-27
 * @package menubyparentcat
 * @version 2.2.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2025 https://github.com/webitproff/cot-menubyparentcat
 * @license BSD
 */


// menubyparentcat.functions.php
// этот файл с общими функциями плагина, подключается автоматически при первом вызове любой функции из него.

defined('COT_CODE') or die('Wrong URL.');
// Ключевая защита Cotonti: если файл вызван напрямую (не через index.php etc), выполнение мгновенно прерывается с фатальной ошибкой.
// Предотвращает утечку кода, прямой доступ к функциям и потенциальные уязвимости.

require_once cot_incfile('page', 'module');
// Подключаем модуль страниц — без него нет доступа к таблице cot_pages, функциям cot_url('page', ...), переменной $structure['page'] и т.д.
// Критически важно для всей логики плагина.

require_once cot_incfile('structure', 'core');
// Подключаем ядро работы со структурой категорий. Именно здесь формируется глобальный массив $structure['page'] с путями, заголовками и уровнями.
// Без этого файла невозможно определить дочерние категории и строить правильные URL.

require_once cot_langfile('menubyparentcat', 'plug');
// Загружаем языковой файл плагина (ru.lang.php и др.). Пока не используется напрямую в этом файле,
// но подключение обязательно для совместимости и возможного будущего вывода $L['...'] в меню.

Cot::$db->registerTable('menubyparentcat_items');
// Регистрируем свою таблицу в системе Cotonti.
// После этого можно использовать короткое имя $db_menubyparentcat_items вместо полного префикса,
// а также безопасно работать через Cot::$db->query(), insert(), update(), delete().

/**
 * Строит меню по родительской категории с полной поддержкой новой таблицы
 */

// Ключевая функция плагина — единственная публичная точка входа для вывода меню на сайте.

function cot_menubyparentcat_build_tree(string $parent_code = '', string $selected = ''): string
{
    // Объявление функции с типизацией (PHP 8.4+).
    // Принимает: $parent_code — код корневой категории (например 'user-guide'), $selected — зарезервировано под будущие фичи.
    // Возвращает строку — готовый HTML-код меню.

    global $db_pages, $structure, $db_menubyparentcat_items;
    // Делаем глобальными переменные с именами таблиц для краткости записи в запросах.
    // В современных проектах лучше использовать Cot::$db->pages, но старый стиль пока поддерживается.

    $parent_code = $parent_code ?: (Cot::$cfg['plugin']['menubyparentcat']['code_parentcat'] ?? '');
    // Если в вызове функции не передан код категории — берём его из настроек плагина.
    // Оператор ?? — защита от undefined index, если настройка не задана.

    if (empty($parent_code)) return '';
    // Если код категории пустой (не указан в настройках и не передан вручную) — возвращаем пустую строку.
    // Никакого меню не будет — безопасно и без ошибок.

    // Заголовок корневой категории
    $root_title = $structure['page'][$parent_code]['title'] ?? 'Меню';
    // Берём человекочитаемое название корневой категории (например "Руководство пользователя").
    // Если по какой-то причине его нет — будет просто "Меню" как fallback.

    // Получаем ВСЕ элементы меню (и категории, и страницы), отсортированные правильно
    $items = Cot::$db->query("
        SELECT *
        FROM $db_menubyparentcat_items
        WHERE mbpcat_parent_cat = ? AND mbpcat_include = 1
        ORDER BY 
            mbpcat_sortorder_cat ASC,
            mbpcat_sortorder_pageincat ASC
    ", [$parent_code])->fetchAll();
    // Один запрос получает все видимые элементы меню для данной родительской категории.
    // Сортировка: сначала категории по порядку (sortorder_cat), потом страницы внутри каждой категории (sortorder_pageincat).
    // mbpcat_include = 1 — показываем только включённые элементы (остальные скрыты через админку).

    if (empty($items)) return '';
    // Если в таблице нет ни одного видимого элемента — возвращаем пустую строку.
    // Не рендерим даже обёртку меню — экономим ресурсы и не ломаем верстку.

    $t = new XTemplate(cot_tplfile('menubyparentcat.tree', 'plug'));
    // Создаём объект XTemplate и загружаем шаблон menubyparentcat.tree.tpl из папки templates/.
    // В этом файле описана вся разметка меню: заголовок, категории, страницы, активность и т.д.

    $t->assign('MENU_TITLE', htmlspecialchars($root_title));
    // Передаём в шаблон заголовок меню (например "Руководство пользователя").
    // htmlspecialchars обязателен — защита от XSS

    $current_page_cat = $GLOBALS['pag']['page_cat'] ?? '';
    // Получаем код текущей открытой категории страницы (например, user-guide.projects-manual).
    // Берём из глобального массива $pag, который Cotonti заполняет при просмотре любой страницы модуля page.
    // Если не на странице — будет пустая строка. Нужно для определения активного пункта меню.

    $current_page_id  = (int)($GLOBALS['pag']['page_id'] ?? 0);
    // Получаем ID текущей открытой страницы. Приводим к int, чтобы избежать строковых сравнений.
    // Если пользователь не на странице модуля page — будет 0. Используется для подсветки активной ссылки.

    $submenu_id = 0;
    // Счётчик подменю. Нужен, чтобы генерировать уникальные ID вида mbpcat_submenu_1, mbpcat_submenu_2 и т.д.
    // Используется в шаблоне для aria-controls, data-target и для корректной работы JS-аккордеона/выпадашек.

    $processed_page_ids = []; // Чтобы не дублировать страницы
    // Массив уже выведенных ID страниц. Критически важно, потому что одна и та же страница может быть добавлена вручную
    // и одновременно лежать в категории. Без этого проверки будет дублирование ссылок в меню.

    foreach ($items as $item) {
        // Начинаем перебор всех элементов меню, отсортированных в правильном порядке из запроса выше.
        // $item — одна запись из таблицы cot_menubyparentcat_items.

        // === Элемент типа "категория" (разделитель + автоподгрузка страниц) ===
        if ($item['mbpcat_item_type'] === 'cat' && !empty($item['mbpcat_item_code_cat'])) {
            // Обрабатываем только записи типа "cat" и только если указан код дочерней категории.
            // Пустые коды пропускаются — защита от битых данных.

            $submenu_id++;
            // Увеличиваем счётчик — у каждой категории будет свой уникальный идентификатор подменю.

            $cat_code = $item['mbpcat_item_code_cat'];
            // Сохраняем код дочерней категории (например, projects-manual, services-manual) в отдельную переменную.
            // Удобно для дальнейшего использования.

            $cat_title = $item['mbpcat_title_override'] ?: ($structure['page'][$cat_code]['title'] ?? $cat_code);
            // Формируем заголовок раздела:
            // 1. Если админ задал свой текст через mbpcat_title_override — берём его.
           // 2. Иначе — берём название из структуры категорий.
           // 3. Если и там нет — просто выводим сам код категории (чтобы не было пусто).

            // Определяем, активна ли эта категория (текущая страница в ней или её подкатегории)
            $is_active_cat = (
                $current_page_cat === $cat_code ||
                strpos($current_page_cat, $cat_code . '.') === 0
            );
            // Проверяем два случая:
            // 1. Текущая страница находится прямо в этой категории (user-guide.projects-manual)
            // 2. Текущая страница в подкатегории этой категории (user-guide.projects-manual.subcat)
            // Если да — в шаблоне будет добавлен класс active или раскрыто подменю.

            // Количество страниц в категории
    $pages_in_cat = Cot::$db->query("
        SELECT COUNT(*) 
        FROM $db_menubyparentcat_items i
        LEFT JOIN $db_pages p ON i.mbpcat_item_page_id = p.page_id
        WHERE i.mbpcat_parent_cat = ?
          AND i.mbpcat_item_type = 'page'
          AND i.mbpcat_item_page_cat = ?
          AND i.mbpcat_include = 1
          AND (p.page_state = 0 OR p.page_state IS NULL)
    ", [$parent_code, $cat_code])->fetchColumn();
			/*             
				$pages_in_cat = Cot::$db->query("
                SELECT COUNT(*) 
                FROM $db_menubyparentcat_items i
                LEFT JOIN $db_pages p ON i.mbpcat_item_page_id = p.page_id
                WHERE i.mbpcat_parent_cat = ?
                  AND i.mbpcat_item_type = 'page'
                  AND i.mbpcat_item_page_cat = ?
                  AND i.mbpcat_include = 1
                  AND (p.page_state = 0 OR p.page_state IS NULL)
            ", [$parent_code, $parent_code, $cat_code])->fetchColumn(); 
			*/
            // Считаем количество видимых и опубликованных страниц, вручную добавленных в эту категорию через админку.
            // Нужно, чтобы в шаблоне можно было скрыть пустые категории или показать счётчик.

            $has_pages = $pages_in_cat > 0;
            // Булево значение: есть ли хотя бы одна страница в этой категории.
            // Используется в шаблоне для условного вывода стрелочки, плюсика или просто заголовка без подменю.

            $t->assign([
                // Передаём в шаблон блок CATEGORY все данные по текущей категории-разделителю

                'CAT_CODE'       => $cat_code,
                // Сам код категории — может использоваться для кастомных классов или data-атрибутов.

                'CAT_TITLE'      => htmlspecialchars($cat_title),
                // Название раздела с защитой от XSS.

                'CAT_HAS_PAGES'  => $has_pages,
                // true/false — есть ли дочерние страницы. В шаблоне можно делать <!-- IF {CAT_HAS_PAGES} -->.

                'CAT_COUNT'      => $pages_in_cat,
                // Число — сколько страниц в категории. Можно выводить как (12) рядом с названием.

                'CAT_IS_ACTIVE'  => $is_active_cat,  // теперь булево, а не строка!
                // Флаг активности категории. В шаблоне на основе него ставится класс active или aria-expanded="true".
            ]);
            // Закрывающая скобка assign для блока категории.


            // Страницы категории — ручные записи из таблицы menubyparentcat_items
            $manual_pages = Cot::$db->query("
                SELECT i.*, p.page_id, p.page_title, p.page_alias, p.page_cat
                FROM $db_menubyparentcat_items i
                LEFT JOIN $db_pages p ON i.mbpcat_item_page_id = p.page_id
                WHERE i.mbpcat_parent_cat = ?
                  AND i.mbpcat_item_type = 'page'
                  AND i.mbpcat_item_page_cat = ?
                  AND i.mbpcat_include = 1
                  AND (p.page_state = 0 OR p.page_state IS NULL)
                ORDER BY i.mbpcat_sortorder_pageincat ASC
            ", [$parent_code, $cat_code])->fetchAll();
            // Делаем точный запрос: берём только вручную добавленные страницы (тип page) для текущей категории-разделителя.
            // LEFT JOIN нужен, потому что в таблице items может быть битый page_id — тогда p.* будет NULL.
            // Условие mbpcat_include = 1 — скрытые в админке страницы не попадают в меню.
            // p.page_state = 0 — показываем только опубликованные страницы (не в черновиках и не удалённые).
            // Сортировка строго по полю mbpcat_sortorder_pageincat — именно тот порядок, который задал админ.

            foreach ($manual_pages as $mp) {
                // Перебираем каждую вручную добавленную страницу в текущей категории.

                if (!$mp['page_id'] || in_array($mp['page_id'], $processed_page_ids)) continue;
                // Пропускаем:
                // 1. Если page_id пустой (битая запись в таблице items)
                // 2. Если эта страница уже была выведена ранее (например, как "прямая страница" вне категории)
                // Это защита от дублирования одной и той же страницы в меню.

                $title = $mp['mbpcat_title_override'] ?: ($mp['page_title'] ?: 'Без названия');
                // Формируем финальный заголовок ссылки:
                // 1. Если админ переопределил название в админке — берём его
                // 2. Иначе берём реальное название из cot_pages
                // 3. Если и там пусто — пишем "Без названия" — чтобы не ломалась верстка

                $url = $mp['page_alias']
                    ? cot_url('page', ['c' => $mp['page_cat'], 'al' => $mp['page_alias']])
                    : cot_url('page', ['c' => $mp['page_cat'], 'id' => $mp['page_id']]);
                // Генерируем правильный URL страницы:
                // Если у страницы есть alias (чпу) — используем его: /page/services-manual/my-service
                // Иначе — стандартный вид: /page/id123 или /page/c=user-guide.projects-manual&id=123
                // Функция cot_url() сама экранирует и добавляет базовый URL сайта.

                $t->assign([
                    // Передаём данные одной страницы в блок SUBPAGE шаблона

                    'PAGE_URL'       => $url,
                    // Полный URL страницы — будет в href="<...>"

                    'PAGE_TITLE'     => htmlspecialchars($title),
                    // Название ссылки с защитой от XSS (на случай, если админ вставил теги в переопределённый заголовок)

                    'PAGE_IS_ACTIVE' => ($current_page_id == $mp['page_id']),
                    // Булево: является ли эта страница текущей открытой.
                    // В шаблоне на основе этого ставится class="active", <strong> или aria-current="page"
                ]);
                // Закрывающая скобка assign для одной подстраницы.

                $t->parse('MAIN.CATEGORY.SUBPAGE');
                // Парсим блок SUBPAGE — добавляем одну строку <li> с ссылкой на страницу.
                // Вызывается столько раз, сколько страниц в категории.

                $processed_page_ids[] = $mp['page_id'];
                // Запоминаем ID страницы в массиве обработанных — чтобы не вывести её ещё раз ниже как "прямую страницу".
            }
            // Конец цикла по страницам текущей категории.

            $t->parse('MAIN.CATEGORY');
            // Завершаем парсинг блока CATEGORY.
            // Всё, что мы передали в assign() выше + все SUBPAGE — теперь собрано в один блок <li class="category">...</li>
            // Если в категории нет страниц — блок всё равно выведется (если в шаблоне не стоит IF {CAT_HAS_PAGES}).

        }  // конец обработки элемента типа "cat"
        // Закрывающая фигурная скобка условия if ($item['mbpcat_item_type'] === 'cat' ...)
        // Если запись не категория — идём дальше по циклу foreach.

        // === Прямая страница (вне привязки к категории) блок DIRECT_PAGE ===
        // Прямые страницы — добавленные вручную без привязки к категории (выносятся наверх или вниз)
        // блок DIRECT_PAGE проектная идея, которая пока, в самом конструкторе меню, не реализована в menubyparentcat.tools.php,
        // возможно появится в будущих версиях, если будет заказ или донаты
        if ($item['mbpcat_item_type'] === 'page' && $item['mbpcat_item_page_id'] && empty($item['mbpcat_item_page_cat'])) {
            // Обрабатываем особый случай: страница добавлена вручную в меню как "прямая ссылка",
            // но при этом у неё НЕ указана категория (mbpcat_item_page_cat пустой).
            // Это позволяет выносить важные страницы наверх меню, вне структуры категорий.

            if (in_array($item['mbpcat_item_page_id'], $processed_page_ids)) continue;
            // Защита от дублирования: если эта страница уже была выведена внутри какой-то категории выше — пропускаем.
            // Без этой проверки одна страница могла бы появиться дважды: и в категории, и отдельно.

            $page = Cot::$db->query("
                SELECT page_id, page_title, page_alias, page_cat
                FROM $db_pages
                WHERE page_id = ? AND page_state = 0
                LIMIT 1
            ", [$item['mbpcat_item_page_id']])->fetch();
            // Делаем отдельный запрос к cot_pages — проверяем, что страница действительно существует и опубликована.
            // Если страница удалена или в черновике — $page будет false и дальше ничего не выведется.

            if (!$page) continue;
            // Если страница не найдена или не опубликована — пропускаем её полностью.
            // Это защита от битых ссылок в меню после удаления/скрытия страницы.

            $title = $item['mbpcat_title_override'] ?: ($page['page_title'] ?: 'Без названия');
            // Формируем текст ссылки:
            // 1. Переопределённое в админке название
            // 2. Реальное название страницы
            // 3. Заглушка "Без названия" — чтобы не ломалась верстка

            $url = $page['page_alias']
                ? cot_url('page', ['c' => $page['page_cat'], 'al' => $page['page_alias']])
                : cot_url('page', ['c' => $page['page_cat'], 'id' => $page['page_id']]);
            // Генерируем чистый URL страницы:
            // При наличии alias — ЧПУ вида /page/services-manual/my-service
            // Без alias — классический: /page/id=123 или /page/c=user-guide.projects-manual&id=123

            $t->assign([
                // Передаём данные "прямой" страницы в отдельный блок шаблона DIRECT_PAGE

                'PAGE_URL'    => $url,
                // Полный URL — будет в href

                'PAGE_TITLE'  => htmlspecialchars($title),
                // Название ссылки с защитой от XSS

                'PAGE_CLASS'  => ($current_page_id == $page['page_id']) ? 'active' : '',
                // Класс active, если это текущая открытая страница.
                // В шаблоне можно писать class="{PAGE_CLASS}" — автоматически подсветится.
            ]);
            // Закрывающая скобка assign для прямой страницы.

            $t->parse('MAIN.DIRECT_PAGE');
            // Парсим блок DIRECT_PAGE в шаблоне — это отдельный <li> вне категорий.
            // Обычно используется для "главных" ссылок: "О проекте", "Контакты", "FAQ" и т.д.

            $processed_page_ids[] = $page['page_id'];
            // Добавляем ID страницы в список обработанных — больше она нигде не появится.
        }
        // Конец условия для прямых страниц
    }
    // Конец основного цикла foreach ($items as $item)
    // Все элементы меню обработаны: и категории с подстраницами, и прямые ссылки.

    $t->parse('MAIN');
    // Финальный парсинг корневого блока MAIN.
    // Теперь весь HTML меню собран: заголовок + все категории + все страницы.

    return $t->text('MAIN');
    // Возвращаем готовую HTML-строку меню.
    // В шаблонах сайта используется так: {PHP.cot_menubyparentcat_build_tree()}
    // Или в PHP: echo cot_menubyparentcat_build_tree('user-guide');
}
// Закрывающая фигурная скобка функции cot_menubyparentcat_build_tree()
// Всё. Функция завершена.

