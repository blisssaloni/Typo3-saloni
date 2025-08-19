<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'ns_courses',
    'Configuration/TypoScript',
    'course'
);
