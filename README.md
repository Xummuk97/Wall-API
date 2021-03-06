# Wall-API
Проект разработан на собственном фреймворке и обеспечивает API для работы с доской сообщений.

# Базовая идея
Пользователи регистрируются, входят и пищут сообщения.
Пользователи могут удалять сообщения, но только свои и только если срок их создания больше суток.

# Функционал проекта
- Регистрация пользователя
- Вход пользователя
- Выход пользователя
- Добавить сообщение
- Просмотреть сообщения
- Удалить сообщение

# Особенности проекта
- Вход пользователя происходит на сервере и храниться в сессии
- Пароли хешируются
- При ошибках будет особый ответ в виде JSON: { "Errors": Ошибки/Ошибка }
- Если не поступило ответа, значит операция была выполнена успешно

# Подробное описание проекта

# Регистрация пользователя
URI адрес: 
```
user/register
```
POST запрос: 
```
"email": E-Mail, "password": Пароль
```
JSON ответ: 
```
- или ошибка
```

# Вход пользователя
URI адрес: 
```
user/login
```
POST запрос: 
```
"email": E-Mail, "password": Пароль
```
JSON ответ: 
```
- или ошибка
```

# Выход пользователя
URI адрес: 
```
user/logout
```
POST запрос: 
```
-
```
JSON ответ: 
```
- или ошибка
```

# Добавить сообщение
URI адрес: 
```
message/add
```
POST запрос: 
```
"text": Текст сообщения
```
JSON ответ: 
```
{ "id": Идентификатор добавленного сообщения, "createtime": Дата, время добавленного сообщения } или ошибка
```

# Просмотреть сообщения
URI адрес: 
```
messages
```
POST запрос: 
```
"limit": Количество выводимых сообщений, "offset": Смещение сообщений
```
JSON ответ: 
```
{ [ все поля из таблицы messages ] } или ошибка
```

# Удалить сообщение
URI адрес: 
```
message/delete
```
POST запрос: 
```
"id": Идентификатор сообщения
```
JSON ответ: 
```
- или ошибка
```
