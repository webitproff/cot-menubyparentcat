-- ===================================================================
-- Install SQL for menubyparentcat plugin
-- File: plugins/menubyparentcat/setup/menubyparentcat.install.sql
-- Purpose: Создаёт таблицу для хранения элементов пользовательского меню,
--          привязанного к одной родительской категории и её дочерним.
--          Позволяет вручную задавать порядок категорий-разделителей и страниц внутри них,
--          переопределять заголовки и включать/выключать отдельные пункты.
-- ===================================================================

-- Удаляем таблицу, если она осталась от предыдущей установки или неудачного удаления.
-- Это гарантирует чистую установку без конфликтов PRIMARY KEY и старых данных.
DROP TABLE IF EXISTS `cot_menubyparentcat_items`;

-- ===================================================================
-- Основная таблица плагина cot_menubyparentcat_items
-- Хранит все элементы меню для одной родительской категории (например user-guide)
-- Структура оптимизирована под частые выборки по parent_cat + сортировку + фильтрацию по типу
-- ===================================================================
CREATE TABLE `cot_menubyparentcat_items` (
  `mbpcat_id`                  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  -- Уникальный идентификатор записи — первичный ключ

  `mbpcat_parent_cat`          VARCHAR(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Код основной родительской категории из настроек плагина (например: user-guide)',
  -- Жёстко привязывает все записи к одному корню. Меняется только в настройках плагина

  `mbpcat_item_type`           ENUM('cat','page') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Тип элемента: cat = категория-разделитель, page = ссылка на статью',
  -- Определяет, что это за пункт: заголовок-подменю или прямая ссылка

  `mbpcat_item_code_cat`       VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Только для типа cat — код дочерней категории (structure code)',
  -- Например: projects-manual, services-manual — используется как разделитель и для автоподгрузки страниц

  `mbpcat_item_page_cat`       VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Код категории страницы (page_cat из cot_pages)',
  -- Дублирует реальную категорию страницы на момент добавления — защита от перемещения страницы

  `mbpcat_item_page_id`        INT UNSIGNED DEFAULT NULL COMMENT 'ID страницы из cot_pages',
  -- Прямая привязка к конкретной статье

  `mbpcat_title_override`      VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Переопределённый заголовок (если пусто — берём из структуры или страницы)',
  -- Позволяет задать свой текст в меню, отличный от оригинального названия

  `mbpcat_include`             TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1 = показывать в меню, 0 = скрыть',
  -- Быстрое включение/выключение пункта без удаления

  `mbpcat_sortorder_cat`       INT NOT NULL DEFAULT 0 COMMENT 'Порядок сортировки категорий (разделителей)',
  -- Управляет порядком только категорий-разделителей между собой

  `mbpcat_sortorder_pageincat` INT NOT NULL DEFAULT 0 COMMENT 'Порядок сортировки страниц внутри своей категории',
  -- Управляет порядком страниц внутри конкретного раздела

  PRIMARY KEY (`mbpcat_id`),
  KEY `idx_parent` (`mbpcat_parent_cat`),
  KEY `idx_cat` (`mbpcat_item_code_cat`),
  KEY `idx_page` (`mbpcat_item_page_cat`, `mbpcat_item_page_id`),
  KEY `idx_order_cat` (`mbpcat_parent_cat`, `mbpcat_sortorder_cat`),
  KEY `idx_order_page` (`mbpcat_parent_cat`, `mbpcat_item_page_cat`, `mbpcat_sortorder_pageincat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===================================================================
-- Демо-данные
-- Заполняют меню для родительской категории user-guide реальными примерами:
--   • три раздела (Задания, Услуги, Счёт)
--   • несколько страниц в каждом разделе с разным статусом включения и порядком
-- Данные вставляются только при первой установке — помогают сразу увидеть, как работает плагин
-- ===================================================================
INSERT INTO `cot_menubyparentcat_items` (
  `mbpcat_parent_cat`, `mbpcat_item_type`, `mbpcat_item_code_cat`, `mbpcat_item_page_cat`, `mbpcat_item_page_id`, `mbpcat_title_override`,                     `mbpcat_include`, `mbpcat_sortorder_cat`, `mbpcat_sortorder_pageincat`
) VALUES
-- Категории-разделители (отображаются всегда первыми в нужном порядке)
('user-guide', 'cat',  'projects-manual', NULL,               NULL,        'Задания, работа',                              1, 10, 0),
('user-guide', 'cat',  'services-manual', NULL,               NULL,        'Услуги',                                       1, 20, 0),
('user-guide', 'cat',  'payments-manual', NULL,               NULL,        'Счет пользователя',                            1, 30, 0),

-- Страницы в разделе «Задания, работа»
('user-guide', 'page', NULL,              'projects-manual',  11,         'Обзор раздела проектов',                       1, 0, 11),
('user-guide', 'page', NULL,              'projects-manual',  12,         'Как разместить задание?',                      0, 0, 12),  -- скрыта
('user-guide', 'page', NULL,              'projects-manual',  13,         'Как выбрать исполнителя по вашему заданию?',   0, 0, 13),  -- скрыта

-- Страницы в разделе «Услуги»
('user-guide', 'page', NULL,              'services-manual',  14,         'Услуги исполнителя и продавца. Общие сведения.',0, 0, 21), -- скрыта
('user-guide', 'page', NULL,              'services-manual',  15,         'Карточка услуги. Создание и редактирование.',  1, 0, 22),

-- Страницы в разделе «Счет пользователя»
('user-guide', 'page', NULL,              'payments-manual',  18,         'Система платежей Общие сведения.',            1, 0, 34),
('user-guide', 'page', NULL,              'payments-manual',  19,         'Как пополнить баланс',                         1, 0, 35);