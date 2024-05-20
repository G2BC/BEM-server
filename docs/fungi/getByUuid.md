#### Path: **apiUrl/api/fungi/mushroom/{uuid}**
Retorna um registro de cogumelo pelo seu UUID


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
	"deleted_at": null
}
```