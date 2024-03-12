
# Buzzvel Back-end developer test

Uma breve descrição sobre o que esse projeto faz e para quem ele é


## Technologies used in this project

- Laravel Version 10.47.0
    - Laravel Sanctun
    - Laravel Blade
- MySQL Version 5.7.22
- Docker
- Nginx
## Steps to run the project

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

## API Documentation

For create users http://localhost:8989/register.
Once you have registered a user, you will get the bearer token ( in login request ) which will be used in almost all calls.

#### Login EndPoint

```bash
curl --request POST \
  --url 'http://localhost:8989/api/login?email=fernando.gobetti%40hotmail.com.br&password=1234' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/8.6.1'
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `email` | `string` | **Obrigatório**. E-mail informed in http://localhost:8989/register |
| `password` | `string` | **Obrigatório**. Password informed in http://localhost:8989/register |

#### Response data
```http
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


#### Retorna um item

```http
  GET /api/items/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `string` | **Obrigatório**. O ID do item que você quer |

#### add(num1, num2)

Recebe dois números e retorna a sua soma.

