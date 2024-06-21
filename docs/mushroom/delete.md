#### Method: **DELETE**
#### Path: **apiUrl/api/mushroom/{uuid}/delete**
remove um cogumelo do sistema por exclusão lógica

##### Authorization:
*   **Bearer**

##### Param:
*   **uuid**: required|string| - UUID do registro do cogumelo no sistema

##### Response (200):
Content-Type: application/json
```
{
	"message": "Espécie removida"
}
```