<?php

return [
    'currencies' => ['USD', 'EUR', 'GBP', 'CHF', 'PLN'],
    'api_bank_ids' => [
        1,  // Райффайзен Банк
        2,  // Креді Агріколь Банк
        12, // Укрсиббанк
        15, // Таскомбанк
        36, // Кредобанк
    ],
    'bank_endpoint' => 'https://finance.ua/banks/api/organizationsList?locale=uk',
    'branch_endpoint' => 'https://finance.ua/api/organization/v1/branches?locale=uk&slug=',
    'nbu_currencies_endpoint' => 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json'
];
