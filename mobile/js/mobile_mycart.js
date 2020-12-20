/* jshint sub:true */
$(document).ready(function () {
    'use strict';
    // All sides
    var sides = ['left', 'top', 'right', 'bottom'];
    $('h1 span.version').text($.fn.sidebar.version);

    // Initialize sidebars
    for (var i = 0; i < sides.length; ++i) {
        var cSide = sides[i];
        $('.sidebar.' + cSide).sidebar({side: cSide});
    }
    ;

    /* SET LANGUAGE FOR CART */

    // $('.sl').click(function () {
    //   var id = $(this).data('id')
    //   if (id == 'ru') {
    //     var hreff = '/checkout-mobile.php'
    //   } else {
    //     var hrefff = '/checkout-mobile_' + id + '.php'
    //   }
    //
    //   var href = '/checkout-mobile_en.php'
    //   mycart.language($(this).data('id'), href)
    // })

  /*SELECT SIZE*/
  var options = $('#options')
  options.change(function () {
        $('.size-error').css('display', 'none');
    });

    /* PRODUCT ADD TO CART */
    $(document).on('click', '.addToCart', function () {
        var id = $(this).data('id')
        var qty = 1
        var options = $('#options').val()
        if (options !== '') {
            $('.size-error').css('display', 'none')
            mycart.add(id, qty, options)
        } else {
            $('.size-error').css('display', 'block')
        }
    })

    /* REMOVE PRODUCT IN CART */
    $(document).on('click', '.delincart', function () {
        var id = $(this).data('id')
        var size = $(this).data('size')
        var js = $(this).data('js')
        var el1 = $('#product' + id + '-' + js)
        var el2 = $('#product-' + id + '-' + js)
        el1.remove()
        el2.remove()
        mycart.remove(id, size)
    })

    /* CECKOUT FORM SHOW */
    // $('#btn-checkout').on('click', function () {
    //   $('.order-form').slideDown('slow')
    // })

    /* CREAT ORDER */
    $('#newOrder-mobile').on('click', function () {
        var error = false
        var msg = ''
        if ($('#email').val() == '') {
            error = true
            msg = 'Заполните Email'
        }
        if ($('#shiping').val() == '') {
            error = true
            if (msg == '') msg = 'Не выбран способ доставки'
        }
        if (error) {
            alert(msg)
        } else {
            var data = $('#order-form-mobile').serialize()
            $.ajax({
                url: 'order-mobile.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (json) {
                    if (json['success'].length) {
                        $('.form-success').html(json['success'])
                        setTimeout(function () {
                            /* location.reload(); */

                            window.location.replace('' + json['redirect'] + '')
                        }, 3000)
                    }
                    if (json['error']) {
                        $('.alert').html(json['error'])
                    }
                },
                error: function () {
                    alert('Error!')
                }
            })
        }
    });


    // $('#check-newOrder-mobile').on('click', function () {
    //   var error = false
    //   var msg = ''
    //   if ($('#email').val() == '') {
    //     error = true
    //     msg = 'Заполните Email'
    //   }
    //   if ($('#shiping').val() == '') {
    //     error = true
    //     if (msg == '') msg = 'Не выбран способ доставки'
    //   }
    //   if (error) {
    //     alert(msg)
    //   } else {
    //     var data = $('#check-order-form-mobile').serialize()
    //     $.ajax({
    //       url: 'order-mobile.php',
    //       type: 'POST',
    //       data: data,
    //       dataType: 'json',
    //       success: function (json) {
    //         if (json['success'].length) {
    //           $('.check-form-success').html(json['success'] )
    //           setTimeout(function () {
    //             /* location.reload(); */
    //
    //             window.location.replace('' + json['redirect'] + '')
    //           }, 5000)
    //         }
    //         if (json['error']) {
    //           $('.alert').html(json['error'])
    //         }
    //       },
    //       error: function () {
    //         alert('Error!')
    //       }
    //     })
    //   }
    // });

//   $('form').submit(function () {
//     var formID = $(this).attr('id'); // Получение ID формы
//     var formNm = $('#' + formID);
//     if(formNm == $('#search-form')){
//       break;
//     }
//     console.log(formID);
//     var error = false
//     var msg = ''
//     if ($('#email').val() == '') {
//       error = true
//       msg = 'Заполните Email'
//     }
//     if ($('#shiping').val() == '') {
//       error = true
//       if (msg == '') msg = 'Не выбран способ доставки'
//     }
//     if (error) {
//       alert(msg)
//     } else {
//       var data = formNm.serialize()
//     $.ajax({
//       type: 'POST',
//       url: 'order-mobile.php', // Обработчик формы отправки
//       data: data,
//       dataType: 'json',
//       success: function (json) {
//         if (json['success'].lenght) {
//           $('#bg_layer').append(
//               '<div id="modal-success-mobile">' + json['success'] + '</div>'
//           )
//           $('#bg_layer').show()
//           setTimeout(function () {
//             /* location.reload(); */
//             window.location.href('' + json['redirect'] + '')
//           }, 5000)
//         }
//         if (json['error']) {
//           $('.alert').html(json['error'])
//         }
//       },
//       error: function () {
//         alert('Error!')
//       }
//     });
//     return false;
//   }
// });
//


    /* EDIT COUNT PRODUCT IN CART */
    $('.pcount').on('change', function () {
        var id = $(this).data('id')
        var size = $(this).data('size')
        var js = $(this).data('js')
        mycart.update(id, $(this).val(), size, js)
    })

    /* HIDE SCROLL DIV */
    $('#bg_layer').hide()
    $('.sidebar.right').trigger('sidebar:close')

    $('a.btn-danger, #bg_layer').click(function () {
        hideCart()
    })

    function hideCart() {
        $('#bg_layer').hide()
        $('.sidebar.right').trigger('sidebar:close')
    }

    // Click handlers
    $('.btn[data-action]').on('click', function () {
        var $this = $(this)
        var action = $this.attr('data-action')
        var side = $this.attr('data-side')
        $('.sidebar.' + side).trigger('sidebar:' + action)
        $('#bg_layer').hide()
        return false
    })

    $('.h-cart').on('click', function () {
        $('#bg_layer').show()
        $('.sidebars').show()
        $('.sidebar.right').trigger('sidebar:open')
    })
})

