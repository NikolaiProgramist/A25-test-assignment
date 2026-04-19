# A25-test-assignment

[![lint](https://github.com/NikolaiProgramist/A25-test-assignment/actions/workflows/lint.yml/badge.svg)](https://github.com/NikolaiProgramist/A25-test-assignment/actions/workflows/lint.yml)

Тестовое задание для компании A25

## Стек

- PHP 8.5.2
- JS, HTML, CSS
- Composer
- Make
- Git

## Архитектура

В качестве паттерна был выбран **MVC** в упрощённом виде.
Код написан в ООП парадигме. Логика разнесена на отдельные зоны ответственности.

Базовая структура:

```text
├── .env.example                           конфигурация
├── .github
│   └── workflows
│       └── lint.yml                       CI
├── Makefile                               команды
├── public
│   ├── index.php                          инициализация и роутинг
│   └── resources                          ресурсы
│       ├── css
│       ├── js                             асинхронная отправка данных и генерация CSV файла
│       └── views
└── src
    ├── Api
    │   └── YandexTrackerClient.php        клиент для работы с Яндекс Трекером
    └── Controllers
        └── TaskController.php             контроллер для работы с задачами
```

## Зависимости

- guzzlehttp/guzzle - для работы с API
- vlucas/phpdotenv - для работы с конфигурацией
- squizlabs/php_codesniffer - линтинг
- symfony/var-dumper - дебаггинг

## Преимущества

- Используются новые возможности PHP 8.5 -> [**Встроенный модуль URI**](https://www.php.net/releases/8.5/ru.php#new-uri-extension)
- Сервер стартует в директории public, предотвращая доступ к непубличным файлам сервера (уязвимость **Path Traversal**)
- Организован CI в рамках **github actions** (линтер, проверка безопасности зависимостей)

## Запуск

1. Склонируйте репозиторий:

```shell
git clone https://github.com/NikolaiProgramist/A25-test-assignment.git
cd A25-test-assignment
```

2. Установите зависимости:

```shell
make install
```

3. Скопируйте `.env.example` в `.env`:

```shell
cp .env.example .env
```

4. Укажите ваши переменные окружения в `.env`:

```text
YANDEX_TRACKER_TOKEN=token
YANDEX_TRACKER_ORG_ID=id
YANDEX_TRACKER_QUEUE=queue
```

5. Запустите сервер:

```shell
make start
```

6. Веб-сервис будет доступен по ссылке: [http://0.0.0.0:8000/tasks](http://0.0.0.0:8000/tasks)

## Линтер

```shell
make lint
```
