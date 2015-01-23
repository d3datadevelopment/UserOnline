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

class d3_oxcmp_utils_usersonline extends d3_oxcmp_utils_usersonline_parent
{
    protected $_blIsComponent = true;
    protected $_iExpTime = 600; // (in seconds)
    protected $_sD3UsersOnlineModId = 'd3usersonline';

    /**
     * @return string
     */
    public function render()
    {
        $sRet = parent::render();

        if (d3_cfg_mod::get($this->_sD3UsersOnlineModId)->isActive()) {
            /** @var d3usersonline $oUsersOnline */
            $oUsersOnline = oxNew('d3usersonline');
            $oUsersOnline->clearOldItems($this->_iExpTime);
            $oUsersOnline->setActTimeVisit();

            $oUser = $this->getUser();
            if ($oUser && strtolower($oUser->getFieldData('oxrights')) == 'malladmin') {
                /** @var oxview $oActView */
                $oActView = $this->getParent();
                $oActView->addTplParam('aUsersOnline', $oUsersOnline->getUserCount());
            }
        }

        return $sRet;
    }
}
