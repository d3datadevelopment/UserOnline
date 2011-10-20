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
 * @author Aggrosoft, D³ Data Development
 */

class d3_oxcmp_utils_usersonline extends d3_oxcmp_utils_usersonline_parent
{
    protected $_iExpTime = 600; // (in seconds)
    protected $_sUserIpHash = null;
    protected $_remoteAddr = null;
    protected $_httpClientIp = null;
    protected $_httpXForwardedFor = null;
    protected $_httpXForwarded = null;
    protected $_httpForwardedFor = null;
    protected $_httpForwarded = null;
    protected $_httpVia = null;
    protected $_httpXComingFrom = null;
    protected $_httpComingFrom = null;
    protected $_proxyIp = null;
    protected $_directIp = null;

    public function init()
    {
        $this->blIsComponent = true;
        parent::init();
    }

    public function render()
    {
        $ret = parent::render();

        //WE ARE NOT ALLOWED TO STORE THE REAL IP
        $this->_sUserIpHash = md5($this->_getTrueIP());
        $this->utime = time();

        $oUserOnline = oxNew('d3usersonline');
        $oUserOnline->clearOldItems($this->_iExpTime);
        $iUserExist = $oUserOnline->getActUserItem($this->_sUserIpHash);

		if ($iUserExist > 0) {
            $oUserOnline->setActTimeVisit($this->_sUserIpHash);
		} else {
            $oUserOnline->insertActUser($this->_sUserIpHash);
		}

        $this->_oParent->_aViewData['aUsersOnline'] = $oUserOnline->getUserCount();

        return $ret;
    }

    private function _getIpData($sTargetVarName, $sDataName)
    {
        if (empty($this->{$sTargetVarName}))
        {
            if (!empty($_SERVER) && isset($_SERVER[$sDataName]))
                $this->{$sTargetVarName} = $_SERVER[$sDataName];
            else if (!empty($_ENV) && isset($_ENV[$sDataName]))
                $this->{$sTargetVarName} = $_ENV[$sDataName];
            else if (@getenv($sDataName))
                $this->{$sTargetVarName} = getenv($sDataName);
        }
    }

    private function _getTrueIP()
    {
        $this->_getIpData('_remoteAddr','REMOTE_ADDR');
        $this->_getIpData('_httpClientIp','HTTP_CLIENT_IP');
        $this->_getIpData('_httpXForwardedFor','HTTP_X_FORWARDED_FOR');
        $this->_getIpData('_httpXForwarded','HTTP_X_FORWARDED');
        $this->_getIpData('_httpForwardedFor','HTTP_FORWARDED_FOR');
        $this->_getIpData('_httpForwarded','HTTP_FORWARDED');
        $this->_getIpData('_httpVia','HTTP_VIA');
        $this->_getIpData('_httpXComingFrom','HTTP_X_COMING_FROM');
        $this->_getIpData('_httpComingFrom','HTTP_COMING_FROM');

        // Gets the default ip sent by the user
        if (!empty($this->_remoteAddr))
            $this->_directIp = $this->_remoteAddr;

        // Gets the proxy ip sent by the user
        if (!empty($this->_httpXForwardedFor))
            $this->_proxyIp = $this->_httpXForwardedFor;
        else if (!empty($this->_httpXForwarded))
            $this->_proxyIp = $this->_httpXForwarded;
        else if (!empty($this->_httpForwardedFor))
            $this->_proxyIp = $this->_httpForwardedFor;
        else if (!empty($this->_httpForwarded))
            $this->_proxyIp = $this->_httpForwarded;
        else if (!empty($this->_httpVia))
            $this->_proxyIp = $this->_httpVia;
        else if (!empty($this->_httpXComingFrom))
            $this->_proxyIp = $this->_httpXComingFrom;
        else if (!empty($this->_httpComingFrom))
            $this->_proxyIp = $this->_httpComingFrom;

        // Returns the true IP if it has been found, else ...
        if (empty($this->_proxyIp))
        {
            // True IP without proxy
            return $this->_directIp;
        }
        else
        {
            $is_ip = ereg('^([0-9]{1,3}.){3,3}[0-9]{1,3}', $this->_proxyIp, $regs);

            if ($is_ip && (count($regs) > 0))
            {
                // True IP behind a proxy
                return $regs[0];
            }
            else
            {
                if (empty($this->_httpClientIp))
                {
                    // Can't define IP: there is a proxy but we don't have
                    // information about the true IP
                    return "(unbekannt) " . $this->_proxyIp;
                }
                else
                {
                    // better than nothing
                    return $this->_httpClientIp;
                }
            }
        }
    }
}