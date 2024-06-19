#### Method: **GET**
#### Path: **apiUrl/api/fungi/mushroom/{uuid}**
Retorna um registro de cogumelo pelo seu UUID e suas ocorrencias


##### Param:
*   **uuid**: required|string| - UUID do registro do cogumelo no sistema
Ex:
```
apiUrl/api/fungi/cc281c16-f7d1-469d-84a7-c0efd09c6e65
```


##### Response (200):
Content-Type: application/json
```
{
	"id": 1,
	"uuid": "cc281c16-f7d1-469d-84a7-c0efd09c6e65",
	"inaturalist_taxa": 985940,
	"bem": 1,
	"kingdom": "Fungi",
	"phylum": "Basidiomycota",
	"class": "Agaricomycetes",
	"order": "Agaricales",
	"family": "Agaricaceae",
	"genus": "Agaricus",
	"specie": "meijeri",
	"scientific_name": "Agaricus meijeri",
	"popular_name": "",
	"threatened": 0,
	"description": null,
	"created_at": "2024-05-08T06:15:30.000000Z",
	"updated_at": "2024-05-08T06:15:30.000000Z",
	"deleted_at": null,
	"occurrences": [
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
			"specieslink_id": null,
			"pivot": {
				"fungi_id": 1,
				"occurrence_id": 1
			}
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
			"specieslink_id": null,
			"pivot": {
				"fungi_id": 1,
				"occurrence_id": 2
			}
		}
	]
}
```