
var postId = 0;
$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token}
    })
        .done(function() {
            event.target.innerText = isLike ? event.target.innerText === 'Like' ? 'You like this post' : 'Like' : event.target.innerText === 'Dislike' ? 'You dont like this post' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});


function toggleFavourite(heart) {
    console.log(heart.id);
    heart.id = 1;
    var currentClass = $(heart).attr('class');
// send ajax
    $.ajax({
        url: "{{url('client/fav')}}",
        type: 'post',
        data: {product_id: heart.id, _token: "{{csrf_token()}}"},
        success: function (data) {
            console.log(data);
            if (data.status == 1) {
                // success
                if (currentClass.includes('first')) {
                    // not fav
                    $(heart).removeClass('first-heart').addClass('second-heart');
                } else {
                    // is fav
                    $(heart).removeClass('second-heart').addClass('first-heart');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}



