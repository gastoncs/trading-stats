/**
 * Created by gastoncs on 7/31/21.
 */

$(".search_input").keyup(function () {
    var filter = jQuery(this).val();
    $("table tr").each(function () {
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).hide();
        } else {
            $(this).show()
        }
    });
});