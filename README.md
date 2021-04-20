Есть три типа файлов (json, csv, xml), в которых перечислены страны и их столицы. Необходимо разаработать интерфейс, с помощью которого можно было бы загружать
этот файл, выводить его содержимое на экран, редактировать и скачивать отредактированный вариант в любом из вышеперечисленных форматов.
Основные требования:
1. Главная страница содержит форму загрузки файлов
2. После упешной загрузки отображается интерфейс редактирования списка, который позволяет:
а. Добавлять данные
б. Изменять данные
в. Удалять данные
3. На странице редактирования находится кнопка "скачать" и выбор формата для скачивания в виде дропдауна с вариантами (json, csv, xml)
4. Известно, что вскоре будут добавлены новые форматы данных, однако нет информации какие именно
5. В качестве инструментов используем Laravel и Vue.js/jquery/js
6. Написать Unit тесты *
7. Написать консольную комманду, которая будет конвертировать списки из одного формата в другой.
Например "php artisan convert:countries --input-file=countries.xml --output-file=countries.json"


Критерии оценки:
1. Масштабируемость кода
2. Читабельность кода
3. Тестируемость кода *

Примеры файлов прилагаются
* Пункты со звёздочкой не обязательны

## Project set up

- Clone the repository
- Edit your /etc/hosts file, add line:  
  `127.0.0.1	countries-test-task-app.test`
- Run  
 `docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/opt \
  -w /opt \
  laravelsail/php80-composer:latest \
  composer install --ignore-platform-reqs`
  to install dependencies
- Copy .env.example file as .env and edit your credentials if needed
- Run `./vendor/bin/sail up -d`
- Run `./vendor/bin/sail npm install` to install npm packages
- Run `./vendor/bin/sail npm run prod` to compile scripts

The app is ready
