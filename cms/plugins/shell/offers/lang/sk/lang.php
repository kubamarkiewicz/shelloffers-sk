<?php return [
    'plugin' => [
        'name' => 'Ponuky práce na čerpacích staniciach Shell',
        'description' => 'Ponuky práce na čerpacích staniciach Shell',
    ],
    'station' => [
        'stations' => 'Čerpacie stanice',
        'id' => 'ID stanice',
        'shell-name' => 'Názov Shell',
        'email' => 'E-mail',
        'station' => 'Stanica',
        'post-code' => 'Poštové smerovacie číslo',
        'city' => 'Mesto',
        'street' => 'Ulica',
    ],
    'province' => [
        'province' => 'Kraj',
        'provinces' => 'Kraje',
        'name' => 'Názov',
    ],
    'job-title' => [
        'job-title' => 'Pracovné miesto',
        'job-titles' => 'Pracovné miesta',
        'name' => 'Názov pracovného miesta',
        'description' => 'Šablóna pracovnej ponuky',
        'id' => 'Číslo pracovného miesta',
        'is-site-manager' => 'Site Manager',
        'is-site-manager-description' => 'When this option is selected applications for this position will be sent to the email address of Retailer instead of Site Manager. Site Manager will not see job offers nor applications for this position.'
    ],
    'offer' => [
        'job-offer' => 'Ponuka práce',
        'job-offers' => 'Ponuky práce',
        'description' => 'Opis ponuky',
        'published' => 'Zverejnená',
        'valid-from' => 'Platná od',
        'valid-to' => 'Platná do',
        'create-date' => 'Dátum vytvorenia',
        'created-by' => 'Vytvorená:',
        'id' => 'Číslo ponuky',
    ],
    'application' => [
        'date' => 'Dátum odoslania žiadosti',
        'applications' => 'Žiadosti',
        'id' => 'Číslo žiadosti',
        'status' => 'Stav',
        'updated' => 'Stav žiadosti bol zmenený',
        'application-status' => [
            'no_action' => 'Žiadna akcia',
            'invited_for_interview' => 'Uchádzač bol pozvaný na pohovor',
            'rejection_email_sent' => 'Uchádzačovi bol poslaný odmietací e-mail'
        ]
    ],
    'statistics' => [
        'statistics' => 'Štatistické údaje',
    ],
    'user' => [
        'site' => 'Čerpacie stanice (len pre Manažérov čerpacích staníc)',
        'sites' => 'Stanica (povinné iba pre Prevádzkovateľov)',
    ],    
    'export' => [
        'export_to_excel' => 'Export do Excelu'
    ]

];