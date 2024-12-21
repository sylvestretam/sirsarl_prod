<?php
    session_start();
    
    require_once('src/lib/outils.php');
    require_once('src/lib/database.php');

    require_once('src/controller/dashboard.php');
    require_once('src/controller/achat.php');
    require_once('src/controller/consommation.php');
    require_once('src/controller/production.php');
    require_once('src/controller/expedition.php');

    if(isset($_SESSION['PROD']))
    {

        if(isset($_REQUEST['action'])){

            switch ($_REQUEST['action']) {

                case 'dashboard':
                    $controller = new DashboardController();
                    $controller->show();
                    break;
                case 'achat':
                    $controller = new AchatController();
                    $controller->show();
                    break;
                case 'consommation':
                    $controller = new ConsommationController();
                    $controller->show();
                    break;
                case 'production':
                    $controller = new ProductionController();
                    $controller->show();
                    break;
                case 'expedition':
                    $controller = new ExpeditionController();
                    $controller->show();
                    break;
                case 'logout':
                    header('location:'.$SERVERPATH.'sisas_portal');
                    break;
                default:
                    $controller = new DashboardController();
                    $controller->show();
                    break;
            }
        }
        else
        {
            if(isset($_SESSION['matricule']))
            {
                $dashboardcontroller = new DashboardController();
                $dashboardcontroller->show();
            }
            else
            {
                header('location:'.$SERVERPATH.'sisas_portal');
            }
        }
    }
    else
    {
        $ERROR = "Vous ne pouvez acceder a cette application";
        require('template/error.php');
    }