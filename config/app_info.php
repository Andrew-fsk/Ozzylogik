<?php

return [
    'currencies' => ['USD', 'EUR', 'GBP', 'CHF', 'PLN'],
    'api_bank_ids' => [
        4,  // ПриватБанк
        9,  // ПУМБ
        12, // Укрсиббанк
        22, // Абанк
        90, // Ощадбанк
    ],
    'bank_endpoint' => 'https://finance.ua/banks/api/organizationsList?locale=uk',
    'branch_endpoint' => 'https://finance.ua/api/organization/v1/branches?locale=uk&slug=',
    'nbu_currencies_endpoint' => 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json',
    'banks_currencies_endpoint' => 'https://minfin.com.ua/api/currency/rates/banks/',
];
