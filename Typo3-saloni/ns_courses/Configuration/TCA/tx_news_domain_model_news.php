<?php

defined('TYPO3') or die();

(function () {
    $fields = [
        'subtitle'         => [
            'label'  => 'Subtitle',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim',
            ],
        ],
        'description_news' => [
            'label'  => 'Description (RTE)',
            'config' => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'default',
                'cols'                  => 40,
                'rows'                  => 15,
            ],
        ],
        'feature_image'    => [
            'exclude' => true,
            'label'   => 'Feature Image',
            'config'  => [
                'type'     => 'file',
                'allowed'  => ['jpg', 'jpeg', 'png'], // allowed extensions
                'maxitems' => 1,
            ],
        ],
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
