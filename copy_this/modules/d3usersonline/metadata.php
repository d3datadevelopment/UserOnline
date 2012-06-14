<?php
/**
 * Module information
 */
$sMetadataVersion = '1.0';
$aModule = array(
    'id'           => 'd3useronline',
    'title'        => oxLang::getInstance()->translateString('D3_USERONLINE_METADATA_TITLE'),
    'description'  => oxLang::getInstance()->translateString('D3_USERONLINE_METADATA_DESC'),
    'thumbnail'    => 'picture.png',
    'version'      => '1.2.1',
    'author'       => oxLang::getInstance()->translateString('D3_MOD_LIB_METADATA_AUTHOR'),
    'email'        => 'support@shopmodule.com',
    'url'          => 'http://www.oxidmodule.com/',
    'extend'      => array(
        'oxcmp_utils' => 'd3usersonline/views/d3_oxcmp_utils_usersonline'
    )
);