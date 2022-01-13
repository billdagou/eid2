<?php
return [
    'frontend' => [
        'dagou/eid' => [
            'target' => \Dagou\Eid2\Middleware\Eid2Handler::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ],
    ]
];