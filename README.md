# Menu by Parent Category for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0

[![License](https://img.shields.io/badge/license-BSD-blue.svg)](https://github.com/webitproff/cot-menubyparentcat/blob/main/LICENSE)
[![Version](https://img.shields.io/badge/version-2.2.8-green.svg)](https://github.com/webitproff/cot-menubyparentcat/releases)
[![Cotonti Compatibility](https://img.shields.io/badge/Cotonti_Siena-0.9.26-orange.svg)](https://github.com/Cotonti/Cotonti)
[![PHP](https://img.shields.io/badge/PHP-8.4-blueviolet.svg)](https://www.php.net/releases/8_4_0.php)
[![MySQL](https://img.shields.io/badge/MySQL-8.4-blue.svg)](https://www.mysql.com/)


<img width="900" height="600" alt="This is a plugin for creating lists of menu items in a documentation section or a knowledge base of an information or software product" src="https://raw.githubusercontent.com/webitproff/cot-menubyparentcat/refs/heads/main/Menu-by-Parent-Category-for-CMF-Cotonti-Siena-2025_0004.webp" />

# 🇬🇧 English
## This is a plugin for creating lists of menu items in a documentation section or a knowledge base of an information or software product.

It works on the selected parent category and all its child categories, including articles published in them.

# Menu by Parent Category (cot-menubyparentcat)

**Plugin for [CMF Cotonti Siena](https://github.com/Cotonti/Cotonti) 0.9.26+**  
**Version:** 2.2.8  
**License:** BSD  
**Author:** ***[webitproff](https://github.com/webitproff)***

GitHub: https://github.com/webitproff/cot-menubyparentcat

---

## Purpose and Tasks (detailed)

`cot-menubyparentcat` is a plugin for manually constructing a menu based on the selected parent category of the **Page** module.

The **cot-menubyparentcat** plugin was created specifically to give theme developers, module authors, plugin creators, and website owners using Cotonti Siena a **full‑featured, convenient, and flexible tool** for building **online documentation**, **user guides**, **knowledge bases**, or **internal product wikis**.

This is exactly the case when standard auto-generated Cotonti menus (based on category structure or tags) are not suitable:

- they do not allow control over item order  
- drafts or technical pages cannot be hidden  
- sections cannot be renamed into short and clear menu titles  
- no way to place important pages (“Introduction”, “Installation”, “FAQ”) at the top  

**cot-menubyparentcat solves all these problems at once.**

### Main usage scenarios (real cases)

1. **Documentation for a theme**  
   Example: you released a premium theme for Cotonti.  
   You need a “Documentation” section with a clear structure:  
   Introduction → Installation → Configuration → Components → FAQ → Updates  
   Using this plugin, you create the root category `theme-docs`, add the needed subsections and pages in the required order — and you get a perfect menu like https://adminlte.io/themes/v4/docs/

2. **User guide for a plugin or module**  
   You developed a complex plugin (store, freelance marketplace, CRM).  
   Customers need a detailed manual.  
   cot-menubyparentcat allows you to build a menu like:  
   Overview → Registration → Creating a Project → Payment → Disputes → API  
   And you can hide pages still under development.

3. **Knowledge base for a SaaS product**  
   You have an online service based on Cotonti.  
   You need a “Help” section with:  
   Tasks → Services → Wallet → Security → Rules  
   Each section may have dozens of articles, but you display only key ones and hide unfinished materials.

4. **Technical documentation for a framework/library**  
   You ported Bootstrap, Tailwind, or another UI kit to Cotonti.  
   You create documentation like the official one:  
   https://getbootstrap.com/docs/5.3/getting-started/introduction/  
   The plugin allows replicating such structure and behavior.

### What the plugin provides specifically for documentation:

| Feature | Why it is critical for documentation |
|--------|--------------------------------------|
| Manual ordering of items | Sections follow the logic of learning: from simple to advanced |
| Hiding pages without deleting | You can keep drafts invisible to users |
| Title override | Long page titles → short readable labels in the menu |
| Category labels (separators) | Clear visual separation of major documentation blocks |
| Direct links outside categories | Important pages like “Introduction” and “Quick Start” always stay at the top |
| Auto‑highlight of the current item | Users always see where they are in the structure |
| Accordion with article counters | Modern UX similar to official documentation sites |

### Real example of a documentation menu structure:

```
User Guide
├── Introduction
├── Quick Start
├── Registration and Profile
├── Tasks and Projects
│   ├── Creating a Task
│   ├── Choosing a Contractor
│   ├── Work Stages
│   └── Disputes and Arbitration
├── Services
│   ├── Creating a Service
│   ├── Packages and Add-ons
│   └── Reviews
├── Payments and Wallet
│   ├── Top-up
│   ├── Withdrawal
│   └── Transaction History
├── Security
└── Frequently Asked Questions
```

All elements above are either category separators or manually added pages.  
Order, visibility, and titles are fully under your control.

**Key conclusion and main purpose:**

This is a **specialized tool for creating professional online documentation for software or any other product**.

Using **Cotonti + menubyparentcat** you can easily create documentation for your developments or products and organize its menu so users quickly find the needed instructions.

**menubyparentcat** is not just “another menu,” like my plugin [Tree Cats Page Plugin for Cotonti Siena 0.9.26](https://github.com/webitproff/cot-treecatspage) — **menubyparentcat** is an evolution and an essential component of any information product.

Without well‑structured documentation and author support (*plugins, modules, templates, scripts, programs, etc.*), users will have difficulties learning and using your product — free or paid.

Here are **a few examples** of what you can build in terms of **your own online documentation**:

- ***[GitHub Documentation](https://docs.github.com/en/get-started)***
- ***[MODX Documentation](https://docs.modx.com/)***
- ***[AdminLTE 4 (Admin Dashboard Template/theme and Documentation)](https://adminlte.io/themes/v4/index.html)***
- ***[Sneat Dashboard Tamplate Documentation](https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/index.html)***
- ***[DataLife Engine Documentation](https://dle-news.com/extras/online/index.html)***
- ***[OpenCart Documentation](https://docs.opencart.com/en-gb/introduction/)***
- ***[Automatic Price List Processing Module](https://opencartsuppliers.com/en/getting-started/introduction)***
- ***[UIkit v3 – lightweight and modular front-end framework](https://getuikit.com/docs/introduction)***

The plugin **menubyparentcat** allows you to:

- manually control menu structure
- sort categories and pages in any order
- hide individual items without deleting
- override titles
- add pages outside category structure
- use categories as section headers

Ideal for building:

- help sections
- user manuals
- complex FAQ structures
- groups of menus with fully custom structure

## Compatibility and Requirements

- **Cotonti:** Siena 0.9.26+
- **PHP:** 8.1+ (recommended 8.4)
- **MySQL:** 8.0+
- **Page module:** required

The plugin does not conflict with other menus and does not override Cotonti core functions.

---

## Installation

1. Download the archive: https://github.com/webitproff/cot-menubyparentcat
2. Unpack to `plugins/menubyparentcat`
3. In admin panel: **Plugins → Installation → menubyparentcat → Install**
4. After installation open: **Admin → Other → Menu by Parent Category**

---

## Configuration

In the admin panel specify:

```
Parent category code
```

Examples:
- `user-guide`
- `help`
- `docs`

This code is taken from **Pages → Category Code**.

After saving you can add menu items.

---

## Admin Panel: Managing Menu Items

Each item has the following parameters:

### Type

- **Category (cat)** — menu section + automatic loading of pages inside it
- **Page (page)** — direct link to a page

### Fields:

- **Category code / Page ID** — depends on selected type
- **Sort order** — integer, smaller means higher
- **Title override** — custom name if needed
- **Include in menu** — allows hiding the item

### Admin capabilities

- edit item
- delete item
- change order via numeric values
- prevent duplicates — a page is never shown twice

---

## Rendering the Menu on the Site

In any template (e.g. `sidebar.tpl`):

```
{PHP|cot_menubyparentcat_build_tree('user-guide')}
```

If category code is set in plugin settings:

```
{PHP|cot_menubyparentcat_build_tree()}
```

Example:

```html
<div class="sidebar-menu">
    <h5>Help</h5>
    {PHP|cot_menubyparentcat_build_tree('user-guide')}
</div>
```

---

## Output Template

The plugin uses:

`menubyparentcat.tree.tpl`

Features:

- Bootstrap 5 menu structure
- collapsible submenus
- alias (SEO URL) support
- active item highlighting
- category rendering with subpages
- direct-page rendering

---

## Features and Advantages

- full manual control of menu structure
- title overrides
- hidden items support
- direct links to specific pages
- automatic loading of all pages in a category
- duplicate prevention
- correct URL generation
- high performance (indexed queries)

---

## Development and Support

- Repository: https://github.com/webitproff/cot-menubyparentcat
- Issues: use for bugs and feature requests
- Pull Requests: welcome
- Plugin is distributed under the BSD license

If the plugin is useful — please ⭐ the GitHub repo!

---

## Copyright

© webitproff, 27 Nov 2025, License BSD.

---

### You can hire me or propose a task

**send me a message on [this page](https://abuyfile.com/users/webitproff)**

---

# 🇷🇺 Русский

# Menu by Parent Category for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0 
## Это плагин для создания списков пунктов меню в разделе вашей онлайн-документации или базе знаний, информационного или программного продукта, который разрабатываете, поддерживаете или продаете. 
Он работает с выбранной родительской категорией и всеми ее дочерними категориями, включая опубликованные в них статьи. Меню по родительским категориям для CMF Cotonti Siena версии 0.9.26, PHP версии 8.4+, MySQL версии 8.0

# Menu by Parent Category (cot-menubyparentcat)


**Плагин для [CMF Cotonti Siena](https://github.com/Cotonti/Cotonti) 0.9.26+**  
**Версия:** 2.2.8  
**Лицензия:** BSD  
**Автор:** ***[webitproff](https://github.com/webitproff)***

GitHub: https://github.com/webitproff/cot-menubyparentcat

---

## Назначение и решаемые задачи (подробно)
`cot-menubyparentcat` — плагин для ручного конструирования меню на основе выбранной родительской категории модуля **Page**.


Плагин **cot-menubyparentcat** создан специально для одной целью — дать разработчикам тем, модулей, плагинов и владельцам сайтов на Cotonti Siena **полноценный, удобный и красивый инструмент** для создания **онлайн-документации**, **руководства пользователя**, **базы знаний** или **внутренней вики** по своему продукту.

Это именно тот случай, когда стандартные автогенерируемые меню Cotonti (по структуре категорий или по тегам) не подходят:

- они не дают контроля над порядком пунктов  
- нельзя скрыть черновики или технические страницы  
- невозможно переименовать разделы под короткие и понятные названия в меню  
- нет возможности вынести важные страницы («Введение», «Установка», «ЧаВо») наверх списка  

**cot-menubyparentcat решает все эти проблемы разом.**

### Основные сценарии применения (реальные кейсы):

1. **Документация к теме оформления**  
   Пример: вы выпустили премиум-тему под Cotonti.  
   Вам нужно сделать раздел «Документация» с чёткой структурой:  
   Введение → Установка → Настройка → Компоненты → ЧаВо → Обновления  
   С помощью этого плагина вы создаёте корневую категорию `theme-docs`, добавляете туда нужные разделы и страницы в требуемом порядке — и получаете идеальное меню, как у https://adminlte.io/themes/v4/docs/

2. **Руководство пользователя для плагина или модуля**  
   Вы разработали сложный плагин (например, магазин, биржу фриланса, CRM).  
   Покупателям нужна подробная инструкция.  
   cot-menubyparentcat позволяет сделать меню вида:  
   Обзор → Регистрация → Создание проекта → Оплата → Споры → API  
   При этом скрыть страницы, которые ещё в разработке.

3. **База знаний сервиса / SaaS-продукта**  
   У вас интернет-сервис на Cotonti.  
   Нужно отдельное меню «Помощь» с разделами:  
   Задания → Услуги → Кошелёк → Безопасность → Правила  
   В каждом разделе — десятки статей, но в меню вы показываете только основные, а остальные скрываете до завершения.

4. **Техническая документация фреймворка/библиотеки**  
   Вы портировали Bootstrap, Tailwind или другой UI-кит под Cotonti.  
   Делаете документацию по аналогии с официальной:  
   https://getbootstrap.com/docs/5.3/getting-started/introduction/  
   Плагин позволяет в точности повторить такую структуру и внешний вид меню.

### Что даёт плагин именно для документации:

| Возможность                        | Почему критично для документации                            |
|------------------------------------|--------------------------------------------------------------|
| Ручной порядок пунктов             | Разделы идут строго по логике обучения: от простого к сложному |
| Скрытие страниц без удаления       | Можно писать черновики, не показывая их пользователям         |
| Переопределение заголовков         | Длинное название страницы → короткое и понятное в меню       |
| Разделители (заголовки категорий)  | Чёткое визуальное разделение крупных блоков материала        |
| Прямые ссылки вне категорий        | Важные страницы «Введение», «Быстрый старт» всегда сверху    |
| Авто‑подсветка активного пункта    | Пользователь всегда видит, где он находится                |
| Аккордеон с количеством статей     | Современный UX, как в официальных документациях              |

### Реальный пример структуры меню документации:

```
Руководство пользователя
├── Введение
├── Быстрый старт
├── Регистрация и профиль
├── Задания и проекты
│   ├── Создание задания
│   ├── Выбор исполнителя
│   ├── Этапы выполнения
│   └── Споры и арбитраж
├── Услуги
│   ├── Создание услуги
│   ├── Пакеты и допы
│   └── Отзывы
├── Платежи и кошелёк
│   ├── Пополнение
│   ├── Вывод средств
│   └── История операций
├── Безопасность
└── Часто задаваемые вопросы
```

Все пункты выше — это либо категории-разделители, либо вручную добавленные страницы.  
Порядок, видимость и названия — полностью под вашим контролем.


**Исходя из этого и как следствие ключевое назначение:**  
 
Это **специализированный инструмент для создания профессиональной онлайн-документации программного или любого другого продукта** 
Используя **Cotonti + menubyparentcat** легко создать онлайн-документацию для своих разработок или товаров, организовать меню документации так, чтобы пользователь быстро и без путаницы нашёл нужную инструкцию.

**menubyparentcat** — это не просто «ещё одно меню», например мой плагин [Tree Cats Page Plugin for Cotonti Siena 0.9.26](https://github.com/webitproff/cot-treecatspage) - **menubyparentcat** - это эволюция и уже неотъемлимый компонет любого информационного продукта. 
Без хорошо организованной документации и авторской поддержки пользователей вашей разработки(`*`), например, при помощи модуля "форумов" на Cotonti CMF - человеку будет сложно ознакомиться и освоить ваш продукт, не важно платный он или нет.
`*` - (плагин, модуль, шаблон, скрипт, программа и т.д.)

___

Вот **несколько примеров** того, что можно сделать, в части **организации собственной онлайн-документации**:

- ***[Документация по GitHub](https://docs.github.com/ru/get-started)***
- ***[Руководство пользователя UMI.CMS](https://help.docs.umi-cms.ru/)***
- ***[DataLife Engine Documentation](https://dle-news.com/extras/online/index.html)***
- ***[OpenCart Documentation](https://docs.opencart.com/en-gb/introduction/)***
- ***[Модуль «Автоматическая обработка прайс-листов»](https://opencartsuppliers.com/en/getting-started/introduction)***
- ***[UIkit v3 - lightweight and modular front-end framework](https://getuikit.com/docs/introduction)***
- ***[AdminLTE 4 (Admin Dashboard Template/theme and Documentation)](https://adminlte.io/themes/v4/index.html)***
- ***[Sneat Dashboard Tamplate Documentation](https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/index.html)***

___


Он, **menubyparentcat** позволяет:
- вручную управлять структурой меню
- сортировать категории и страницы в любом порядке
- скрывать отдельные элементы без удаления
- переопределять заголовки
- добавлять страницы вне структуры категорий
- использовать категории как заголовки-разделители

Идеально подходит для создания:
- разделов помощи
- пользовательских руководств
- сложных FAQ
- групп меню с вручную созданной структурой


## Совместимость и требования
- **Cotonti:** Siena 0.9.26+
- **PHP:** 8.1+ (рекомендуется 8.4)
- **MySQL:** 8.0+
- **Модуль Page:** обязателен

Плагин не конфликтует с другими меню и не переопределяет стандартные функции Cotonti.

---

## Установка
1. Скачать архив: https://github.com/webitproff/cot-menubyparentcat
2. Распаковать в `plugins/menubyparentcat`
3. В админке перейти: **Плагины → Установка → menubyparentcat → Установить**
4. После установки открыть: **Админка → Другое → Меню по родительской категории**

---

## Настройка
В админке нужно указать:
```
Код родительской категории
```
Например:
- `user-guide`
- `help`
- `docs`

Этот код берётся из структуры модуля **Страницы → Код**.

После сохранения можно добавлять элементы меню.

---

## Админка: управление пунктами меню
Каждый элемент имеет параметры:

### Тип
- **Категория (cat)** — раздел меню + автоматическая загрузка страниц внутри неё
- **Страница (page)** — прямая ссылка на статью

### Поля:
- **Код категории / ID страницы** — список зависит от выбранного типа
- **Порядок сортировки** — целое число, чем меньше, тем выше в меню
- **Переопределённый заголовок** — если нужен свой текст
- **Включать в меню** — можно скрыть элемент

### Возможности админки
- редактирование элемента
- удаление
- смена порядка числовыми значениями
- отсутствие дублей — страница не будет показана дважды

---

## Вывод меню на сайте
В любой шаблон сайта (например, `sidebar.tpl`):
```
{PHP|cot_menubyparentcat_build_tree('user-guide')}
```
Если код категории задан в настройках плагина:
```
{PHP|cot_menubyparentcat_build_tree()}
```
Пример:
```html
<div class="sidebar-menu">
    <h5>Помощь</h5>
    {PHP|cot_menubyparentcat_build_tree('user-guide')}
</div>
```

---

## Шаблон вывода
Плагин использует файл:  
`menubyparentcat.tree.tpl`

В шаблоне реализованы:
- Bootstrap 5 структура меню
- раскрывающиеся подменю
- поддержка alias (ЧПУ)
- активные пункты
- вывод категорий с подстраницами
- вывод прямых страниц

---

## Особенности и преимущества
- полный ручной контроль структуры меню
- переопределяемые заголовки
- поддержка скрытых элементов
- прямые ссылки на конкретные статьи
- автоматическая подгрузка всех страниц категории
- защита от повторов
- корректное формирование URL
- высокая производительность (индексированные запросы)

---

## Разработка и поддержка
- Репозиторий: https://github.com/webitproff/cot-menubyparentcat
- Issues: используйте для багов и запросов фич
- Pull Requests: приветствуются
- Плагин распространяется бесплатно по лицензии BSD

Если плагин оказался полезным — поставьте ⭐ на GitHub!

---

## Авторские права
© webitproff, 27 Nov 2025, License BSD.

--- 
### Вы можете нанять меня или предложить задание 
**напишите в личные сообщения на [этой странице](https://abuyfile.com/users/webitproff)**



