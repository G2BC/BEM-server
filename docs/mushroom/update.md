#### Method: **PATCH**
#### Path: **apiUrl/api/mushroom/{uuid}/update**
Atualiza um cogumelo do sistema

##### Authorization:
*   **Bearer**

##### Param:
*   **uuid**: required|string| - UUID do registro do cogumelo no sistema

##### Body:
*   **inaturalist_taxa**: nullable|int|unique:fungi,inaturalist_taxa - Identificação iNaturalist
*   **bem**: nullable|Enum:BemClassification - Classificação BEM
*   **kingdom**: nullable|string|max:255 - Reino
*   **phylum**: nullable|string|max:255 - Filo
*   **class**: nullable|string|max:255 - Classe
*   **order**: nullable|string|max:255 - Ordem
*   **family**: nullable|string|max:255 - Familia
*   **genus**: nullable|string|max:255 - Gênero
*   **specie**: nullable|string|max:255 - Espécies
*   **scientific_name**: nullable|string|max:255 -  Nome Científico
*   **authors**: nullable|string|max:255 - Autores
*   **brazilian_type**: nullable|char:1 - Marcação Tipo Brasileira
*   **brazilian_type_synonym**: nullable|char:2 - Marcação Sinônimo Tipo Brasileira
*   **popular_name**: nullable|string|max:255 - Nome Popular
*   **threatened**: nullable|Enum:RedListClassification - Nivel de Ameaça de Extinção
*   **description**: nullable|string|max:255 - Descrição

Ex:
```
{		
	"description": "atualizei"
}
```

##### Response (200):
Content-Type: application/json
```
{
	"id": 540,
	"uuid": "14e8c840-7e0a-405c-9b93-6fd972a768ea",
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
	"description": "atualizei",
	"created_at": "2024-06-21T14:14:32.000000Z",
	"updated_at": "2024-06-21T14:18:36.000000Z",
	"deleted_at": null,
	"brazilian_type": null,
	"brazilian_type_synonym": null,
	"authors": null
}
```