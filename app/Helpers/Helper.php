<?php
function lang_dropdown($url) {
if(Session::get('applocale') == "mm") {
return '
<ul class="lang nav navbar-nav">
    <li>
         <a href="javascript:void(0)" class="dropdown-anchor"><img src="'.$url.'/public/img/flag/mm.jpg" alt="English"> | ျမန္မာ <img src="'.$url.'/public/img/down-arrow-white.png" alt="Drop down" height="15px"></a>
        <div class="lang-box">
            <ul>
                <a href="'.$url.'/lang/en"><li>
                    <img src="'.$url.'/public/img/flag/en.png" alt="အဂၤလိပ္">
                    အဂၤလိပ္
                </li></a>
            </ul>
        </div>
    </li>
</ul>
';   
} else {
return '
<ul class="lang nav navbar-nav">
    <li>
        <a href="javascript:void(0)" class="dropdown-anchor"><img src="'.$url.'/public/img/flag/en.png" alt="English"> | English <img src="'.$url.'/public/img/down-arrow-white.png" alt="Drop down" height="15px"></a> 
        <div class="lang-box">
            <ul>
                <a href="'.$url.'/lang/mm"><li>
                    <img src="'.$url.'/public/img/flag/mm.jpg" alt="ဗမာ">
                    Myanmar
                </li></a>
            </ul>
        </div>
    </li>
</ul>
';
}
}