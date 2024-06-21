#### Method: **GET**
#### Path: **apiUrl/api/occurrence**
Lista as ocorrencias registradas no sistema, opcionalmente pode se escolher as aprovadas ou pendentes de curadoria

##### Param:
*   **curation**: nullable|int - Filtro para curadoria; se 1 lista ocorrencias aprovadas; se 0 lista ocorrencias pendentes; se null lista todas
Ex:
```
apiUrl/api/occurrence?curation=1
```

##### Response (200):
Content-Type: application/json
```
[
	{
		"id": 1,
		"uuid": "b1c28a56-9365-4f3a-8539-138cc39d563f",
		"inaturalist_taxa": null,
		"type": 1,
		"state_acronym": "PR",
		"state_name": "Paraná",
		"habitat": "Atlantic Rainforest",
		"literature_reference": null,
		"latitude": null,
		"longitude": null,
		"created_at": "2024-05-31T13:35:06.000000Z",
		"updated_at": "2024-05-31T13:35:06.000000Z",
		"deleted_at": null,
		"curation": true,
		"specieslink_id": null
	},
	{
		"id": 2,
		"uuid": "c551d511-a905-4fec-bd89-1bbfdde2be32",
		"inaturalist_taxa": null,
		"type": 1,
		"state_acronym": "RS",
		"state_name": "Rio Grande do Sul",
		"habitat": "",
		"literature_reference": null,
		"latitude": null,
		"longitude": null,
		"created_at": "2024-05-31T13:35:06.000000Z",
		"updated_at": "2024-05-31T13:35:06.000000Z",
		"deleted_at": null,
		"curation": true,
		"specieslink_id": null
	}
]
```