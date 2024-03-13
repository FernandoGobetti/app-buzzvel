
# Buzzvel Back-end developer test



[Project for the Buzzvel challenge](https://github.com/FernandoGobetti/app-buzzvel/blob/main/2024_Back_End_Developer_Test.pdf)



## 🚀 About Me
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/fernando-gobetti/)


Hello, I am a PHP programmer with over five years of experience. Throughout the years, I have honed my skills in PHP and gained a deep understanding of the WordPress, Laravel, and proprietary software ecosystems.

I have experience with popular PHP frameworks such as Laravel and Zend Framework, as well as another CMS for E-commerce, Magento.

In addition to PHP, I also have knowledge in HTML 5, CSS, Sass, JavaScript, jQuery, JAVA, Springboot, React JS, and React-Native.

I am also familiar with relational databases such as MySQL, MariaDB, PostgreSQL, and SQL Server.


## 1. Technologies used in this project

- Laravel Version 10.47.0
    - Laravel Sanctun
    - Laravel Blade
- MySQL Version 5.7.22
- Docker
- Nginx
## 2. Steps to run the project

Clone Repository

```bash
git clone -b main https://github.com/FernandoGobetti/app-buzzvel.git app-buzzvel

cd app-buzzvel
```

Builds, (re)creates, starts, and attaches to containers for a service.
```bash
docker-compose up -d
```

Open the container app
```bash
docker-compose exec app bash
```

