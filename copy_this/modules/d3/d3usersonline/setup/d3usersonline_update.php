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

class d3usersonline_update extends d3install_updatebase
{
    public $sModKey = 'd3usersonline';
    public $sModName = 'Users Online';
    public $sModVersion = '2.0.1.1';
    public $sModRevision = '43';
    public $sBaseConf = 'Nv6RXZkcTl5NmIybDdzQldqUWo5dURBTXB4Tld3aHN3N2pmNmZacUljL0R4WUg2a1o4QUxLeVUrdjBSZ
WFud2VjRFJDa2ZvTHVaS2tpczAyZ0NGOGxwV3ZISHB3c0xRLzQ4Ny9kcTdDSjVQZDBYZ3VUMHFNaVg1R
3ZudGMzOGhsb01Sd1dTRG4xd0xscCtORC93VXJsWngrV200YktMSk93UENWNzJuT2NaT0U0UkJaQWdqa
nVKT0RwVFFzclYrT2JnckNGZjNieVRDSzcyV2Z2QktDR3RqNWJsemd6WURVMm1tbWl5cEJNMDFvR3JiS
2F5OHIvb0VoMUw1Nm9XdWdTc2FwVWpCVWFkZEllT1lGTzdiY2I0YUdNMmV3K3kyakZQMVRuUVJyUjhKO
DQ9';
    public $sRequirements = '';
    public $sBaseValue = '';

    public $sMinModCfgVersion = '4.3.7.0';

    protected $_aUpdateMethods = array(
        array('check' => 'checkUsersOnlineTableExist',
              'do'    => 'updateUsersOnlineTableExist'),
        array('check' => 'checkUsersOnlineTableEngine',
              'do'    => 'updateUsersOnlineTableEngine'),
        array('check' => 'checkRenameFields',
              'do'    => 'fixRenameFields'),
        array('check' => 'checkDeleteFields',
              'do'    => 'fixDeleteFields'),
        array('check' => 'checkModCfgItemExist',
              'do'    => 'updateModCfgItemExist'),
        array('check' => 'checkFields',
              'do'    => 'fixFields'),
        array('check' => 'checkIndizes',
              'do'    => 'fixIndizes'),
        array('check' => 'hasOldModuleFiles',
              'do'    => 'deleteOldModuleFiles'),
        array('check' => 'hasUnregisteredFiles',
              'do'    => 'showUnregisteredFiles'),
        array('check' => 'checkModCfgSameRevision',
              'do'    => 'updateModCfgSameRevision'),
    );

    public $aOldModuleFiles = array(
        'd3/d3usersonline/models/d3usersonline_update.php',
    );

