<?php
defined('TYPO3') || die();

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Log\Writer\FileWriter;


(static function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'NsCourses',
        //'NITSAN.NsCourses',
        'Course',
        [
            \NITSAN\NsCourses\Controller\CourseController::class => 'list, show, new, create, edit, update, delete',
            \NITSAN\NsCourses\Controller\StudentsController::class => 'list, show, new, create, edit, update, delete',
        ],
        [
            \NITSAN\NsCourses\Controller\CourseController::class => 'create, update, delete',
            \NITSAN\NsCourses\Controller\StudentsController::class => 'create, update, delete',
        ] ,
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'NsCourses',
        'Student',
        [
            \NITSAN\NsCourses\Controller\StudentsController::class => 'list, show, new, create, edit, update, delete',
        ],
        [
            \NITSAN\NsCourses\Controller\StudentsController::class => 'create, update, delete',
        ] ,
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );


    // Optional: File reference override
    $GLOBALS['TYPO3_CONF_VARS']['Extbase']['objectContainer'][TYPO3\CMS\Extbase\Domain\Model\FileReference::class] =
        TYPO3\CMS\Extbase\Domain\Repository\FileReferenceRepository::class;

    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['templateRootPaths'][700]
    = 'EXT:ns_courses/Resources/Private/Templates/Email/';
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['layoutRootPaths'][700]
    = 'EXT:ns_courses/Resources/Private/Layouts/';
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['partialRootPaths'][700]
    = 'EXT:ns_courses/Resources/Private/Partials/';
//this not to do
// $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['news']['Classes']['Domain/Model/News'] = \NITSAN\NsCourses\Domain\Model\News::class;

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News']['ns_courses'] = 'ns_courses';

})();
