# Тестовое задание на должность "Junior-разбработчик" в компанию startmedia.

- Кандидат: Переймак Макарий Романович.
* <a href="https://t.me/@makar359" target="_blank>telegram</a>
* <a href="mailto:pereymak2012galina@yandex.ru" target="_blank>email</a>
* [email](<pereymak2012galina@yandex.ru>)
* [telegram](<https://t.me/@makar359>)

```
├── .vscode/
├── dateBase/                       # папка для имитации базы данных
    ├── data_attempts.json          # список результатов каждой попытки заездов
    ├── data_cars.json              # список участников
├── src
    ├── sass/
        ├── variables/
            ├── dinamic.scss        # переменные генерируемые index.php файлом на основании количества заездов и участиков
            ├── static.scss
        ├── global.scss
        ├── index.scss
        ├── modal.scss
        ├── table.scss
    ├── templates/                  # php шаблоны
        ├── layout.php
        ├── table.php
    ├── ts/
        ├── animation.ts            # Реализация создания модального окна для показа победителя
    ├── util/
        ├── helpers.php
├── .gitignore
├── .stylelintignore
├── .stylelintrc
├── gulpfile.js                     # gulpfile сборщика
├── package-lock.json
├── package.json
├── Readme.md
├── index.php                       # точка входа в приложение
```

### Описание

После форка необходимо выполнить две команды.

#### 1. Для установки необходимых зависимостей

```
npm i
```

#### 1. Для компиляции css и ts файлов

```
npm run build
```

### Личный комментарий

В процессе выполнения задания постарался показать необходимые для трудоустройства навыки и знания технологий.
Считаю важным также донести, что я осознаю, что некоторые вещи некорректы для использования в production разработке.
Создание класса для прямой манипуляции с DOM деревом выглядит сомнительно в современных реалиях, однако я сделал это дабы
продемонстрировать уменение работать с ts и ООП.

Ссылка на задеплоинное задание для более быстрого визуального ознакомления.
http://f0790772.xsph.ru/
