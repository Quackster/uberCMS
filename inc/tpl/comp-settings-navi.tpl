<div> 
<div class="content"> 
<div class="habblet-container" style="float:left; width:210px;"> 
<div class="cbb settings"> 
 
<h2 class="title">Account Settings</h2> 
<div class="box-content"> 
            <div id="settingsNavigation"> 
            <ul> 
                <li class="selected">Looks</li> 
            </ul> 
            </div> 
</div></div> 

<?php if (!$users->HasClub(USER_ID)) { ?>
    <div class="cbb habboclub-tryout"> 
        <h2 class="title">Join Uber Club</h2> 
        <div class="box-content"> 
            <div class="habboclub-banner-container habboclub-clothes-banner"></div> 
            <p class="habboclub-header">Uber Club is our VIP members-only club: absolutely no riff-raff admitted! Members enjoy a wide range of benefits, including exclusive clothes, free gifts and an extended Friend List.</p> 
            <p class="habboclub-link"><a href="%www%/credits/uberclub">Check out Uber Club &gt;&gt;</a></p> 
        </div> 
    </div>
<?php } ?>
	
</div> 