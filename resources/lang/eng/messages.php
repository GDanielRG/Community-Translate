<?php

return [
    'wrong_password' => 'Incorrect password',
    'no_user' => 'Usernnot found.',
    'reply_label' => 'Someone replied in :language : :translation',
    'new_user_registered' => 'New user registered',
    'new_language_added' => 'Language added: :name',
    'language_not_found' => 'Language not found: :name',
    'language_not_present' => 'You don\'t have this language registered: :name',
    'language_changed' => 'Language changed: :name',
    'user_not_registered' => 'Please register your user',
    'new_service_added' => 'New service added',
    'no_help_available' => 'No help available',
    'available_commands' => 'Available commands',
    'global_help_text' => '#mute\nChanges your current state to muted\n\n#unmute\nChanges your current state to unmuted\n\n#addLanguage {name|code}\nAdds a new language to your list of known languages\n\t-name: Name of the language\n\t-code: ISO: 693-2 language code\n\n#register {username} {password}\nRegisters a new app to your account\n\t-username: Your ID\n\t-password: Your password\n\n#changeLanguage {name|code}\nChanges the language of the app\n\t-name: Name of the language\n\t-code: ISO: 693-2 language code\n\n',
    'main_help_text' => '#request\n{name|code} {text}\nMake a translation petition\n\t-name: Name of the language\n\t-code: ISO: 693-2 language code\n\t-text: The text that will be translated\n\n#requestImage {name|code}\n\t-name: Name of the language\n\t-code: ISO: 693-2 language code\n\n#rate\nStart rating translations related to languages that you know\n\n',
    'requested_help_text' => '#bestAnswer\nThis function returns the best answer for your petition\n\n',
    'received_help_text' => '#replay {text}\nReplay to the current petition\n\t-text: The translation of the request\n\n',
    'rating_help_text' => '#skip\nSkip this answer\n\n#rate {value}\n\t-value: This value can be up to add one, or down to substract one\n\n',
    'requested_image_help_text' => 'Please send an image file\n\n',
    'request_translate_petition' => 'Can you translate ":text" to :lang please?',
    'best_translation' => 'The best translation was ":text"'
];
