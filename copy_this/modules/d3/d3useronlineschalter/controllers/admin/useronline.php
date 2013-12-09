<?php
/**
 * Class d3_d3useronlineschalter_controllers_admin_useronline
 */
class d3_d3useronlineschalter_controllers_admin_useronline extends d3_cfg_mod_main
{
    /**
     * @var int
     */
    protected $iExpTime = 600; // (in seconds)

    /**
     * @var string
     */
    protected $_sThisTemplate = 'd3usersonline.tpl';

    /**
     * @return int
     */
    public function getOnlineUsersAll()
    {
        $aUserOnline = $this->getOnlineUsersByController();

        return (int)$aUserOnline['all'];
    }

    /**
     * @return array
     */
    public function getOnlineUsersByController()
    {
        /** @var d3usersonline $oUsersOnline */
        $oUsersOnline = oxNew('d3usersonline');
        $oUsersOnline->clearOldItems($this->iExpTime);
        $oUsersOnline->setActTimeVisit();

        return $oUsersOnline->getUserCount();
    }
}
