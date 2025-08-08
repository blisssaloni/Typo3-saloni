<?php

defined('TYPO3') or die();

(function () {
    $fields = [
        'subtitle' => [
            'label' => 'Subtitle',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim',
            ],
        ],
        'description_news' => [
            'label' => 'Description (RTE)',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
            ],
        ],
'feature_image' => [
    'exclude' => true,
    'label' => 'Feature Image',
    'config' => [
        'type' => 'inline',
        'foreign_table' => 'sys_file_reference',
        'foreign_field' => 'uid_foreign',
        'foreign_sortby' => 'sorting_foreign',
        'foreign_table_field' => 'tablenames',
        'foreign_match_fields' => [
            'fieldname' => 'feature_image',
        ],
        'foreign_label' => 'uid_local',
        'foreign_selector' => 'uid_local',
        'foreign_selector_fieldTcaOverride' => [
            'config' => [
                'appearance' => [
                    'elementBrowserAllowed' => 'jpg,jpeg,png',
                    'elementBrowserType' => 'file'
                ],
            ],
        ],
        'overrideChildTca' => [
            'types' => [
                '0' => [
                    'showitem' => '
                        --palette--;;imageoverlayPalette,
                        --palette--;;filePalette'
                ],
                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                    'showitem' => '
                        --palette--;;imageoverlayPalette,
                        --palette--;;filePalette'
                ],
            ],
        ],
        'appearance' => [
            'createNewRelationLinkTitle' => 'Add Image',
            'fileUploadAllowed' => true,
        ],
        'filter' => [
            'allowedFileExtensions' => 'jpg,jpeg,png'
        ],
        'maxitems' => 1,
    ]
]
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tx_news_domain_model_news',
        $fields
    );

    // Add subtitle and description_news to the General tab
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tx_news_domain_model_news',
        'subtitle, description_news',
        '',
        'after:bodytext'
    );

    // Add feature_image to Media tab
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tx_news_domain_model_news',
        '--div--;Media, feature_image'
    );
})();