var mycart = {
    add: function (key, quantity, options) {
        $.ajax({
            url: '/cart.php?add',
            type: 'get',
            data:
                'id=' +
                key +
                '&quantity=' +
                (typeof quantity !== 'undefined' ? quantity : 1) +
                '&options=' +
                options,
            dataType: 'json',
            success: function (json) {
                $('.sidebars').css('display', 'block')
                $('.count').html(json['count'])
                $('.total').html(json['total'])
                if (json['html']) {
                    $('#product-cart').append(json['html'])
                }
                if (json['quantity']) {
                    $('.quantity' + key + '-' + json['js']).html(json['quantity'])
                }
                $('#bg_layer').show()
                $('.sidebar.right').trigger('sidebar:open')
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText)
            }
        })
    },
    update: function (key, quantity, options, js) {
        $.ajax({
            url: '/cart.php?edit',
            type: 'get',
            data: 'key=' + key + '&quantity=' + quantity + '&options=' + options,
            dataType: 'json',
            success: function (json) {
                $('.quantity' + key + '-' + options).html(json['quantity'])
                var ptotal =
                    Number.parseInt($('#price' + key + '-' + js).text()) * quantity

                $('#total' + key + '-' + js).html(ptotal)
                $('.count').html(json['count'])
                $('.total').html(json['total'])
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText)
            }
        })
    },
    remove: function (key, options) {
        $.ajax({
            url: '/cart.php?remove',
            type: 'get',
            data: 'key=' + key + '&options=' + options,
            dataType: 'json',
            success: function (json) {
                $('.count').html(json['count'])
                $('.total').html(json['total'])
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText)
            }
        })
    },
    clear: function () {
        $.ajax({
            url: '/cart.php?clear',
            type: 'get',
            data: '',
            dataType: 'json',
            success: function (json) {
                $('#modal-cart').modal('hide')
                $('.count').html(json['count'])
                $('.total').html(json['total'])
                $('.right .form-groupe input').val('1')
                $('.right .form-groupe').addClass('hide')
                $('.addToCart').removeClass('hide')
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText)
            }
        })
    },
    language: function (key, href) {
        $.ajax({
            url: '/cart.php?language',
            type: 'get',
            data: 'key=' + key,
            dataType: 'json',
            success: function (json) {
                location.reload()
                // window.location.replace(""+ href +"");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText)
            }
        })
    }
}
