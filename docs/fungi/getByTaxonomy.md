#### Path: **apiUrl/api/fungi/taxonomy**

##### Body:
*   **taxonomy**: required|string - String de busca que pode ser referente a reino, espécie, gênero, família, filo, classe, ordem, nome científico ou nome popular
*   **bem**: nullable|Enum::BemClassification - Valor referente a classificação BEM de acordo com Enum
*   **stateAc**: nullable|string|max:2 - Sigla do estado de ocorrência
*   **biome**: nullable|string - Bioma de ocorrência
Ex:
```
{
	"taxonomy": "auricularia",
	"stateAc": "BA",
	"bem": 3
}
```

##### Response (200):
Content-Type: application/json
```
[
	{
		"id": 103,
		"uuid": "f6f25999-a9f5-4480-b3f0-ad087be9f6fe",
		"inaturalist_taxa": 328245,
		"bem": 3,
		"kingdom": "Fungi",
		"phylum": "Basidiomycota",
		"class": "Agaricomycetes",
		"order": "Auriculariales",
		"family": "Auriculariaceae",
		"genus": "Auricularia",
		"specie": "delicata",
		"scientific_name": "Auricularia delicata",
		"popular_name": "",
		"threatened": 0,
		"description": null,
		"created_at": "2024-05-08T06:16:38.000000Z",
		"updated_at": "2024-05-08T06:16:38.000000Z",
		"deleted_at": null,
		"occurrences_count": 11
	}
]
```