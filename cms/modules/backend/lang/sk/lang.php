<?php
return [
    'account' => [
        'sign_out' => 'Odhlásiť',
        'login' => 'Prihlásiť',
        'reset' => 'Zmeniť heslo',
        'restore' => 'Obnoviť',
        'login_placeholder' => 'prihlasovacie meno',
        'password_placeholder' => 'heslo',
        'forgot_password' => 'Zabudli ste heslo?',
        'enter_email' => 'Zadajte svoj e-mail',
        'enter_login' => 'Zadajte svoje používateľské meno',
        'email_placeholder' => 'e-mail',
        'enter_new_password' => 'zadajte nové heslo',
        'password_reset' => 'Zmeniť heslo',
        'restore_success' => 'Na Vašu e-mailovú adresu bola odoslaná sprava s pokynmi pre obnovenie hesla.',
        'restore_error' => 'Používateľ s uvedeným užívateľským menom nebol nájdený \':login\'',
        'reset_success' => 'Vaše heslo bolo úspešne obnovené. Teraz sa môžete prihlásiť.',
        'reset_error' => 'Nesprávne údaje pre zmenu hesla. Skúste to znova!',
        'reset_fail' => 'Nemôžete zmeniť heslo!',
        'apply' => 'Aplikovať',
        'cancel' => 'Storno',
        'delete' => 'Zmazať',
        'ok' => 'OK'
    ],      
    'user' => [
        'name' => 'Správca',
        'menu_label' => 'Správcovia',
        'menu_description' => 'Správa správcov, užívateľov, skupín a oprávnení',
        'list_title' => 'Správa správcov',
        'new' => 'Nový správca',
        'login' => 'Prihlasovacie meno',
        'first_name' => 'Meno',
        'last_name' => 'Priezvisko',
        'full_name' => 'Meno a priezvisko',
        'email' => 'E-mail',
        'groups' => 'Skupina',
        'groups_comment' => 'Určite, do ktorej skupiny tento užívateľ patrí',
        'avatar' => 'Avatar',
        'password' => 'Heslo',
        'password_confirmation' => 'Potvrdiť heslo',
        'permissions' => 'Oprávnenie',
        'account' => 'Účet',
        'superuser' => 'Super užívateľ',
        'superuser_comment' => 'Vyberte toto políčko, ak chcete povoliť tomuto užívateľovi plný prístup k panelu',
        'send_invite' => 'Odoslať e-mailovú správu s pozvánkou',
        'send_invite_comment' => 'Zaškrtnite, ak chcete poslať e-mailovú správu s pozvánkou tomuto užívateľovi',
        'delete_confirm' => 'Ste si istí, že chcete odstrániť tohto správcu?',
        'return' => 'Späť na zoznam správcov',
        'allow' => 'Povoliť',
        'inherit' => 'Zdediť',
        'deny' => 'Odmietnuť',
        'group' => [
            'name' => 'Skupina',
            'name_comment' => 'Názov zobrazovaný na zozname skupín a vo formulári pridávania/nastavovania správcov',
            'name_field' => 'Názov',
            'description_field' => 'Opis',
            'is_new_user_default_field' => 'Pridávať nových správcov do tejto skupiny ako do predvolenej',
            'is_new_user_default_field_comment' => 'Pridávať nových správcov do tejto skupiny v predvolenom nastavení',
            'code_field' => 'Kód',
            'code_comment' => 'Zadajte unikátny kód, ak chcete mať k nemu prístup cez API',
            'menu_label' => 'Skupiny',
            'list_title' => 'Spravovať skupiny',
            'new' => 'Nová skupina správcov',
            'delete_confirm' => 'Ste si istí, že chcete zmazať túto skupinu správcov?',
            'return' => 'Späť na zoznam skupín',
            'users_count' => 'Užívatelia'
        ],
        'preferences' => [
            'not_authenticated' => 'Nebol nájdený overený užívateľ k načítaniu alebo uloženiu nastavení'
        ],
    ],
    'list' => [
        'default_title' => 'Zoznam',
        'search_prompt' => 'Hľadať …',
        'no_records' => 'Nie sú žiadne záznamy',
        'missing_model' => 'Uloženie zoznamu použitého v :class nemá definovaný model',
        'missing_column' => 'Žiadna definícia stĺpcov pre :columns',
        'missing_columns' => 'Zoznam použitý v :class nemá definovaný zoznam stĺpcov',
        'missing_definition' => 'Uloženie zoznamu nemá stĺpce pre \':field\'',
        'missing_parent_definition' => 'Uloženie zoznamu nemá definície pre \':definition\'',
        'behavior_not_ready' => 'Uloženie zoznamu nebolo inicializované, overte, že ste zadali makeLists () vo svojom ovládači',
        'invalid_column_datetime' => 'Hodnota stĺpca \':column\' nie je objekt typu DateTime, nechýba Vám Referencia \$ dates v Modelu?',
        'pagination' => 'Boli zobrazené záznamy: :from-:to z :total',
        'prev_page' => 'Predchádzajúca stránka',
        'next_page' => 'Ďalšia stránka',
        'refresh' => 'Obnoviť',
        'updating' => 'Aktualizácie …',
        'loading' => 'Načítanie …',
        'setup_title' => 'Nastavenia zoznamu',
        'setup_help' => 'Použite zaškrtávacie políčka pre výber stĺpcov, ktoré chcete zobraziť v zozname. Môžete zmeniť pozíciu stĺpca pretiahnutím nahor alebo nadol.',
        'records_per_page' => 'Počet záznamov na stránke',
        'records_per_page_help' => 'Vyberte počet záznamov, ktoré sa zobrazia na jednej stránke. Vyšší počet záznamov na jednej stránke môže znížiť výkon.',
        'check' => 'Skontrolovať',
        'delete_selected' => 'Odstrániť vybraté',
        'delete_selected_empty' => 'Žiadne položky neboli vybrané pre zmazanie',
        'delete_selected_confirm' => 'Odstrániť vybraté položky?',
        'delete_selected_success' => 'Úspešne odobraté vybrané položky',
        'column_switch_true' => 'Áno',
        'column_switch_false' => 'Nie'
    ],
    'form' => [
        'create_title' => 'Pridať :name',
        'update_title' => 'Upraviť :name',
        'preview_title' => 'Náhľad :name',
        'create_success' => ':name bol úspešne vytvorený',
        'update_success' => ':name bol úspešne aktualizovaný',
        'delete_success' => ':name bol úspešne odstránený',
        'reset_success' => 'Resetovanie bolo dokončené',
        'missing_id' => 'ID záznam formulára nebol nájdený',
        'missing_model' => 'Uloženie formulára použitého v triede :class nemá definovaný Model',
        'missing_definition' => 'Uloženie formulára nemá pole pre \':field\'',
        'not_found' => 'Záznam formulára s ID :id nebol nájdený',
        'action_confirm' => 'Ste si istí?',
        'create' => 'Vytvoriť',
        'create_and_close' => 'Vytvoriť a a zavrieť',
        'creating' => 'Vytváranie …',
        'creating_name' => 'Vytváranie :name …',
        'save' => 'Uložiť',
        'save_and_close' => 'Uložiť a zavrieť',
        'saving' => 'Ukladanie …',
        'saving_name' => 'Ukladanie :name …',
        'delete' => 'Zmazať',
        'deleting' => 'Odoberanie …',
        'confirm_delete' => 'Odobrať záznam?',
        'confirm_delete_multiple' => 'Odobrať vybrané záznamy?',
        'deleting_name' => 'Odoberanie :name …',
        'reset_default' => 'Obnoviť predvolené',
        'resetting' => 'Resetovanie:',
        'resetting_name' => 'Resetovanie :name',
        'undefined_tab' => 'Rôzne',
        'field_off' => 'Zap.',
        'field_on' => 'Vyp.',
        'add' => 'Pridať',
        'apply' => 'Aplikovať',
        'cancel' => 'Storno',
        'close' => 'Zavrieť',
        'confirm' => 'Potvrdiť',
        'reload' => 'Znovu načítať',
        'complete' => 'Upraviť',
        'ok' => 'OK',
        'or' => 'alebo',
        'confirm_tab_close' => 'Naozaj chcete zatvoriť túto kartu? Všetky neuložené zmeny budú stratené.',
        'behavior_not_ready' => 'Uloženie formulára nebolo inicializované, skontrolujte, či intiForm() bola zadaná vo Vašim ovládači',
        'preview_no_files_message' => 'Žiadne nahrané súbory',
        'preview_no_record_message' => 'Žiadne vybrané položky',
        'select' => 'Vybrať',
        'select_all' => 'Všetky',
        'select_none' => 'žiadne',
        'select_placeholder' => 'prosím, vyberte',
        'insert_row' => 'Vložiť riadok',
        'insert_row_below' => 'Vložiť riadok nižšie',
        'delete_row' => 'Zmazať riadok',
        'concurrency_file_changed_title' => 'Súbor bol zmenený',
        'concurrency_file_changed_description' => 'Súbor, ktorý upravujete, bol zmenený na disku iným užívateľom. Môžete načítať súbor a stratiť zmeny alebo prepísať súbor na disku.',
        'return_to_list' => 'Späť na zoznam'
    ],
    'myaccount' => [
        'menu_label' => 'Môj účet',
        'menu_description' => 'Zmeňte informácie o účte, ako je meno, e-mail a heslo',
        'menu_keywords' => 'security login'
    ]
];