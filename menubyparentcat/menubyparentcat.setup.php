<?php
/* ====================
[BEGIN_COT_EXT]
Code=menubyparentcat
Name=Меню по родительской категории
Category=
Description=Плагин для создания списков элементов меню по выбранной родительской категории и всех ее дочерних категорий, включая статьи, опубликованные в них.
Version=2.2.8
Date=2025-11-28
Author=webitproff
Copyright=Copyright (c) webitproff 2025 https://github.com/webitproff/cot-menubyparentcat
Notes=Requires PHP 8.4+, MySQL 8.0+, Cotonti Siena v.0.9.26.
SQL=menubyparentcat.install.sql
UninstallSQL=menubyparentcat.uninstall.sql
Auth_guests=R
Lock_guests=12345A
Auth_members=RW
Lock_members=12345A
Requires_modules=page
Requires_plugins=
Recommends_modules=
Recommends_plugins=
Hooks=global,tools
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
code_parentcat=01:string::docs:Код родительской категории модуля
[END_COT_EXT_CONFIG]
==================== */

/**
 * Menu by Parent Category for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0
 * Filename: menubyparentcat.setup.php
 * Purpose: Registers metadata and configuration for the menubyparentcat plugin in the Cotonti admin panel.
 * Date: 2025-11-28
 * @package menubyparentcat
 * @version 2.2.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2025 https://github.com/webitproff/cot-menubyparentcat
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');