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

class d3usersonline extends oxbase
{
    protected $_sCoreTbl = 'd3usersonline';
    protected $_sClassName = 'd3usersonline';

    protected $_remoteAddr = null;
    protected $_httpClientIp = null;
    protected $_httpXForwardedFor = null;
    protected $_httpXForwarded = null;
    protected $_httpForwardedFor = null;
    protected $_httpForwarded = null;
    protected $_httpVia = null;
    protected $_httpXComingFrom = null;
    protected $_httpComingFrom = null;

    protected $_iDeleteThreshold = 30; // Zeitdifferenz für Löschaufträge

    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->init('d3usersonline');
    }

    /**
     * @param $iExpTime
     */
    public function clearOldItems($iExpTime)
    {
        startProfile(__METHOD__);

        $iTime = time();
        $iLastDeleteTime = oxRegistry::getConfig()->getShopConfVar('iLastDeleteTime', null, 'd3usersonline');

        if ($iTime > $iLastDeleteTime + $this->_iDeleteThreshold) {
            $iExptime = $iTime - $iExpTime;
            oxDb::getDb()->Execute("delete from " . $this->getViewName() . " where timevisit < $iExptime");

            oxRegistry::getConfig()->saveShopConfVar('int', 'iLastDeleteTime', $iTime, null, 'd3usersonline');
        }

        stopProfile(__METHOD__);
    }

    /**
     * @return array
     */
    public function getUserCount()
    {
        startProfile(__METHOD__);

        $sSelect = "select count(oxid) AS counter, oxclass from ".
            $this->getViewName()." GROUP BY oxclass ORDER BY counter desc";
        $aRecords = oxDb::getDb(oxDb::FETCH_MODE_ASSOC)->getAll($sSelect);

        $iAllCounter = 0;
        $aUserClasses = array();
        if ($aRecords && is_array($aRecords) && count($aRecords)) {
            foreach ($aRecords as $aRecord) {
                $aRecord = array_change_key_case($aRecord, CASE_UPPER);

                $oTmp = new stdClass;
                $oTmp->classname = $aRecord['OXCLASS'];
                $oTmp->counter = $aRecord['COUNTER'];
                $iAllCounter += $aRecord['COUNTER'];
                $aUserClasses['classes'][] = $oTmp;
            }
        }

        $aUserClasses['all'] = $iAllCounter;

        stopProfile(__METHOD__);

        return $aUserClasses;
    }

    public function setActTimeVisit()
    {
        startProfile(__METHOD__);

        $this->setId($this->_getIPHash());

        $aValues = array(
            'timevisit' => time(),
            'oxclass'   => oxRegistry::getConfig()->getActiveView()->getClassName()
        );

        $this->assign($aValues);
        $this->save();

        stopProfile(__METHOD__);
    }

    /**
     * @return string
     */
    protected function _getIPHash()
    {
        return md5($this->_getTrueIP());
    }

    /**
     * @return null|string
     */
    protected function _getTrueIP()
    {
        $sDirectIp = '';

        $this->_getIpData('_remoteAddr', 'REMOTE_ADDR');
        $this->_getIpData('_httpClientIp', 'HTTP_CLIENT_IP');
        $this->_getIpData('_httpXForwardedFor', 'HTTP_X_FORWARDED_FOR');
        $this->_getIpData('_httpXForwarded', 'HTTP_X_FORWARDED');
        $this->_getIpData('_httpForwardedFor', 'HTTP_FORWARDED_FOR');
        $this->_getIpData('_httpForwarded', 'HTTP_FORWARDED');
        $this->_getIpData('_httpVia', 'HTTP_VIA');
        $this->_getIpData('_httpXComingFrom', 'HTTP_X_COMING_FROM');
        $this->_getIpData('_httpComingFrom', 'HTTP_COMING_FROM');

        // Gets the default ip sent by the user
        if (!empty($this->_remoteAddr)) {
            $sDirectIp = $this->_remoteAddr;
        }

        // Gets the proxy ip sent by the user
        if (!empty($this->_httpXForwardedFor)) {
            $sProxyIp = $this->_httpXForwardedFor;
        } elseif (!empty($this->_httpXForwarded)) {
            $sProxyIp = $this->_httpXForwarded;
        } elseif (!empty($this->_httpForwardedFor)) {
            $sProxyIp = $this->_httpForwardedFor;
        } elseif (!empty($this->_httpForwarded)) {
            $sProxyIp = $this->_httpForwarded;
        } elseif (!empty($this->_httpVia)) {
            $sProxyIp = $this->_httpVia;
        } elseif (!empty($this->_httpXComingFrom)) {
            $sProxyIp = $this->_httpXComingFrom;
        } elseif (!empty($this->_httpComingFrom)) {
            $sProxyIp = $this->_httpComingFrom;
        }

        // Returns the true IP if it has been found, else ...
        if (empty($sProxyIp)) {
            // True IP without proxy
            return $sDirectIp;
        } else {
            $blIsIp = preg_match('@^([0-9]{1,3}.){3,3}[0-9]{1,3}@', $sProxyIp, $aMatches);

            if ($blIsIp && (count($aMatches) > 0)) {
                // True IP behind a proxy
                return $aMatches[0];
            } else {
                if (empty($this->_httpClientIp)) {
                    // Can't define IP: there is a proxy but we don't have
                    // information about the true IP
                    return "(unbekannt) " . $sProxyIp;
                } else {
                    // better than nothing
                    return $this->_httpClientIp;
                }
            }
        }
    }

    /**
     * @param $sTargetVarName
     * @param $sDataName
     */
    protected function _getIpData($sTargetVarName, $sDataName)
    {
        if (empty($this->{$sTargetVarName})) {
            if (!empty($_SERVER) && isset($_SERVER[$sDataName])) {
                $this->{$sTargetVarName} = $_SERVER[$sDataName];
            } elseif (!empty($_ENV) && isset($_ENV[$sDataName])) {
                $this->{$sTargetVarName} = $_ENV[$sDataName];
            } elseif (@getenv($sDataName)) {
                $this->{$sTargetVarName} = getenv($sDataName);
            }
        }
    }
}
