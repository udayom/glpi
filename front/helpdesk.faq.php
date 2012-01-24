<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2012 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------


define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");

// Redirect management
if (isset($_GET["redirect"])) {
   Toolbox::manageRedirect($_GET["redirect"]);
}

//*******************
// Affichage Module FAQ
//******************

$name = "";
Session:: checkFaqAccess();

if (Session::getLoginUserID()) {
   Html::helpHeader(__('FAQ'), $_SERVER['PHP_SELF'], $_SESSION["glpiname"]);
} else {
   $_SESSION["glpilanguage"] = $CFG_GLPI['language'];
   // Anonymous FAQ
   Html::simpleHeader(__('FAQ'), array(__('Authentication') => $_SERVER['PHP_SELF'],
                                       __('FAQ')            => $_SERVER['PHP_SELF']));
}

if (!isset($_GET["contains"])) {
   $_GET["contains"] = "";
}
if (!isset($_GET["knowbaseitemcategories_id"])) {
   $_GET["knowbaseitemcategories_id"] = 0;
}

if (isset($_GET["id"])) {
   $kb = new KnowbaseItem();
   if ($kb->getFromDB($_GET["id"])) {
      $kb->showFull(false);
   }

} else {
   KnowbaseItem::searchForm($_GET,1);
   KnowbaseItemCategory::showFirstLevel($_GET,1);
   KnowbaseItem::showList($_GET,1);
   if (!$_GET["knowbaseitemcategories_id"] && strlen($_GET["contains"]) == 0) {
      KnowbaseItem::showViewGlobal($_SERVER['PHP_SELF'],1) ;
   }
}

Html::helpFooter();
?>