Install project dependencies, creates all tables in the database and generate keys
```bash
composer install

php artisan migrate

php artisan key:generate
```
Now you can access the project via the link
[http://localhost:8989](http://localhost:8989), has only one route to create users.

## 3. API Documentation

To make any call, you must first create a user and then log in to get the token.

### Create User EndPoint

```bash
curl --request POST \
  --url 'http://localhost:8989/api/createuser?email={email}&password={password}&name={nameUser}' \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

| Parâmetro  | Tipo       | Descrição                             |
|:-----------| :--------- |:--------------------------------------|
| `email`    | `string` | **Mandatory**. Unique                 |
| `password` | `string` | **Mandatory**. String min:3, max:255  |
| `nameUser` | `string` | **Mandatory**.  String min:3, max:255 |

#### Response data
```json
{
    "email": "fernando.gobetti4@hotmail.com.br",
    "name": "Fernando Gobetti",
    "updated_at": "2024-03-13T02:26:54.000000Z",
    "created_at": "2024-03-13T02:26:54.000000Z",
    "id": 10
}
```
---


### Login EndPoint

```bash
curl --request POST \
  --url 'http://localhost:8989/api/login?email={email}&password={password}' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `email` | `string` | **Mandatory**. E-mail informed in http://localhost:8989/register |
| `password` | `string` | **Mandatory**. Password informed in http://localhost:8989/register |

#### Response data
```json
{
	"message": "Authorized",
	"token": {
		"accessToken": {
			"name": "token",
			"abilities": [
				"*"
			],
			"expires_at": null,
			"tokenable_id": 1,
			"tokenable_type": "App\\Models\\User",
			"updated_at": "2024-03-12T12:58:23.000000Z",
			"created_at": "2024-03-12T12:58:23.000000Z",
			"id": 6
		},
		"plainTextToken": "6|dG29WjNKjyeTLwJuW2z1S1TPeU606K5Am0K52llJdb2d8e65"
	}
}
```
---


### List all Holidays PLan EndPoint

```bash
curl --request GET \
  --url http://localhost:8989/api/holiday \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

#### Response data
```json
 {
	"current_page": 1,
	"data": [
		{
			"id": 239,
			"title": "quo",
			"description": "Quisquam excepturi velit qui sint.",
			"date": "2024-03-11",
			"location": "631 Weston Overpass\r\nWest Luna, WA 08130",
			"created_at": "2024-03-12T01:59:37.000000Z",
			"updated_at": "2024-03-12T01:59:37.000000Z",
			"participants": []
		}
	],
	"first_page_url": "http://localhost:8989/api/holiday?page=1",
	"from": 1,
	"last_page": 1,
	"last_page_url": "http://localhost:8989/api/holiday?page=1",
	"links": [
		{
			"url": null,
			"label": "« Previous",
			"active": false
		},
		{
			"url": "http://localhost:8989/api/holiday?page=1",
			"label": "1",
			"active": true
		},
		{
			"url": null,
			"label": "Next »",
			"active": false
		}
	],
	"next_page_url": null,
	"path": "http://localhost:8989/api/holiday",
	"per_page": 15,
	"prev_page_url": null,
	"to": 1,
	"total": 1
}
```
---


### List one Holidays PLan by ID EndPoint

```bash
curl --request GET \
  --url http://localhost:8989/api/holiday/{id} \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `id` | `int` | **Mandatory**. ID of HolidayPlan |


#### Response data
```json
  {
	"id": 1,
	"title": "New Year",
	"description": "Happy New Year",
	"date": "2031-01-25",
	"location": "Cascavel PR",
	"created_at": null,
	"updated_at": "2024-03-11T00:45:10.000000Z",
	"participants": [
		{
			"id": 1,
			"holiday_plan_id": 1,
			"name": "Fernando",
			"created_at": "2024-03-11T12:45:46.000000Z",
			"updated_at": "2024-03-11T12:45:46.000000Z"
		},
		{
			"id": 2,
			"holiday_plan_id": 1,
			"name": "Silvia",
			"created_at": "2024-03-11T12:45:46.000000Z",
			"updated_at": "2024-03-11T12:45:46.000000Z"
		},
		{
			"id": 3,
			"holiday_plan_id": 1,
			"name": "Fernando Gobetti",
			"created_at": "2024-03-11T12:22:49.000000Z",
			"updated_at": "2024-03-11T12:22:49.000000Z"
		}
	]
}
```
---


### Create Holidays Plan EndPoint

```bash
curl --request POST \
  --url 'http://localhost:8989/api/holiday/?title={title}&description={description}&date={date}&location={location}' \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `title` | `string` | **Mandatory**. min:3, max:255 |
| `description` | `string` | **Mandatory**. min:3, max:255 |
| `date` | `date` | **Mandatory**. Format (Y-m-d) |
| `location` | `string` | **Mandatory**. min:3, max:255 |


#### Response data
```json
  {
	"title": "New Year",
	"description": "Happy new Year",
	"date": "2024-12-31",
	"location": "Cascavel PR",
	"updated_at": "2024-03-12T12:17:11.000000Z",
	"created_at": "2024-03-12T12:17:11.000000Z",
	"id": 240
}
```
---


### Update Holidays Plan EndPoint

Data is passed directly in the URL.

```bash
curl --request PUT \
  --url 'http://localhost:8989/api/holiday/240?title={title}&description={description}&date={date}&location={location}' \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `title` | `string` | **Mandatory**. min:3, max:255 |
| `description` | `string` | **Mandatory**. min:3, max:255 |
| `date` | `date` | **Mandatory**. Format (Y-m-d) |
| `location` | `string` | **Mandatory**. min:3, max:255 |


#### Response data
```json
  {
	"title": "New Year",
	"description": "Happy new Year",
	"date": "2024-12-31",
	"location": "Cascavel PR",
	"updated_at": "2024-03-12T12:17:11.000000Z",
	"created_at": "2024-03-12T12:17:11.000000Z",
	"id": 240
}
```
---

### Delete Holidays Plan EndPoint

```bash
curl --request DELETE \
  --url http://localhost:8989/api/holiday/{id} \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `id` | `int` | **Mandatory**. ID of HolidayPlan |


#### Response data
```json
  {
	"title": "New Year",
	"description": "Happy new Year",
	"date": "2024-12-31",
	"location": "Cascavel PR",
	"updated_at": "2024-03-12T12:17:11.000000Z",
	"created_at": "2024-03-12T12:17:11.000000Z",
	"id": 240
}
```
---


### Create participants EndPoint

```bash
curl --request POST \
  --url 'http://localhost:8989/api/holiday/{idHoliday/participants?name={name}' \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `idHoliday` | `int` | **Mandatory**. ID of HolidayPlan |
| `name` | `string` | **Mandatory**. min:3, max:255 |


#### Response data
```json
[
	{
		"id": 239,
		"title": "quo",
		"description": "Quisquam excepturi velit qui sint.",
		"date": "2024-03-11",
		"location": "631 Weston Overpass\r\nWest Luna, WA 08130",
		"created_at": "2024-03-12T01:59:37.000000Z",
		"updated_at": "2024-03-12T01:59:37.000000Z",
		"participants": []
	},
	{
		"id": 240,
		"title": "New Year - Updated",
		"description": "Happy new Year",
		"date": "2024-12-31",
		"location": "Cascavel PR",
		"created_at": "2024-03-12T12:17:11.000000Z",
		"updated_at": "2024-03-12T12:26:00.000000Z",
		"participants": [
			{
				"id": 1,
				"holiday_plan_id": 240,
				"name": "Fernando Gobetti",
				"created_at": "2024-03-12T17:15:50.000000Z",
				"updated_at": "2024-03-12T17:15:50.000000Z"
			}
		]
	}
]
```
---

## To run the tests

To run the tests, run the following command in app-buzzvel folder

If docker is not running, run this command to turn it on.

```bash
docker-compose up -d
```
This command will enter the container app

```bash
docker-compose exec app bash
```

To run the tests, just run this command

```bash
php artisan test
```
