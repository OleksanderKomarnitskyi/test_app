
Для розвертання проекту вкористати php 8.1 DB MySql 
виконати наступну посліковнісь команд
 

- встановити залежності командою composer install
- створити фаїл .env за зразком .env.example
- запустити генерацію токену php artisan key:generate
- створити базу даних і заповнити підключення
  - DB_DATABASE=test_app
   - DB_USERNAME=root
  - DB_PASSWORD=
- заповнити базу даних командою  php artisan migrate --seed
- створити токени для oauth команодю php artisan passport:install 
- скопіювати отриманий Client secret: у глобальну змінну PASSPORT_GRANT_PASSWORD_CLIENT_SECRET=
- Client ID: повинен відповідати отриманому від passport:install дефолтне значення 2
- Запустити через php artisan serve 
- Або власний варіант


Для аутентифікації і тестів можна використати існуючих користувачів 
- user1@gmail.com
- user2@gmail.com
- user3@gmail.com
- user4@gmail.com

Пароль однаковий - abracadabra 

Або зареєструвати власного користувача

Колекцію запитів Postman можна отримати тут 

https://elements.getpostman.com/redirect?entityId=24523900-d34c22d1-36a1-4b29-a349-100e4409296f&entityType=collection


