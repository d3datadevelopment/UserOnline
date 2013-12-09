<?php
/**
 * User: kristianhempel
 * Date: 06.12.13
 */

$sMetaVersion = '1.1';

$aModule = array(
    'id'          => 'd3useronlineschalter',
    'title'       => (class_exists('d3utils') ? d3utils::getInstance()->getD3Logo(
    ) : 'D&sup3;') . ' Users Online Erweiterung Schalterversand',
    'description' => array(
        ''
    ),
    'version'     => '2.0.0.2',
    'author'      => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'       => 'support@shopmodule.com',
    'url'         => 'http://www.oxidmodule.com/',
    'extend'      => array(),
    'files'       => array(
        'd3_d3useronlineschalter_controllers_admin_useronline' => 'd3/d3useronlineschalter/controllers/admin/useronline.php'
    ),
    'templates'   => array(
        'd3usersonline.tpl' => 'd3/d3useronlineschalter/views/admin/d3usersonline.tpl',
    ),
);