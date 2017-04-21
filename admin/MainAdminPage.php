<?php
include('PHPModules/GlobalFunctions.php');
include('../WholeProjectConstants/DatabaseConnection.php');


if (CheckSecurity() == false)
{
    echo file_get_contents('admin_templates/AccessDenied.html');
    exit();
}

echo file_get_contents('admin_templates/MainAdminPageTemplate.html');