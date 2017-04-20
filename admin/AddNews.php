<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2017
 * Time: 12:14
 */
include 'PHPModules/GlobalFunctions.php';
if (CheckSecurity() == false)
{
    echo file_get_contents('admin_templates/AccessDenied.html');
    exit();
}
echo file_get_contents('admin_templates/MainAdminEditorTemplate.html');