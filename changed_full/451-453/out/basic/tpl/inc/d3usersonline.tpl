[{if $oxcmp_user && $oxcmp_user->oxuser__oxrights->value == 'malladmin'}]
    <strong class="h2" id="test_LeftSideInfoHeader">[{oxmultilang ident="D3_USERSONLINE_USERSONLINE"}]</strong>
    <div class="partners" style="padding-left: 10px;">
        <table style="border-style: none; width: 100%;">
            <tr>
                <td style="border-bottom: 1px solid silver;">
                    [{oxmultilang ident="D3_USERSONLINE_ALL"}]
                </td>
                <td style="border-bottom: 1px solid silver; text-align: right;">
                    <b>[{$aUsersOnline.all }]</b>
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
                    <td>[{$aClassUser->classname|ucfirst}]:</td>
                    <td style="text-align: right;">
                        <b>[{$aClassUser->counter}]</b>
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
[{/if}]