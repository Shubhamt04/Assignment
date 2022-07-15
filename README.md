# Assignment 1:
Create secure APIs and CRUD application:
1. api to create student
2. list all the students with global search parameter on all the column

Common things for both APIs-
1) Use basic auth for authorization.

2) Post method for input data with JSON payload.
3) Log statements at appropriate places.
4) Db transaction to be maintained.
5) Input validations.

# Assignment 2:
Create a user CRUD operation with image upload.
Things to be implemented
1) Input validation on both side frontend and backend
2) On update or delete image should be maintained accordingly
3) Search and pagination need to be added on user list page
4) Use only eloquent query structure

# How to test:

### prerequisite
1. Laravel 8
2. Mysql 5.7
3. PHP 7.4
4. Node v12.12

## Assignment 1:

1. API to create student:
  - First register a user.
  Curl to register new user:
  
  `curl --location --request POST 'http://127.0.0.1:8000/api/register' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IkNhaWZHQm5OZzh2M3lnN0Z6dVZOMVE9PSIsInZhbHVlIjoiYlFuSjhRMkFYNGt1VnM3THN2a0dZaFZjL0tnaWlTU0dzbXp5TGZqdTREV2FadzhobXIwODUwVmNMYS9xSVRJd003a05tQ2hYVUIxYTJvR01KK2VVT2JkUWtiU2hvVWlqZ2tiNXp6cDkzRUE0TUJGKzROcnZyNStWK3Q3N0VOYVkiLCJtYWMiOiIxMDg0M2FjOGUwM2IxNzgyMjA5NjY5Y2M3ZWRhNzc5YTE0ZjNkNzgzMTVmMjRhZjlkN2NkYmFjNGUwYmI3OGExIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IkpjR3ladFcrS0Rhbzc2UW1CZnN5TUE9PSIsInZhbHVlIjoiK0htYmRweHJJTDJLWDkxSmlwWU9kY0pvaFk5SGp2bnJXQVFtOW9UQkFjYXVPeGs5S296MldwdlBSaWxKbmpNTHgxbXQ2M0pkcTdVNHRlTVQzWGF5bFFhNXk0bHlPYWJINVRrd0lzdFhpU01OMjF3U3dETkk5Nys2Znorb0dVREciLCJtYWMiOiI2Mzc4YTY5YzhmOTMyN2JmZjJlMWQ0MGY2ZjY3ZmQ4YmM2NzNkYTlmZDQ5MTZjNTI3NWUxYTUzN2JiNmJmNWFhIiwidGFnIjoiIn0%3D' \
--form 'name="yourname"' \
--form 'email="your@email.com"' \
--form 'password="password"'`

  - Login with user credential to generate bearer token:
    - Curl user login:
    
      `curl --location --request POST 'http://127.0.0.1:8000/api/login' \
--form 'email="your@email.com"' \
--form 'password="password"'`

  - Create new student from API.
    - Curl to create new user:
    
      `curl --location --request POST 'http://127.0.0.1:8000/api/student/create' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 14|OQ9ZwTLblZwcrtRVK4EdTdNiJ4MISF0W4PgITEEPC' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IkNhaWZHQm5OZzh2M3lnN0Z6dVZOMVE9PSIsInZhbHVlIjoiYlFuSjhRMkFYNGt1VnM3THN2a0dZaFZjL0tnaWlTU0dzbXp5TGZqdTREV2FadzhobXIwODUwVmNMYS9xSVRJd003a05tQ2hYVUIxYTJvR01KK2VVT2JkUWtiU2hvVWlqZ2tiNXp6cDkzRUE0TUJGKzROcnZyNStWK3Q3N0VOYVkiLCJtYWMiOiIxMDg0M2FjOGUwM2IxNzgyMjA5NjY5Y2M3ZWRhNzc5YTE0ZjNkNzgzMTVmMjRhZjlkN2NkYmFjNGUwYmI3OGExIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IkpjR3ladFcrS0Rhbzc2UW1CZnN5TUE9PSIsInZhbHVlIjoiK0htYmRweHJJTDJLWDkxSmlwWU9kY0pvaFk5SGp2bnJXQVFtOW9UQkFjYXVPeGs5S296MldwdlBSaWxKbmpNTHgxbXQ2M0pkcTdVNHRlTVQzWGF5bFFhNXk0bHlPYWJINVRrd0lzdFhpU01OMjF3U3dETkk5Nys2Znorb0dVREciLCJtYWMiOiI2Mzc4YTY5YzhmOTMyN2JmZjJlMWQ0MGY2ZjY3ZmQ4YmM2NzNkYTlmZDQ5MTZjNTI3NWUxYTUzN2JiNmJmNWFhIiwidGFnIjoiIn0%3D' \
--data-raw '{
    "name" : "name",
    "email" : "email@email.com",
    "phone_number" : "998676737",
    "calling_code" : "51"
}'`

2. API to ist all the students with global search parameter on all the column: 
  - Curl for search API:
  
  `curl --location --request GET 'http://127.0.0.1:8000/api/student/search/?search_term=51' \
--header 'Authorization: Bearer 11|fSIDhe4FHRqTR1hF9oE8419x1jCdFyuXdPdiqf7j' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IkNhaWZHQm5OZzh2M3lnN0Z6dVZOMVE9PSIsInZhbHVlIjoiYlFuSjhRMkFYNGt1VnM3THN2a0dZaFZjL0tnaWlTU0dzbXp5TGZqdTREV2FadzhobXIwODUwVmNMYS9xSVRJd003a05tQ2hYVUIxYTJvR01KK2VVT2JkUWtiU2hvVWlqZ2tiNXp6cDkzRUE0TUJGKzROcnZyNStWK3Q3N0VOYVkiLCJtYWMiOiIxMDg0M2FjOGUwM2IxNzgyMjA5NjY5Y2M3ZWRhNzc5YTE0ZjNkNzgzMTVmMjRhZjlkN2NkYmFjNGUwYmI3OGExIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IkpjR3ladFcrS0Rhbzc2UW1CZnN5TUE9PSIsInZhbHVlIjoiK0htYmRweHJJTDJLWDkxSmlwWU9kY0pvaFk5SGp2bnJXQVFtOW9UQkFjYXVPeGs5S296MldwdlBSaWxKbmpNTHgxbXQ2M0pkcTdVNHRlTVQzWGF5bFFhNXk0bHlPYWJINVRrd0lzdFhpU01OMjF3U3dETkk5Nys2Znorb0dVREciLCJtYWMiOiI2Mzc4YTY5YzhmOTMyN2JmZjJlMWQ0MGY2ZjY3ZmQ4YmM2NzNkYTlmZDQ5MTZjNTI3NWUxYTUzN2JiNmJmNWFhIiwidGFnIjoiIn0%3D'`


## Assignment 2:

1. Create a user CRUD operation with image upload.
  - Visit index page of persons ` http://localhost:8000/persons` in the browser.
  - In this application, user can create, update and delete persons info.
  
  ![image](https://user-images.githubusercontent.com/85024827/178144726-b6320ffc-66e2-4c7f-9f79-c5dd9b0b1e7d.png)


