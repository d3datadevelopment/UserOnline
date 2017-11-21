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
    protected $_sThisTemplate = 'd3_usersonline_statistic.tpl';

    protected $_sMenuItemTitle = 'd3mxusersonline';

    protected $_sMenuSubItemTitle = 'd3mxusersonline_analysis';

    public $blGroupByClass = false;

    public function render()
    {
        $this->blGroupByClass = oxRegistry::getConfig()->getRequestParameter('groupbyclass') == 'true';
        $this->addTplParam('blGroupByClass', $this->blGroupByClass);
        return parent::render();
    }

    /**
     * @return array
     */
    public function getUserCount()
    {
        /** @var d3usersonline $oUsersOnline */
        $oUsersOnline = oxNew('d3usersonline');
        $oUsersOnline->clearOldItems();
        return $oUsersOnline->getUserCount($this->blGroupByClass);
    }

    public function getControllerTitle($sControllerIdent)
    {
        $oLang = oxRegistry::getLang();
        $sTranslationIdent = 'D3_USERSONLINE_CLASS_'.strtoupper($sControllerIdent);
        $sTranslation = $oLang->translateString(
            $sTranslationIdent,
            null,
            false
        );

        if ($sTranslation !== $sTranslationIdent) {
            return $sTranslation;
        } else {
            $sTranslationIdent = 'PAGE_TITLE_'.strtoupper($sControllerIdent);
            $sTranslation = $oLang->translateString(
                $sTranslationIdent,
                null,
                true
            );
            if ($sTranslation !== $sTranslationIdent) {
                return $sTranslation;
            }
        }

        return ucfirst($sControllerIdent);
    }
}
