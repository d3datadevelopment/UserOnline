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

class d3usersonline extends oxI18n
{
    /**
     * Object core table name
     *
     * @var string
     */
    protected $_sCoreTbl = 'd3usersonline';

    /**
     * Current class name
     *
     * @var string
     */
    protected $_sClassName = 'd3usersonline';

    public function __construct($aParams = null)
    {
        parent::__construct();
        $this->init( 'd3usersonline' );
    }

    public function clearOldItems($iExpTime)
    {
	    $exptime = time() - $iExpTime;
        oxDb::getDb()->Execute("delete from ".$this->getViewName()." where timevisit < $exptime");
    }

    public function getActUserItem($sUserIPHash)
    {
        $sSelect = "select count(*) from ".$this->getViewName()." where visitor= ".oxDb::getDb()->quote($sUserIPHash);
        return oxDb::getDb()->getOne( $sSelect );
    }

    public function getUserCount()
    {
        $sSelect = "select count(*) counter, oxclass from ".$this->getViewName()." GROUP BY oxclass ORDER BY counter desc";

        $rs = oxDb::getDb(2)->Execute($sSelect);

        $iAllCounter = 0;
        $aUserClasses = array();
        if ($rs != false && $rs->RecordCount() > 0)
        {
            while (!$rs->EOF)
            {
                $oTmp = new stdClass;
                $oTmp->classname = $rs->fields['oxclass'];
                $oTmp->counter = $rs->fields['counter'];
                $iAllCounter += $rs->fields['counter'];
                $aUserClasses['classes'][] = $oTmp;
                $rs->moveNext();
            }
        }

        $aUserClasses['all'] = $iAllCounter;

        return $aUserClasses;
    }

    public function setActTimeVisit($sUserIpHash)
    {
		oxDb::getDb()->Execute("update ".$this->getViewName()." set timevisit= ".oxDb::getDb()->quote(time()).", oxclass = ".oxDb::getDb()->quote($this->getConfig()->getActiveView()->getClassName())." where visitor= ".oxDb::getDb()->quote($sUserIpHash));
    }

    public function insertActUser($sUserIpHash)
    {
        oxDb::getDb()->Execute("insert into ".$this->getViewName()." (visitor,timevisit,oxclass) values (".oxDb::getDb()->quote($sUserIpHash).", ".oxDb::getDb()->quote(time()).", ".oxDb::getDb()->quote($this->getConfig()->getActiveView()->getClassName()).")");
    }

}
