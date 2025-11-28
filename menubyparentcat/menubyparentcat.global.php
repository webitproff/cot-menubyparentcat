<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=global
 * [END_COT_EXT]
 */

// Метаданные расширения Cotonti.
// Hooks=global — означает, что этот файл будет подключаться на КАЖДОЙ странице сайта (даже в админке),
// сразу после инициализации ядра, но до обработки модулей.
// Это нужно, чтобы функция cot_menubyparentcat_build_tree() была доступна везде и в любом шаблоне сайта
// через запись в нем {PHP|cot_menubyparentcat_build_tree()}

/**
 * Menu by Parent Category for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0
 * Filename: plugins/menubyparentcat/menubyparentcat.global.php
 * Purpose:  Подключает основные зависимости плагина при каждом запросе и делает функцию построения меню
 *           глобально доступной через {PHP|cot_menubyparentcat_build_tree()} в любом шаблоне сайта.
 *           Также готовит общие переменные и права доступа для корректной работы меню.
 * Date: 2025-11-27
 * @package menubyparentcat
 * @version 2.2.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2025 https://github.com/webitproff/cot-menubyparentcat
 * @license BSD
 */


defined('COT_CODE') or die('Wrong URL.');
// Стандартная защита Cotonti от прямого доступа.
// Если кто-то попытается открыть этот файл открыть напрямую (например,
// site.ru/plugins/menubyparentcat/menubyparentcat.global.php) —
// сразу получит фатальную ошибку "Wrong URL.". Защищает от утечки кода и уязвимостей.

require_once cot_incfile('page', 'module'); // module helpers
// Подключаем модуль страниц.
// Это критически важно: без него не будет глобальных переменных $db_pages, $structure['page'], функций cot_url('page', ...),
// и вообще ничего не заработает. Даже если меню вызывается на главной — модуль page должен быть загружен.

require_once cot_incfile('structure', 'core'); // structure helpers
// Подключаем ядро структуры категорий.
// Заполняет массив $structure['page'] — дерево всех категорий с title, path, level и т.д.
// Без этого файла невозможно понять, какая категория дочерняя, построить правильные URL и определить активность.

require_once cot_langfile('menubyparentcat', 'plug');
// Загружаем языковой файл плагина (ru.lang.php, en.lang.php и т.д.).
// Даже если сейчас не используется — подключение обязательно: в будущем может понадобиться $L['menubyparentcat_...']
// в шаблонах или сообщениях. Также это требование стандарта Cotonti.

require_once cot_incfile('menubyparentcat', 'plug');
// Подключаем основной файл плагина — обычно menubyparentcat.functions.php или menubyparentcat.php (просто пример).
// В нём лежит главная функция cot_menubyparentcat_build_tree() и другие вспомогательные функции.
// Без этого подключения вызов {PHP|cot_menubyparentcat_build_tree()} в шаблоне упадёт с ошибкой "Call to undefined function".

list($auth_read, $auth_write, $auth_admin) = cot_auth('module', 'page');
// Получаем права доступа текущего пользователя к модулю page (чтение, запись, администрирование).
// $auth_read — может ли видеть страницы вообще
// $auth_write — может ли создавать/редактировать
// $auth_admin — полный доступ (включая чужие страницы)
// Пока не используется напрямую в меню, но может понадобиться в будущем (например, показывать черновики админу).

//$myFunc = cot_build_structure_page_tree('', array());
// Закомментированная строка — заготовка под полное дерево категорий.
// cot_build_structure_my_ext_tree() — пользовательская или штатная функция Cotonti
// Сейчас не используется, но оставлена как шаблон: если в будущем захотим автоматически подгружать ВСЕ страницы —
// можно раскомментировать и переписать меню под автоподгрузку без ручного управления.