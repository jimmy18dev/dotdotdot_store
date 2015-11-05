$(document).ready(function(){
    var link = $('#microdata-link').val();
    var title = $('#microdata-title').val();
    var image = $('#microdata-image').val();

    $('#facebook-sharing-btn').click(function(){
        FacebookShare(link);
    });

    $('#twitter-sharing-btn').click(function(){
        TwitterShare(title,link);
    });

    $('#pinterest-sharing-btn').click(function(){
        PinterestShare(title,link,image);
    });
});

function FacebookShare(link){
    window.open('https://www.facebook.com/sharer/sharer.php?u='+(link),'Facebook Sharing','_blank');
    return false;
}
function TwitterShare(title,link){
    window.open('https://twitter.com/intent/tweet?url='+link+'&text='+title,'Twitter Tweet','_blank');
    return false;
}
function PinterestShare(title,link,image){
    window.open('//pinterest.com/pin/create/link/?url='+link+'&media='+image+'&description='+title,'Pinterest','_blank');
    return false;
}