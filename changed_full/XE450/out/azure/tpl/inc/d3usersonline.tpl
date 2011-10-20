[{if $oxcmp_user && $oxcmp_user->oxuser__oxrights->value == 'malladmin'}]
    <div class="box">
        <h3>Online</h3>
        <div class="content">
            [{$usersonline }] User(s)
        </div>
    </div>
[{/if}]