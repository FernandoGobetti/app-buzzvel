
# Buzzvel Back-end developer test

### Steps to run the project
Clone Repository
```sh
git clone -b main https://github.com/FernandoGobetti/app-buzzvel.git app-buzzvel

cd app-buzzvel
```

Builds, (re)creates, starts, and attaches to containers for a service.
```sh
docker-compose up -d
```

Open the container app
```sh
docker-compose exec app bash
```

Install project dependencies and generate keys
```sh
composer install

php artisan key:generate
```
Now you can access the project via the link
[http://localhost:8989](http://localhost:8989), has only one route to create users.


# API EndPoint

### Register
For create users http://localhost:8989/register. <br>
Once you have registered a user, you will get the bearer token ( in login request ) which will be used in almost all calls.

## Login EndPoint
Just use the email and password created in /register.
```bash
curl --request POST \
  --url http://localhost:8989/api/login \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1' \
  --data '{
	"email": "fernando.gobetti@hotmail.com.br",
	"password": "1234"
}'
```
### Login Response 
```bash
  #Data response example
  
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
			"updated_at": "2024-03-11T17:11:50.000000Z",
			"created_at": "2024-03-11T17:11:50.000000Z",
			"id": 4
		},
		"plainTextToken": "4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e"
	}
}
```

## List all Holidays PLan EndPoint
```bash
curl --request GET \
  --url http://localhost:8989/api/holiday \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```
### List all Holidays PLan Response
```bash
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
	"first_page_url": "http:\/\/localhost:8989\/api\/holiday?page=1",
	"from": 1,
	"last_page": 1,
	"last_page_url": "http:\/\/localhost:8989\/api\/holiday?page=1",
	"links": [
		{
			"url": null,
			"label": "&laquo; Previous",
			"active": false
		},
		{
			"url": "http:\/\/localhost:8989\/api\/holiday?page=1",
			"label": "1",
			"active": true
		},
		{
			"url": null,
			"label": "Next &raquo;",
			"active": false
		}
	],
	"next_page_url": null,
	"path": "http:\/\/localhost:8989\/api\/holiday",
	"per_page": 15,
	"prev_page_url": null,
	"to": 1,
	"total": 1
}
```

## List one Holidays PLan by ID EndPoint
```bash
curl --request GET \
  --url http://localhost:8989/api/holiday/1 \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```
### List one Holidays PLan by ID Response
```bash
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

## Create Holidays Plan EndPoint

Data is passed directly in the URL.
```bash
curl --request POST \
  --url 'http://localhost:8989/api/holiday/?title=New%20Year&description=Happy%20new%20Year&date=2024-12-31&location=Cascavel%20PR' \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```
### Create Holidays Plan Response
```bash
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

## Update Holidays Plan EndPoint

Data is passed directly in the URL.
```bash
curl --request PUT \
  --url 'http://localhost:8989/api/holiday/240?title=New%20Year%20-%20Updated&description=Happy%20new%20Year&date=2024-12-31&location=Cascavel%20PR' \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer 4|VZG6gvmtTXobiDbQL88x7qX98EiNZaQZSgYDtmOZ9c66b41e' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```
### Update Holidays Plan Response
```bash
{
	"id": 240,
	"title": "New Year - Updated",
	"description": "Happy new Year",
	"date": "2024-12-31",
	"location": "Cascavel PR",
	"created_at": "2024-03-12T12:17:11.000000Z",
	"updated_at": "2024-03-12T12:26:00.000000Z"
}
```
