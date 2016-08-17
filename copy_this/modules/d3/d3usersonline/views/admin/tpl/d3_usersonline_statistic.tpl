[{include file="headitem.tpl" title="d3tbclussersonline_settings_main"|oxmultilangassign}]

<script type="text/javascript">
    <!--
    [{if $updatelist == 1}]
        UpdateList('[{$oxid}]');
    [{/if}]

    function UpdateList( sID)
    {
        var oSearch = parent.list.document.getElementById("search");
        oSearch.oxid.value=sID;
        oSearch.fnc.value='';
        oSearch.submit();
    }

    function EditThis( sID)
    {
        var oTransfer = document.getElementById("transfer");
        oTransfer.oxid.value=sID;
        oTransfer.cl.value='';
        oTransfer.submit();

        var oSearch = parent.list.document.getElementById("search");
        oSearch.actedit.value = 0;
        oSearch.oxid.value=sID;
        oSearch.submit();
    }

    function _groupExp(el) {
        var _cur = el.parentNode;

        if (_cur.className == "exp") _cur.className = "";
          else _cur.className = "exp";
    }

    -->
</script>

<style type="text/css">
    <!--
    fieldset {
        border:           1px inset black;
        background-color: #F0F0F0;
    }

    legend {
        font-weight: bold;
    }

    .groupExp dl dt {
        font-weight:  normal;
        width:        55%;
        padding-left: 10px;
    }

    .groupExp.highlighted {
        background-color: #CD0210;
    }

    .groupExp.highlighted a.rc b {
        color: white;
    }

    .groupExp.highlighted .exp a.rc b {
        color: black;
    }

    .groupExp.highlighted .exp {
        background-color: #F0F0F0;
    }

    .ext_edittext {
        padding: 2px;
    }

    td.edittext {
        white-space: normal;
    }

    .confinput {
        width:  300px;
        height: 70px;
    }

    -->
</style>

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="actshop" value="[{$shop->id}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

[{d3modcfgcheck modid="d3usersonline"}][{/d3modcfgcheck}]
[{if $mod_d3usersonline}]
    [{assign var="aUsersOnline" value=$oView->getUserCount()}]
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
[{else}]
    [{oxmultilang ident="D3USERSONLINE_NOTACTIVE"}]
[{/if}]

[{include file="d3_cfg_mod_inc.tpl"}]
