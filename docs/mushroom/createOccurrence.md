#### Method: **POST**
#### Path: **apiUrl/api/mushroom/{uuid}/occurrence/create**
Cadastra uma nova observação de ocorrência de literatura no sistema

##### Authorization:
*   **Bearer**

##### Body:
*	**state_acronym**: required|Enum:StatesAcronyms
*	**habitat**: required|string|max:255
*	**literature_reference**: required|string|max:255,,
*	**latitude**: required|numeric
*	**longitude**: required|numeric,

Ex:
```
{		            
	"state_acronym": "BA",
	"habitat": "Parque da Cidade",
	"literature_reference": "Pedro et al.,2024",
	"latitude": -30.0368176,
	"longitude": -51.2089887
}
```

##### Response (200):
Content-Type: application/json
```
{
	"id": 70,
	"uuid": "275fc25e-c628-4f5c-adbe-fba62f2d83aa",
	"inaturalist_taxa": null,
	"type": 1,
	"state_acronym": "BA",
	"state_name": "Bahia",
	"habitat": "",
	"literature_reference": "Pedro et al.,2024",
	"latitude": -30.0368176,
	"longitude": -51.2089887,
	"created_at": "2024-06-19T01:50:41.000000Z",
	"updated_at": "2024-06-19T01:50:41.000000Z",
	"deleted_at": null,
	"curation": false,
	"specieslink_id": null
}
```