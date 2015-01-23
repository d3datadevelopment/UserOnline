<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
    'id'          => 'd3usersonline',
    'title'       =>
    (class_exists('d3utils') ? d3utils::getInstance()->getD3Logo() : 'D&sup3;') . ' Users Online',
    'description' => array(
        'de' => 'Lassen Sie sich anonym im Shop anzeigen, wie viele Benutzer zur Zeit Ihren Shop besuchen und welche '.
            'Seiten angezeigt werden. Das Modul speichert nicht die IP-Adresse oder sonstige Daten des Nutzers. Damit '.
            'gen&uuml;gen Sie auch dem deutschen Recht.',
        'en' => '',
    ),
    'thumbnail'   => 'picture.png',
    'version'     => '2.0.0.2',
    'author'      => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'       => 'support@shopmodule.com',
    'url'         => 'http://www.oxidmodule.com/',
    'extend'      => array(
        'oxcmp_utils'  => 'd3/d3usersonline/modules/components/d3_oxcmp_utils_usersonline',
    ),
    'files'       => array(
        'd3usersonline'            => 'd3/d3usersonline/models/d3usersonline.php',
        'd3usersonline_update'     => 'd3/d3usersonline/setup/d3usersonline_update.php',
        'd3_cfg_usersonline'       => 'd3/d3usersonline/controllers/admin/d3_cfg_usersonline.php',
        'd3_cfg_usersonline_licence' => 'd3/d3usersonline/controllers/admin/d3_cfg_usersonline_licence.php',
        'd3_cfg_usersonline_list'  => 'd3/d3usersonline/controllers/admin/d3_cfg_usersonline_list.php',
        'd3_cfg_usersonline_main'  => 'd3/d3usersonline/controllers/admin/d3_cfg_usersonline_main.php',
        'd3_usersonline'           => 'd3/d3usersonline/controllers/admin/d3_usersonline.php',
        'd3_usersonline_list'      => 'd3/d3usersonline/controllers/admin/d3_usersonline_list.php',
        'd3_usersonline_statistic' => 'd3/d3usersonline/controllers/admin/d3_usersonline_statistic.php',
    ),
    'templates'   => array(
        'd3_cfg_usersonline_main.tpl'  => 'd3/d3usersonline/views/admin/tpl/d3_cfg_usersonline_main.tpl',
        'd3_usersonline_statistic.tpl' => 'd3/d3usersonline/views/admin/tpl/d3_usersonline_statistic.tpl',
    ),
    'events'      => array(
        'onActivate' => 'd3install::checkUpdateStart',
    ),
    'blocks'      => array(
        array(
            'template' => 'layout/sidebar.tpl',
            'block' => 'sidebar_categoriestree',
            'file'     => 'views/blocks/layout/d3usersonline_sidebar.tpl'
        ),
    )
);