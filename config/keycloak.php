<?php 
return [
  'realm_public_key' => env('KEYCLOAK_REALM_PUBLIC_KEY', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAy0MtjfsWhcB3yxEPtCpM24XP406MhLqpm0IH4YunxqJwP2lBnXqqf/oEXBxrMwOP9UALmXD9syR0hXif7J5nsWZSY9xGfbZYip1KG7+qqQgcurx/zvBlJE/P+ht5QpaynC40Ldocn5hxlnsAVBVdT7RaceNv+/ZYYzlHlLti1CaToXAkzmkZlGvjtGdskUsAs37ooUYa5qjWyuzBnpES4RdO5rUt3gLpcLfUuBitnGIiV0xqnnHAdWlA7xA2YyjRLdwYaq8N2jBM49O6sdaFBbSYWC7Zb3dj2vu6nZH3qv2QMpLOCtC3BiHd54K/BpW29tYW8KmxvRVtkdbxh2GgpwIDAQAB'),

  'load_user_from_database' => env('KEYCLOAK_LOAD_USER_FROM_DATABASE', false),

  'user_provider_credential' => env('KEYCLOAK_USER_PROVIDER_CREDENTIAL', 'username'),

  'token_principal_attribute' => env('KEYCLOAK_TOKEN_PRINCIPAL_ATTRIBUTE', 'preferred_username'),

  'append_decoded_token' => env('KEYCLOAK_APPEND_DECODED_TOKEN', false),

  'allowed_resources' => env('KEYCLOAK_ALLOWED_RESOURCES', 'account')
];
