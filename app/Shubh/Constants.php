<?php

/*
 | --------------------------------------------------------------------------
 | Shubh Constants
 | --------------------------------------------------------------------------
 |
 | Define application constants here. Loaded from app/Config/Constants.php.
 */

/*
 | --------------------------------------------------------------------------
 | Application Identity
 | --------------------------------------------------------------------------
 |
 | Site name and description. Used by FrontendController for the <title>,
 | canonical schema.org Organization / WebSite nodes, and by AdminController
 | for the admin panel name.
 |
 | TODO: replace these placeholders with the real site title and description.
 */
defined('APP_TITLE')       || define('APP_TITLE', 'Shubh');
defined('APP_DESCRIPTION') || define('APP_DESCRIPTION', 'A CodeIgniter 4 application.');

/*
 | Module constants. Unlike routes, CodeIgniter has no auto-discovery for
 | constants, so each module's file is required here.
 */
foreach (['Admin', 'User'] as $module) {
    $file = APPPATH . 'Modules/' . $module . '/Config/Constants.php';

    if (is_file($file)) {
        require_once $file;
    }
}

unset($module, $file);
