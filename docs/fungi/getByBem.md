#### Path: **apiUrl/fungi/bem/{id}**

##### Body:
*   **id**: required|int - Id da classificação BEM
Ex:
```
apiUrl/fungi/bem/1
```

##### Response (200):
Content-Type: application/json
```
[
	{
        "id": 4,
        "uuid": "2fb2213f-8134-43f1-a78d-1b743cd3f14f",
        "inaturalist_taxa": null,
        "bem": 1,
        "kingdom": "Fungi",
        "phylum": "Basidiomycota",
        "class": "Agaricomycetes",
        "order": "Polyporales",
        "family": "Polyporaceae",
        "genus": "Amauroderma",
        "specie": "omphalodes",
        "scientific_name": "Amauroderma omphalodes",
        "popular_name": "",
        "threatened": 0,
        "description": null,
        "created_at": "2024-05-12T08:58:37.000000Z",
        "updated_at": "2024-05-12T08:58:37.000000Z",
        "deleted_at": null,
        "occurrences_count": 13
    }
]
```