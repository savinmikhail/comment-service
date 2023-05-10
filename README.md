<h1 align="center">Comment-service</h1>
  <p> Этот проект реализован с помощью PHP 8.0 , фреймворка Laravel, СУБД PostgreSql.
 <h2>Описание:</h2>
  <p> Сервис комментариев с использованием четырех API методов: POST, PUT, GET и DELETE. Можно ответить на комментарий, а также
получить полное дерево комментариев.</p>
<h2>Функционал сервиса:</h2>
<ul>

- регистрация пользователя;
- авторизация пользователя осуществляется с помощью токенов доступа Bearer;
- создание комментария, возможность указать комментарию родительский комментарий;
- получение полного дерева комментариев;  
- входные и выходные данные передаются в формате JSON;
</ul>

<h2>API:</h2>
<ul>
  

- POST /api/users/ - Регистрация пользователя 

- POST /api/login - Авторизация пользователя, выдается JWT токен  


 ___

- GET /api/comment/{id}- Получение комментария

- POST /api/comment- Создание комментария

- PUT /api/comment/{id} - Редактирование комментария

- DELETE /api/comment/{id} - Удаление комментария




</ul>

<h2> Чтобы запустить проект, выполните следующие шаги:</h2>

1. Создайте контейнеры:

```make dev-build```

2. Запустите их:

```make dev-up```

3. Проверьте созданные docker-контейнеры:

```make dev-ps```

4. Создайте таблицы:

```make migrate``` 

5. Перейдите в Postman для тестирования.

6. Создайте пользователя, отправив POST запрос на http://localhost:81/api/users с телом содержащим 
    ```
    {
        "email": "example@email.com",
        "password": "qwerty123"
    }
    ```
   в формате row, JSON. 

7. Авторизуйтесь, отправив POST запрос на http://localhost:81/api/login, cкопируйте токен из Header -> Authorization. 

8. Создайте комментарий, отправив POST запрос на http://localhost:81/api/comment с телом 
    ```
    {
        "text": "mikhail.d.savin@gmail.com",
        "user_id": 123
    }
    ```
    Во вкладке Authorization в поле Type выберите Bearer token. В поле token вставьте скопированный токен. 
    
9. Получите комментарий, отправив запрос GET на http://localhost:81/api/comment/1. Не забывайте использовать токен. 

10. Создайте дочерний комментарий, отправив POST запрос на http://localhost:81/api/comment с телом
    ```
    {
        "text": "mikhail.d.savin@gmail.com",
        "user_id": 123,
        "parent_id": 1
    }
    ```
11. Получите комментарий, отправив запрос GET на http://localhost:81/api/comment/2.

12. Измените комментарий, используя PUT. 


# CommentService
