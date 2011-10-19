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

class d3ce_online_users extends oxI18n
{
    /**
     * Object core table name
     *
     * @var string
     */
    protected $_sCoreTbl = 'd3ce_online_users';

    /**
     * Current class name
     *
     * @var string
     */
    protected $_sClassName = 'd3ce_online_users';

    public function __construct($aParams = null)
    {
        parent::__construct();
        $this->init( 'd3ce_online_users' );
    }

    public function clearOldItems($iExpTime)
    {
	    $exptime = time() - $iExpTime;
        oxDb::getDb()->Execute("delete from ".$this->_sCoreTbl." where timevisit < $exptime");
    }

    public function getActUserItem($sUserIPHash)
    {
        $sSelect = "select count(*) from $this->_sCoreTbl where visitor='".$sUserIPHash."'";
        return oxDb::getDb()->getOne( $sSelect );
    }

    public function getUserCount()
    {
        $sSelect = "select count(*) from ".$this->_sCoreTbl." order by timevisit desc";
        $iCount = oxDb::getDb()->getOne($sSelect);
        return $iCount;
    }

    public function setActTimeVisit($sUserIpHash)
    {
		oxDb::getDb()->Execute("update ".$this->_sCoreTbl." set timevisit='".time()."', oxclass = '".$this->getConfig()->getActiveView()->getClassName()."' where visitor='".$sUserIpHash."'");
    }

    public function insertActUser($sUserIpHash)
    {
        oxDb::getDb()->Execute("insert into ".$this->_sCoreTbl." (visitor,timevisit,oxclass) values ('".$sUserIpHash."','".time()."', '".$this->getConfig()->getActiveView()->getClassName()."')");
    }

}
