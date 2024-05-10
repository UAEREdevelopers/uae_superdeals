// Quantity buttons
function qtySum() {
    // var arr = document.getElementsByClass('qtyInput');
    // var tot = 0;
    // for (var i = 0; i < arr.length; i++) {
    //     if (parseInt(arr[i].value))
    //         tot += parseInt(arr[i].value);
    // }

    adult = document.getElementsByName('adult')[0].value;
    children = document.getElementsByName('children')[0].value;
    rooms = document.getElementsByName('rooms')[0].value;

    tot = parseInt(adult) + parseInt(children);

    var cardQty = document.querySelector(".qtyTotal");
    cardQty.innerHTML = tot;

}
qtySum();

$(function() {

    $(".qtyButtons input").after('<div class="qtyInc"></div>');
    $(".qtyButtons input").before('<div class="qtyDec"></div>');

    $(".qtyDec, .qtyInc").on("click", function() {

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.hasClass('qtyInc')) {


            var newVal = parseFloat(oldValue) + 1;

            if ($(this).parent().data('type') == 'adult') {
                if (parseFloat(adult) + 1 > 10) {
                    newVal = oldValue;
                    alert('Maximum 10 Adults allowed');
                    return;
                }
            }

            if ($(this).parent().data('type') == 'children') {

                if (parseFloat(children) + 1 > 4) {
                    newVal = oldValue;
                    alert('Maximum 4 Childrens allowed');
                    return;
                }
            }

            if ($(this).parent().data('type') == 'rooms') {

                if (parseFloat(rooms) + 1 > adult) {
                    newVal = oldValue;
                    alert('Rooms cannot be more than adults count');
                    return;
                }
            }





        } else {
            // don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }

        $button.parent().find("input").val(newVal);
        qtySum();
        $(".qtyTotal").addClass("rotate-x");

    });

    function removeAnimation() { $(".qtyTotal").removeClass("rotate-x"); }
    const counter = document.querySelector(".qtyTotal");
    counter.addEventListener("animationend", removeAnimation);

});