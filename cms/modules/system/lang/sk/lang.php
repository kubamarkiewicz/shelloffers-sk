<?php

return [
    'settings' => [
        'menu_label' => 'Nastavenie',
        'not_found' => 'Nie je možné nájsť zadané nastavenia',
        'missing_model' => 'Na stránke nastavenia chýba definícia modelu',
        'update_success' => 'Nastavenie pre: name boli úspešne aktualizované',
        'return' => 'Prejdite späť na nastavenia systému',
        'search' => 'Hľadať'
    ],
    'mail' => [
        'log_file' => 'Súbor logov',
        'menu_label' => 'Nastavenia správ',
        'menu_description' => 'Správa nastavení e-mailu',
        'general' => 'Všeobecne',
        'method' => 'Metóda správy',
        'sender_name' => 'Meno odosielateľa',
        'sender_email' => 'Email odosielateľa',
        'php_mail' => 'PHP mail',
        'smtp' => 'SMTP',
        'smtp_address' => 'Adresa SMTP servera',
        'smtp_authorization' => 'Autentifikácia SMTP je vyžadovaná',
        'smtp_authorization_comment' => 'Vyberte toto políčko, pokiaľ váš SMTP server vyžaduje overenie',
        'smtp_username' => 'Užívateľ',
        'smtp_password' => 'Heslo',
        'smtp_port' => 'Port SMTP',
        'smtp_ssl' => 'Pripojenie SSL je vyžadované',
        'smtp_encryption' => 'Šifrovací protokol SMTP',
        'smtp_encryption_none' => 'Žiadne šifrovanie',
        'smtp_encryption_tls' => 'TLS',
        'smtp_encryption_ssl' => 'SSL',
        'sendmail' => 'Sendmail',
        'sendmail_path' => 'Cesta Sendmail',
        'sendmail_path_comment' => 'Zadajte cestu programu sendmail',
        'mailgun' => 'Mailgun',
        'mailgun_domain' => 'Doména Mailgun',
        'mailgun_domain_comment' => 'Zadajte názov domény Mailgun',
        'mailgun_secret' => 'Mailgun Secret',
        'mailgun_secret_comment' => 'Zadajte svoj kľúč API Mailgun',
        'mandrill' => 'Mandrill',
        'mandrill_secret' => 'Mandrill secret',
        'mandrill_secret_comment' => 'Zadajte svoj kľúč API Mandrill',
        'ses' => 'SES',
        'ses_key' => 'SES key',
        'ses_key_comment' => 'Zadajte svoj kľúč API SES',
        'ses_secret' => 'SES secret',
        'ses_secret_comment' => 'Zadajte svoj tajný kľúč API SES',
        'ses_region' => 'Región SES',
        'ses_region_comment' => 'Zadajte svoj región SES (e.g. us-east-1)',
        'drivers_hint_header' => 'Ovládače neboli nainštalované',
        'drivers_hint_content' => 'Táto užívateľská funkcia odosielanie e-mailových sprav vyžaduje inštaláciu pluginu ":plugin"',
    ],
    'mail_templates' => [
        'menu_label' => 'Šablóny e-mail',
        'menu_description' => 'Modifikovať šablóny správ odosielaných používateľom, správcom. Správa systémov správ.',
        'new_template' => 'Nová šablóna',
        'new_layout' => 'Nový systém',
        'template' => 'Šablóna',
        'templates' => 'Šablóny',
        'menu_layouts_label' => 'Rozvrhnutie sprav',
        'layout' => 'Rozvrhnutie',
        'layouts' => 'Rozvrhnutie',
        'no_layout' => '-- Žiadne rozvrhnutie --',
        'name' => 'Názov',
        'name_comment' => 'Unikátny názov, ktorý odkazuje na šablónu',
        'code' => 'Kód',
        'code_comment' => 'Unikátny kód pre túto šablónu',
        'subject' => 'Téma',
        'subject_comment' => 'Predmet správy',
        'description' => 'Popis',
        'content_html' => 'HTML',
        'content_css' => 'CSS',
        'content_text' => 'Plaintext',
        'test_send' => 'Odoslať skúšobnú správu',
        'test_success' => 'Skúšobná správa bola úspešne odoslaná.',
        'test_confirm' => 'Odoslať skúšobnú správu na :e-mail. Pokračovať?',
        'creating' => 'Tvorenie šablóny …',
        'creating_layout' => 'Tvorenie rozvrhnutia …',
        'saving' => 'Ukladanie šablóny …',
        'saving_layout' => 'Ukladanie rozvrhnutia …',
        'delete_confirm' => 'Odobrať túto šablónu?',
        'delete_layout_confirm' => 'Odstrániť toto rozvrhnutie?',
        'deleting' => 'Odoberanie šablóny …',
        'deleting_layout' => 'Odoberanie rozvrhnutia …',
        'sending' => 'Odoslať skúšobnú správu ...',
        'return' => 'Späť na zoznam šablón',
    ],
    'system' => [
        'categories' => [
            'mail' => 'Mail',
            'system' => 'System',
        ]
    ]
];