<?php
use TYPO3\CMS\Core\Resource\Tca\FileFieldTcaBuilder;

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_course',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        // 'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,description',
        'iconfile' => 'EXT:ns_courses/Resources/Public/Icons/tx_nscourses_domain_model_course.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'title, description,slug, file, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    [
                        'label' => '',
                        'value' => '',
                        'invertStateDisplay' => true
                    ]
                ],
                'foreign_table' => 'tx_nscourses_domain_model_course',
                'foreign_table_where' => 'AND {#tx_nscourses_domain_model_course}.{#pid}=###CURRENT_PID### AND {#tx_nscourses_domain_model_course}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'value' => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_course.title',
            'description' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_course.title.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_course.description',
            'description' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_course.description.description',
            'config' => [
                'type' => 'text', // Changed from 'input' to 'text' for multi-line support
                'cols' => 30,
                'rows' => 5,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
    
        'file' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_courses/Resources/Private/Language/locallang_db.xlf:tx_nscourses_domain_model_course.image',
            'config' => [
                'type' => 'file',
                'allowed' => ['pdf'], // only allow PDFs
                'maxitems' => 1,
            ],
        ],
        'slug' => [
            'exclude' => 1,
            'label' => 'Slug',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['title'],
                    'prefixParentPageSlug' => true,
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
            ],
        ],
    ],
];