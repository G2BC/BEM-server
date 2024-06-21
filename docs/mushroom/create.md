#### Method: **POST**
#### Path: **apiUrl/api/mushroom/create**
Cadastra um novo cogumelo no sistema

##### Authorization:
*   **Bearer**

##### Body:
*   **inaturalist_taxa**: nullable|int|unique:fungi,inaturalist_taxa - Identificação iNaturalist
*   **bem**: nullable|Enum:BemClassification - Classificação BEM
*   **kingdom**: required|string|max:255 - Reino
*   **phylum**: required|string|max:255 - Filo
*   **class**: required|string|max:255 - Classe
*   **order**: required|string|max:255 - Ordem
*   **family**: required|string|max:255 - Familia
*   **genus**: required|string|max:255 - Gênero
*   **specie**: required|string|max:255 - Espécies
*   **scientific_name**: required|string|max:255 -  Nome Científico
*   **authors**: nullable|string|max:255 - Autores
*   **brazilian_type**: nullable|char:1 - Marcação Tipo Brasileira
*   **brazilian_type_synonym**: nullable|char:2 - Marcação Sinônimo Tipo Brasileira
*   **popular_name**: nullable|string|max:255 - Nome Popular
*   **threatened**: nullable|Enum:RedListClassification - Nivel de Ameaça de Extinção
*   **description**: nullable|string|max:255 - Descrição

Ex:
```
{		
    "inaturalist_taxa": null,
    "bem": 1,
    "kingdom": "Fungi",
    "phylum": "Basidiomycota",
    "class": "Agaricomycetes",
    "order": "Agaricales",
    "family": "Agaricaceae",
    "genus": "Agaricus",
    "specie": "peijeri",
    "scientific_name": "Agaricus peijeri",
    "popular_name": "",
    "threatened": 0,
    "description": "criei agora"
}
```

##### Response (200):
Content-Type: application/json
```
{
	"inaturalist_taxa": null,
	"bem": 1,
	"kingdom": "Fungi",
	"phylum": "Basidiomycota",
	"class": "Agaricomycetes",
	"order": "Agaricales",
	"family": "Agaricaceae",
	"genus": "Agaricus",
	"specie": "peijeri",
	"scientific_name": "Agaricus peijeri",
	"popular_name": null,
	"threatened": 0,
	"description": "criei agora",
	"uuid": "14e8c840-7e0a-405c-9b93-6fd972a768ea",
	"updated_at": "2024-06-21T14:14:32.000000Z",
	"created_at": "2024-06-21T14:14:32.000000Z",
	"id": 540
}
```