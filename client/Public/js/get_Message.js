/* ===========================================================
 * jquery-let_it_snow.js v1
 * ===========================================================
 * NOTE: This plugin is based on the work by Jason Brown (Loktar00)
 *
 * As the end of the year approaches, let's add 
 * some festive to your website!
 *
 *
 * ========================================================== */
function get_message(){
        $.get('/pokpets_mobile/index.php/user/user/get_new',function(result){
            if(result.status && result.data == '1'){
             //red dot
                $('.redpoint').removeClass('dis_hide').addClass('reddot');
            }
        },'json');
    }
$(document).ready(function(){
    
    setInterval('get_message()',30000);
    
})

