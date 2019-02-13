<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Le :attribute doit être accepté.',
    'active_url'           => 'La :attribute n\'est pas une URL valide',
    'after'                => 'La :attribute doit être une date après : date.',
    'after_or_equal'       => 'La :attributedoit être une date après ou égale à: date.',
    'alpha'                => 'Le :attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'Le :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num'            => 'Le :attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => 'Le :attribute doit être un tableau.',
    'before'               => 'La :attribute doit être une date avant à :date',
    'before_or_equal'      => 'La :attribute doit être une date avant ou égale à :date.',
    'between'              => [
        'numeric' => 'Le :attributedoit être compris entre :min et :max.',
        'file'    => 'Le :attribute doit être compris entre :min et :max kilo-octets',
        'string'  => 'Le :attribute doit être compris entre :min et :max caractères.',
        'array'   => 'Le :attribute doit être entre :min et :max items',
    ],
    'boolean'              => 'Le :attribute doit être vrai ou faux',
    'confirmed'            => 'La :attribure  confirmation ne correspond pas',
    'date'                 => 'La :attibute n\'est pas une date valide.',
    'date_format'          => 'La :attribute ne correspond pas au format :format.',
    'different'            => 'Le :attribute et :other doivent être différents.',
    'digits'               => 'Le :attribute doit être un nombre :digits.',
    'digits_between'       => 'Le :attribute doit être compris entre :min et :max .',
    'dimensions'           => 'Le :attribute a des dimensions d\'image non valides.',
    'distinct'             => 'Le :attribute a une valeur en double.',
    'email'                => 'Le :attribute doit être une adresse email valide.',
    'exists'               => 'Le :attribute sélectionné est invalide.',
    'file'                 => 'Le :atttibute doit être un fichier.',
    'filled'               => 'Le :atttibute doit avoir une valeur.',
    'gt'                   => [
        'numeric' => 'Le :atttibute doit être supérieur à :valeur.',
        'file'    => 'Le :atttibute doit être supérieur à :valeur kilo-octets.',
        'string'  => 'Le :atttibute doit être supérieur à :value caractères.',
        'array'   => 'Le :atttibute doit avoir plus de :value éléments .',
    ],
    'gte'                  => [
        'numeric' => 'Le :atttibute doit être supérieur ou égal à :value.',
        'file'    => 'Le :atttibute doit être supérieur ou égal à :value kilo-octets.',
        'string'  => 'Le :atttibute  doit être supérieur ou égal à :value caractères.',
        'array'   => 'Le :atttibute  doit avoir :value ou plus éléments.',
    ],
    'image'                => 'Le :atttibute doit être une image.',
    'in'                   => 'Le :atttibute  sélectionné est invalide.',
    'in_array'             => 'Le :atttibute  n’existe pas dans :other.',
    'integer'              => 'Le :attribute doit être un nombre entier.',
    'ip'                   => 'Le :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'Le :attribute doit être une adresse IPv4 valide.',
    'ipv6'                 => 'Le :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'Le :attribute doit être une chaîne JSON valide.',
    'lt'                   => [
        'numeric' => 'Le :attribute doit être inférieur à :value.',
        'file'    => 'Le :attribute doit être inférieur à :value kilo-octets.',
        'string'  => 'Le :attribute doit être inférieur à :value characters.',
        'array'   => 'Le :attribute doit être inférieur à :value éléments.',
    ],
    'lte'                  => [
        'numeric' => 'Le :attribute doit être inférieur ou égal à :value.',
        'file'    => 'Le :attribute doit être inférieur ou égal à :value kilo-octets.',
        'string'  => 'Le :attribute doit être inférieur ou égal à :value characters.',
        'array'   => 'Le :attribute ne doit pas avoir plus de :value éléments.',
    ],
    'max'                  => [
        'numeric' => 'Le :attribute ne peut pas être supérieur à :max.',
        'file'    => 'Le :attribute ne peut pas être supérieur à :max kilo-octets.',
        'string'  => 'Le :attribute ne peut pas être supérieur à :max caractères.',
        'array'   => 'Le :attribute ne peut avoir plus de :max éléments.',
    ],
    'mimes'                => 'Le :attribute doit être un fichier de type :values.',
    'mimetypes'            => 'Le :attribute doit être un fichier de type :values.',
    'min'                  => [
        'numeric' => 'Le :attribute doit être au moins :min.',
        'file'    => 'Le :attribute doit être au moins :min kilo-octets.',
        'string'  => 'Le :attribute doit être au moins :min caractères.',
        'array'   => 'Le :attribute doit avoir au moins :min éléments.',
    ],
    'not_in'               => 'Le :attribute selectionné est invalide.',
    'not_regex'            => 'Le format de :attribute est invalide.',
    'numeric'              => 'Le :attribute doit être un nombre.',
    'present'              => 'Le champ de :attribute doit être présent.',
    'regex'                => 'Le format de :attribute est invalide.',
    'required'             => 'Le champ de :attribute est obligatoire.',
    'required_if'          => 'Le champ de :attribute est obligatoire lorsque :other est :value.',
    'required_unless'      => 'Le champ de :attribute est obligatoire sauf si :other ets :values.',
    'required_with'        => 'Le champ de :attribute est obligatoir si :values est present.',
    'required_with_all'    => 'Le champ de :attribute est obligatoir si :values est present.',
    'required_without'     => 'Le champ de :attribute est obligatoir si :values n\'est pas present.',
    'required_without_all' => 'Le champ de :attribute est obligatoire lorsqu\'aucune est present.',
    'same'                 => 'Le :attribute et :other doivent correspondre.',
    'size'                 => [
        'numeric' => 'Le :attribute doit être :size.',
        'file'    => 'Le :attribute doit être :size  kilo-octets.',
        'string'  => 'Le :attribute doit être :size caractères.',
        'array'   => 'Le :attribute doit contenir :size éléments.',
    ],
    'string'               => 'Le :attribute doit être une chaîne.',
    'timezone'             => 'La :attribute doit être une zone valide.',
    'unique'               => 'Le :attribute a déjà été pris.',
    'uploaded'             => 'Le :attribute échec de télécharger',
    'url'                  => 'Le format de :attribute est invalide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
