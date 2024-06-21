#### Method: **GET**
#### Path: **apiUrl/api/occurrence/{uuid}**
Retorna um registro de ocorrencia pelo seu UUID


##### Param:
*   **uuid**: required|string| - UUID do registro do ocorrencia no sistema
Ex:
```
apiUrl/api/fungi/275fc25e-c628-4f5c-adbe-fba62f2d83aa
```


##### Response (200):
Content-Type: application/json
```
{
	"id": 69899,
	"uuid": "275fc25e-c628-4f5c-adbe-fba62f2d83aa",
	"inaturalist_taxa": 99338606,
	"type": 2,
	"state_acronym": "RS",
	"state_name": "Rio Grande do Sul",
	"habitat": "",
	"literature_reference": null,
	"latitude": -30.0368176,
	"longitude": -51.2089887,
	"created_at": "2024-06-19T01:50:41.000000Z",
	"updated_at": "2024-06-19T01:50:41.000000Z",
	"deleted_at": null,
	"curation": false,
	"specieslink_id": null
}
```