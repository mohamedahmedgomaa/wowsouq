
////////////////////// Start Like /////////////////////////////

$('.like').on('click', function() {
    var like_s = $(this).attr('data-like');
    var product_id = $(this).attr('data-productid');
    product_id = product_id.slice(0,-2);
    // alert(product_id);

    $.ajax({
        type: 'post',
        url : url,
        data : {like_s: like_s, product_id: product_id, _token: token},

        success: function(data) {

            if (data.is_like == 1) {
                $('*[data-productid="'+ product_id +'_l"]').removeClass('btn-secondry').addClass('btn-success');
                $('*[data-productid="'+ product_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry');

                var cu_like = $('*[data-productid="'+ product_id +'_l"]').find('.like_count').text();
                var new_like = parseInt(cu_like) + 1;
                $('*[data-productid="'+ product_id +'_l"]').find('.like_count').text(new_like);


                if (data.change_like == 1) {
                    var cu_dislike = $('*[data-productid="'+ product_id +'_d"]').find('.dislike_count').text();
                    var new_dislike = parseInt(cu_dislike) - 1;
                    $('*[data-productid="'+ product_id +'_d"]').find('.dislike_count').text(new_dislike);
                }
            }

            if (data.is_like == 0) {
                $('*[data-productid="'+ product_id +'_l"]').removeClass('btn-success').addClass('btn-secondry');

                var cu_like = $('*[data-productid="'+ product_id +'_l"]').find('.like_count').text();
                var new_like = parseInt(cu_like) - 1;
                $('*[data-productid="'+ product_id +'_l"]').find('.like_count').text(new_like);
            }
        }
    });
});

////////////////////// End Like /////////////////////////////

////////////////////// Start DesLike /////////////////////////////

$('.dislike').on('click', function() {
    var like_s = $(this).attr('data-like');
    var product_id = $(this).attr('data-productid');
    product_id = product_id.slice(0,-2);
    // alert(product_id);

    $.ajax({
        type: 'post',
        url : url_dis,
        data : {like_s: like_s, product_id: product_id, _token: token},

        success: function(data) {

            if (data.is_dislike == 1) {
                $('*[data-productid="'+ product_id +'_d"]').removeClass('likebtn-secondry').addClass('btn-danger');
                $('*[data-productid="'+ product_id +'_l"]').removeClass('btn-success').addClass('btn-secondry');

                var cu_dislike = $('*[data-productid="'+ product_id +'_d"]').find('.dislike_count').text();
                var new_dislike = parseInt(cu_dislike) + 1;
                $('*[data-productid="'+ product_id +'_d"]').find('.dislike_count').text(new_dislike);

                if (data.change_dislike == 1) {
                    var cu_like = $('*[data-productid="'+ product_id +'_l"]').find('.like_count').text();
                    var new_like = parseInt(cu_like) - 1;
                    $('*[data-productid="'+ product_id +'_l"]').find('.like_count').text(new_like);
                }
            }

            if (data.is_dislike == 0) {
                $('*[data-productid="'+ product_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry');

                var cu_dislike = $('*[data-productid="'+ product_id +'_d"]').find('.dislike_count').text();
                var new_dislike = parseInt(cu_dislike) - 1;
                $('*[data-productid="'+ product_id +'_d"]').find('.dislike_count').text(new_dislike);
            }
        }
    });
});

////////////////////// End DesLike /////////////////////////////
