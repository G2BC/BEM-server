#### Method: **PATCH**
#### Path: **apiUrl/api/occurrence/{uuid}/update**
Atualiza uma observação de ocorrência no sistema

##### Authorization:
*   **Bearer**

##### Body:
*	**state_acronym**: nullable|Enum:StatesAcronyms
*	**habitat**: nullable|string|max:255
*	**literature_reference**: nullable|string|max:255,,
*	**latitude**: nullable|numeric
*	**longitude**: nullable|numeric,

Ex:
```
{		            
	"state_acronym": "RS",
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
	"state_acronym": "RS",
	"state_name": "Rio Grande do Sul",
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