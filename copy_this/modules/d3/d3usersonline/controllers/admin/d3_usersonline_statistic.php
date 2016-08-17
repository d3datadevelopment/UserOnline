<?php
/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <ds@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */
class d3_usersonline_statistic extends d3_cfg_mod_main
{
    protected $_blUseOwnOxid = false;
    protected $_iExpTime = 600; // (in seconds)
    protected $_sThisTemplate = 'd3_usersonline_statistic.tpl';

    protected $_sMenuItemTitle = 'd3mxusersonline';

    protected $_sMenuSubItemTitle = 'd3mxusersonline_analysis';

    /**
     * @return array
     */
    public function getUserCount()
    {
        /** @var d3usersonline $oUsersOnline */
        $oUsersOnline = oxNew('d3usersonline');
        $oUsersOnline->clearOldItems($this->_iExpTime);
        return $oUsersOnline->getUserCount();
    }
}
