/**
 * Created by bazlur on 6/7/15.
 */
$( document ).ready(function() {

    var width = $('.narrow .nav-tabs.cases > li').width();
    /* alert(width-40);*/

    $('.narrow ul.nav.nav-tabs.cases li a').css('width',width-40+'px');

})