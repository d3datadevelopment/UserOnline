[{if $oxcmp_user && $oxcmp_user->oxuser__oxrights->value == 'malladmin'}]
    <strong class="h2" id="test_LeftSideInfoHeader">Online</strong>
    [{strip}]
        <div class="partners" style="padding-left: 10px;">
            [{$usersonline }] User(s)
        </div>
    [{/strip}]
[{/if}]