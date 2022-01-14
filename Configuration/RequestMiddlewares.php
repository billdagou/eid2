<?php
return [
    'frontend' => [
        'dagou/eid2' => [
            'target' => \Dagou\Eid2\Middleware\Eid2Handler::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ],
    ]
];