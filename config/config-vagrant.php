<?php
$config = include 'conf-base.php';

return array_merge($config,
    [
        'app.siteName' => 'TeiaRio',
        'app.siteDescription' => 'Mapas Culturais da Cidade do Rio de Janeiro',

        /* configure e descomente as linhas abaixo para habilitar um tema personalizado */
         'namespaces' => array_merge( $config['namespaces'], ['TeiaRio' => '/vagrant']),
         'themes.active' => 'TeiaRio',

        'themes.assetManager' => new \MapasCulturais\AssetManagers\FileSystem([
            'publishPath' => BASE_PATH . 'assets/',

            'mergeScripts' => true,
            'mergeStyles' => true,

            'process.js' => 'uglifyjs {IN} -o {OUT} --source-map {OUT}.map --source-map-include-sources --source-map-url /assets/{FILENAME}.map -b -p ' . substr_count(BASE_PATH, '/'),
            'process.css' => 'uglifycss {IN} > {OUT} ',
            'publishFolderCommand' => 'cp -R {IN} {PUBLISH_PATH}{FILENAME}'
        ]),

        // development, staging, production
        'app.mode' => 'development',

        'doctrine.isDev' => false,
        'slim.debug' => false,
        'maps.includeGoogleLayers' => true,

        'app.geoDivisionsHierarchy' => [
            'pais' => 'País',
            'regiao' => 'Região',
            'estado' => 'Estado',
            'mesorregiao' => 'Mesorregião',
            'microrregiao' => 'Microrregião',
            'municipio' => 'Município',
            'zona' => 'Zona',
            'subprefeitura' => 'Subprefeitura',
            'distrito' => 'Distrito'
        ],
        // latitude, longitude
        'maps.center' => [-22.921139, -43.396481],

        // zoom do mapa
        'maps.zoom.default' => 11,

        'plugins.enabled' => array('agenda-singles', 'endereco'),

        'auth.provider' => 'Fake',

        /* Modelo de configuração para usar o id da cultura */
//        'auth.provider' => 'OpauthOpenId',
//        'auth.config' => [
//            'login_url' => '',
//            'logout_url' => '',
//            'salt' => '',
//            'timeout' => '24 hours'
//        ],

        'doctrine.database' => [
            'dbname'    => 'mapas',
            'user'      => 'vagrant',
            'host'      => '',
        ],
    ]
);
