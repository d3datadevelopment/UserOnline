[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]
[{assign var='oxcmp_user' value=$oView->getUser()}]
[{d3modcfgcheck modid="d3usersonline"}]
    [{if $oxcmp_user && $oxcmp_user->getFieldData('oxrights') == 'malladmin'}]
        [{assign var='aUsersOnline' value=$oView->getOnlineUsersByController()}]
        <div class="box">
            <h3>[{oxmultilang ident="D3_USERSONLINE_USERSONLINE"}]</h3>
            <div class="content">
                <table style="border-style: none; width: 100%;">
                    <tr>
                        <td style="border-bottom: 1px solid silver;">
                            [{oxmultilang ident="D3_USERSONLINE_ALL"}]
                        </td>
                        <td style="border-bottom: 1px solid silver; text-align: right; font-weight: bold;">
                            [{$oView->getOnlineUsersAll()}]&nbsp;
                        </td>
                        <td style="border-bottom: 1px solid silver; text-align: left;">
                            [{if $oView->getOnlineUsersAll() == 1}]
                                [{oxmultilang ident="D3_USERSONLINE_USER"}]
                            [{else}]
                                [{oxmultilang ident="D3_USERSONLINE_USERS"}]
                            [{/if}]
                        </td>
                    </tr>
                    [{foreach from=$aUsersOnline.classes item="aClassUser"}]
                        <tr>
                            <td>
                                [{if $aClassUser->classname}]
                                    [{$aClassUser->classname|ucfirst}]:
                                [{else}]
                                    undefined:
                                [{/if}]
                            </td>
                            <td style="text-align: right; font-weight: bold;">
                                [{$aClassUser->counter}]&nbsp;
                            </td>
                            <td style="text-align: left;">
                                [{if $aClassUser->counter == 1}]
                                    [{oxmultilang ident="D3_USERSONLINE_USER"}]
                                [{else}]
                                    [{oxmultilang ident="D3_USERSONLINE_USERS"}]
                                [{/if}]
                            </td>
                        </tr>
                    [{/foreach}]
                </table>
            </div>
        </div>
    [{/if}]
[{/d3modcfgcheck}]
[{include file="bottomitem.tpl"}]