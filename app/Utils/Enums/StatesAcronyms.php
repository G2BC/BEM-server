<?php

namespace App\Utils\Enums;
use App\Utils\States;


enum StatesAcronyms: string
{
    case AC = 'Acre';
    case AL = 'Alagoas';
    case AP = 'Amapá';
    case AM = 'Amazonas';
    case BA = 'Bahia';
    case CE = 'Ceará';
    case DF = 'Distrito Federal';
    case ES = 'Espírito Santo';
    case GO = 'Goiás';
    case MA = 'Maranhão';
    case MT = 'Mato Grosso';
    case MS = 'Mato Grosso do Sul';
    case MG = 'Minas Gerais';
    case PA = 'Pará';
    case PB = 'Paraíba';
    case PR = 'Paraná';
    case PE = 'Pernambuco';
    case PI = 'Piauí';
    case RJ = 'Rio de Janeiro';
    case RN = 'Rio Grande do Norte';
    case RS = 'Rio Grande do Sul';
    case RO = 'Rondônia';
    case RR = 'Roraima';
    case SC = 'Santa Catarina';
    case SP = 'São Paulo';
    case SE = 'Sergipe';
    case TO = 'Tocantins';

    public static function getStateByAcronym(string $acr): string
    {

        return collect(StatesAcronyms::cases())->first(function (StatesAcronyms $item) use ($acr) {

            return $item->name == $acr;
        })->value;
    }

    public static function searchForStateAc(string $placeString): StatesAcronyms|null
    {

        return collect(StatesAcronyms::cases())->first(function (StatesAcronyms $item) use ($placeString) {

            return str_contains($placeString, $item->name);
        });
    }

    public static function searchForState(string $placeString): StatesAcronyms|null
    {

        return collect(StatesAcronyms::cases())->first(function (StatesAcronyms $item) use ($placeString) {

            return str_contains($placeString, $item->value);
        });
    }

    public static function getGeolocalizationByAcronyms($acronym): array{
        $statesGeolacalization = States::getGeolocalization();

        $stateGeolacalization = $statesGeolacalization[$acronym];

        if(is_null($stateGeolacalization)) {
            throw new \Exception("Estado $acronym não encontrado");
        }

        return [
            "latitude" => $stateGeolacalization["latitude"],
            "longitude" => $stateGeolacalization["longitude"]
        ];
    }
}
