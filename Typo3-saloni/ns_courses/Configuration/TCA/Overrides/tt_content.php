<?php
defined('TYPO3') || die();
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

ExtensionUtility::registerPlugin(
    'NsCourses',
    'Course',
    'Course Plugin'
);

ExtensionUtility::registerPlugin(
    'NsCourses',
    'Student',
    'Student Plugin'
);
