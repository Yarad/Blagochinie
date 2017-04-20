<?php
include('PHPModules/GlobalFunctions.php');
if (CheckSecurity() == false)
{
    echo file_get_contents('admin_templates/AccessDenied.html');
    exit();
}

echo file_get_contents('admin_templates/MainAdminPageTemplate.html');