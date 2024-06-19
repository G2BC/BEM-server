#### Method: **GET**
#### Path: **apiUrl/api/fungi/taxonomy**
Lista os Cogumelos com base em alguns filtros

##### Body:
*   **taxonomy**: required|string - String de busca que pode ser referente a reino, espécie, gênero, família, filo, classe, ordem, nome científico ou nome popular
*   **bem**: nullable|Enum::BemClassification - Valor referente a classificação BEM de acordo com Enum
*   **stateAc**: nullable|string|max:2 - Sigla do estado de ocorrência
*   **biome**: nullable|string - Bioma de ocorrência
*   **page**: nullable|int - Página da listagem
Ex:
```
{
	"taxonomy": "auricularia",
	"stateAc": "BA",
	"bem": 3,
	"page": 1
}
```

##### Response (200):
Content-Type: application/json
```
{
    "current_page": 1,
    "data": [
        {
            "id": 7,
            "uuid": "8e00bc6d-cbd7-4c05-aecb-5d1226ef62fb",
            "inaturalist_taxa": 905031,
            "bem": 1,
            "kingdom": "Fungi",
            "phylum": "Basidiomycota",
            "class": "Agaricomycetes",
            "order": "Auriculariales",
            "family": "Auriculariaceae",
            "genus": "Auricularia",
            "specie": "brasiliana",
            "scientific_name": "Auricularia brasiliana",
            "popular_name": "",
            "threatened": 0,
            "description": null,
            "created_at": "2024-05-12T08:58:39.000000Z",
            "updated_at": "2024-05-12T08:58:39.000000Z",
            "deleted_at": null,
            "occurrences_count": 8
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/fungi/taxonomy?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/fungi/taxonomy?page=1",
    "links": [
        {
            "url": null,
            "label": "pagination.previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/fungi/taxonomy?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "pagination.next",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/fungi/taxonomy",
    "per_page": 20,
    "prev_page_url": null,
    "to": 8,
    "total": 8
}
```