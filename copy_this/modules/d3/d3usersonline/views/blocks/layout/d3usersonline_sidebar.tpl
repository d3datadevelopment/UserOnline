[{d3modcfgcheck modid="d3usersonline"}]
    [{if $oxcmp_user && $oxcmp_user->getFieldData('oxrights') == 'malladmin'}]
        <div class="box">
            <h3>[{oxmultilang ident="D3_USERSONLINE_USERSONLINE"}]</h3>
            <div class="content">
                <table style="border-style: none; width: 100%;">
                    <tr>
                        <td style="border-bottom: 1px solid silver;">
                            [{oxmultilang ident="D3_USERSONLINE_ALL"}]
                        </td>
                        <td style="border-bottom: 1px solid silver; text-align: right; font-weight: bold;">
                            [{$aUsersOnline.all}]&nbsp;
                        </td>
                        <td style="border-bottom: 1px solid silver; text-align: left;">
                            [{if $aUsersOnline.all == 1}]
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

[{$smarty.block.parent}]