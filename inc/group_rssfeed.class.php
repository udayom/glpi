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
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

/// Class Group_RSSFeed
/// @since version 0.84
class Group_RSSFeed extends CommonDBRelation {

   // From CommonDBRelation
   static public $itemtype_1 = 'RSSFeed';
   static public $items_id_1 = 'rssfeeds_id';
   static public $itemtype_2 = 'Group';
   static public $items_id_2 = 'groups_id';


   /**
    * Get groups for a rssfeed
    *
    * @param $rssfeeds_id ID of the rssfeed
    *
    * @return array of groups linked to a rssfeed
   **/
   static function getGroups($rssfeeds_id) {
      global $DB;

      $groups = array();
      $query  = "SELECT `glpi_groups_rssfeeds`.*
                 FROM `glpi_groups_rssfeeds`
                 WHERE `rssfeeds_id` = '$rssfeeds_id'";

      foreach ($DB->request($query) as $data) {
         $groups[$data['groups_id']][] = $data;
      }
      return $groups;
   }

}
?>