    public $aFields = array(
        'OXID'        => array(
            'sTableName'  => 'd3usersonline',
            'sFieldName'  => 'OXID',
            'sType'       => 'char(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'TIMEVISIT' => array(
            'sTableName'  => 'd3usersonline',
            'sFieldName'  => 'TIMEVISIT',
            'sType'       => 'INT(11)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXCLASS'            => array(
            'sTableName'  => 'd3usersonline',
            'sFieldName'  => 'OXCLASS',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
    );

    public $aIndizes = array(
        'OXID' => array(
            'sTableName' => 'd3usersonline',
            'sType'      => 'PRIMARY',
            'aFields'    => array(
                'OXID' => 'OXID',
            ),
        ),
        'OXCLASS' => array(
            'sTableName' => 'd3usersonline',
            'sType'      => '',
            'sName'      => 'OXCLASS',
            'aFields'    => array(
                'OXCLASS' => 'OXCLASS',
            ),
        ),
    );

    public $aRenameFields = array(
        'OXID'        => array(
            'sTableName'  => 'd3usersonline',
            'mOldFieldNames' => array('id', 'ID'), // is case sensitive
            'sFieldName'  => 'OXID',
            'blMultilang' => false,
        ),
        'VISITOR'        => array(
            'sTableName'  => 'd3usersonline',
            'mOldFieldNames' => array('visitor'), // is case sensitive
            'sFieldName'  => 'VISITOR',
            'blMultilang' => false,
        ),
        'TIMEVISIT'        => array(
            'sTableName'  => 'd3usersonline',
            'mOldFieldNames' => array('timevisit'), // is case sensitive
            'sFieldName'  => 'TIMEVISIT',
            'blMultilang' => false,
        ),
        'OXCLASS'        => array(
            'sTableName'  => 'd3usersonline',
            'mOldFieldNames' => array('oxclass'), // is case sensitive
            'sFieldName'  => 'OXCLASS',
            'blMultilang' => false,
        ),
    );

    public $aDeleteFields = array(
        'VISITOR'        => array(
            'sTableName'  => 'd3usersonline',
            'sFieldName'  => 'VISITOR',
            'blMultilang' => false,
        ),
    );

    protected $_aRefreshMetaModuleIds = array('d3usersonline');

    /**
     * @return bool true, if table is missing
     */
    public function checkUsersOnlineTableExist()
    {
        return $this->_checkTableNotExist('d3usersonline');
    }

    /**
     * @return bool
     */
    public function updateUsersOnlineTableExist()
    {
        $blRet = true;

        if ($this->checkUsersOnlineTableExist()) {
            $blRet = $this->_addTable2('d3usersonline', $this->aFields, $this->aIndizes, 'users online', 'InnoDB');
        }

        return $blRet;
    }

    /**
     * @return bool true, if table has wrong engine
     */
    public function checkUsersOnlineTableEngine()
    {
        /** @var d3installdbtable $oDbTable */
        $oDbTable = oxNew('d3installdbtable', $this);
        $aData = $oDbTable->getTableData('d3usersonline');

        if (isset($aData) && count($aData) && isset($aData['ENGINE']) && $aData['ENGINE'] == 'InnoDB') {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function updateUsersOnlineTableEngine()
    {
        /** @var d3installdbtable $oDbTable */
        $oDbTable = oxNew('d3installdbtable', $this);
        $blRet = $oDbTable->changeTableEngine('d3usersonline', 'InnoDB');
        return $blRet;
    }

    /**
     * @return bool
     */
    public function checkModCfgItemExist()
    {
        $blRet = false;
        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop oxshop */
            $aWhere = array(
                'oxmodid'       => $this->sModKey,
                'oxnewrevision' => $this->sModRevision,
                'oxshopid'      => $oShop->getId(),
            );

            $blRet = $this->_checkTableItemNotExist('d3_cfg_mod', $aWhere);

            if ($blRet) {
                return $blRet;
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     */
    public function updateModCfgItemExist()
    {
        $blRet = false;

        if ($this->checkModCfgItemExist()) {
            foreach ($this->getShopList() as $oShop) {
                /** @var $oShop oxshop */
                $aWhere = array(
                    'oxmodid'       => $this->sModKey,
                    'oxshopid'      => $oShop->getId(),
                    'oxnewrevision' => $this->sModRevision,
                );

                if ($this->_checkTableItemNotExist('d3_cfg_mod', $aWhere)) {
                    // update don't use this property
                    unset($aWhere['oxnewrevision']);

                    $aInsertFields = array(
                        'OXID'           => array (
                            'content'       => "md5('" . $this->sModKey . " " . $oShop->getId() . " de')",
                            'force_update'  => true,
                            'use_quote'     => false,
                        ),
                        'OXSHOPID'       => array (
                            'content'       => $oShop->getId(),
                            'force_update'  => true,
                            'use_quote'     => true,
                        ),
                        'OXMODID'        => array (
                            'content'       => $this->sModKey,
                            'force_update'  => true,
                            'use_quote'     => true,
                        ),
                        'OXNAME'         => array (
                            'content'       => $this->sModName,
                            'force_update'  => true,
                            'use_quote'     => true,
                        ),
                        'OXACTIVE'       => array (
                            'content'       => "0",
                            'force_update'  => false,
                            'use_quote'     => false,
                        ),
                        'OXBASECONFIG'   => array (
                            'content'       => $this->sBaseConf,
                            'force_update'  => true,
                            'use_quote'     => true,
                        ),
                        'OXSERIAL'   => array (
                            'content'       => "",
                            'force_update'  => false,
                            'use_quote'     => true,
                        ),
                        'OXINSTALLDATE'  => array (
                            'content'       => "NOW()",
                            'force_update'  => true,
                            'use_quote'     => false,
                        ),
                        'OXVERSION'      => array (
                            'content'       => $this->sModVersion,
                            'force_update'  => true,
                            'use_quote'     => true,
                        ),
                        'OXSHOPVERSION'  => array (
                            'content'       => oxRegistry::getConfig()->getEdition(),
                            'force_update'  => true,
                            'use_quote'     => true,
                        ),
                        'OXREQUIREMENTS' => array (
                            'content'       => $this->sRequirements,
                            'force_update'  => true,
                            'use_quote'     => true,
                        ),
                        'OXVALUE'        => array(
                            'content'       => $this->sBaseValue,
                            'force_update'  => false,
                            'use_quote'     => true,
                        ),
                        'OXNEWREVISION'  => array(
                            'content'       => $this->sModRevision,
                            'force_update'  => true,
                            'use_quote'     => true,
                        )
                    );
                    $blRet          = $this->_updateTableItem2('d3_cfg_mod', $aInsertFields, $aWhere);
                    $this->setUpdateBreak(false);
                }
            }
        }
        return $blRet;
    }

    /**
     * @return bool
     */
    public function hasUnregisteredFiles()
    {
        return $this->_hasUnregisteredFiles($this->sModKey, array('d3FileRegister', 'blocks'));
    }

    /**
     * @return bool
     */
    public function showUnregisteredFiles()
    {
        return $this->_showUnregisteredFiles($this->sModKey, array('d3FileRegister', 'blocks'));
    }
}
