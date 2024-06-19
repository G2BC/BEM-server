#### Method: **POST**
#### Path: **apiUrl/api/auth/login**
Autentica um usuario no sistema

##### Body:
*   **email**: required - Email
*   **password**: required - Senha
Ex:
```
{
	"email": "123@email.com",
	"password": "123456"
}
```

##### Response (200):
Content-Type: application/json
```
{
	"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTc4OTk1ODEsImV4cCI6MTcxNzkwMzE4MSwibmJmIjoxNzE3ODk5NTgxLCJqdGkiOiJiZ0Z0WlZRTzl1THUyaGhDIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.VLcmpo3fhlvt1Gh31oiG2VnNRo-nR0QRF4523DDsldE",
	"token_type": "bearer",
	"expires_in": 3600
}
```