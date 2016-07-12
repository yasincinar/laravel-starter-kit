/**
 * Created by yasincinar on 01/07/16.
 */
$(function () {
    var isBootstrapTable = $("[data-current-language]").attr('data-current-language');
    if (isBootstrapTable)
        $.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales[$("[data-current-language]").attr('data-current-language')]);

    $('[data-toggle="tooltip"]').tooltip();
    var notificationAlert = $(".notification-alert").text();
    if (notificationAlert) {
        var n = noty({
            layout: 'bottomRight',
            type: 'success',
            text: notificationAlert,
            animation: {
                open: 'animated fadeIn', // Animate.css class names
                close: 'animated fadeOut', // Animate.css class names
                easing: 'swing', // easing
                speed: 1000 // opening & closing animation speed
            }
        })
    }
    var log = function (str) {
        console.log(str);
    };
    var cancelButton = $("#cancel-btn");
    previousLink = cancelButton.on('click', function () {
        window.location = cancelButton.data('href');
    });
    $("#store-btn").on("click", function () {
        var fid = $(this).parents("form:eq(0)").attr("id");
        var red = $(this).parents("form").attr("data-redirect");
        blockUI();
        var options = {
            error: showError,  // post-submit callback
            success: showSuccess
            //url: red        // override for form's 'action' attribute
        };
        var xhr = $("#" + fid).ajaxForm(options);

        function showError(response) {
            var type;
            unBlockUI();
            var message = "";
            $.each(JSON.parse(response.responseText), function (idx, obj) {
                message += obj + "<br/>";
            });
            if (response.status != 422) {
                type = "error";
            } else {
                type = "warning";
            }

            swal({html: 1, title: "", text: message, type: type, confirmButtonText: "Ok"});
        }

        function showSuccess(response) {
            /** @namespace response.redirect output json */
            if (response.redirect)
                red = response.redirect;
            unBlockUI();
            if (response.success) {
                //swal({html: 1, title: "", text: "", type: "success", confirmButtonText: "Ok"});
                swal({
                    title: response.messages,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#A5DC86",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,

                }, function () {
                    window.location.href = red;
                });


            } else {
                var message = '';
                $.each(JSON.parse(response.messages), function (idx, obj) {
                    log(response.messages);
                    message += obj + "<br/>";
                });
                swal({html: 1, title: "", text: message, type: "warning", confirmButtonText: "Ok"});
            }
        }
    });


    //SLUG
    $.fn.editable.defaults.mode = 'inline';
    var beforeSlug = $("#before-slug");
    var token = beforeSlug.data('token');
    var slugChange;
    var slug, defaultValue;
    var model = beforeSlug.data('model');
    $('#before-slug > input').addClass('slug-class');

    beforeSlug.append('<div class="col-sm-12"><div class="slug info" style="margin-top: 5px;">' +
        ' &nbsp;SEO: <a href="#" id="url" data-type="text" data-value=""></a> ' +
        '<input name="slug" data-value="" type="hidden">' +
        '</div></div>');
    $(".slug-class").on('change', function (e) {
        var slug = $(this).val();
        if (slugChange != "changed")
            getSlug(slug, token, model);

    });
    if (beforeSlug.data('slug')) {
        slugChange = "changed";
        slug = beforeSlug.data('slug');
        defaultValue = beforeSlug.data('slug');
        $('input[name="slug"]').val(slug)
    } else {
        slug = beforeSlug.data("slugDefault");
        defaultValue = ""
    }
    $("#url").editable({
        emptytext: slug,
        defaultValue: defaultValue,
        validate: function (value) {
            if ($.trim(value) == '') {
                return ' ';
            }
        },
        success: function (response, newValue) {
            getSlug(newValue, token, model);
            slugChange = "changed";
        }
    });
});

var blockUI = function () {
    $.blockUI({
        message: '<p class="blockui"><i class="fa fa-spinner fa-pulse fa-3x fa-white"></i></p>',
        css: {
            padding: 0,
            margin: 0,
            width: '10%',
            fontSize: '10px',
            top: '40%',
            left: '',
            right: '40%',
            textAlign: 'center',
            color: '#fff',
            border: '0',
            backgroundColor: '',
            cursor: 'wait'
        }
    });

};


var unBlockUI = function () {
    $.unblockUI();
};

var notyMessage = function (layout, type, text) {
    noty({
        layout: layout,
        type: type,
        text: text,
        animation: {
            open: 'animated  flipInX', // Animate.css class names
            close: 'animated flipOutX', // Animate.css class names
            easing: 'swing', // easing
            speed: 1000 // opening & closing animation speed
        }
    });
    if (type !== 'confirm') {
        //@todo Set the confirmation buttons !!
        setTimeout(function () {
            $.noty.closeAll()
        }, 5000);
    }
};

function getSlug(slug, _token, model) {
    var postData = 'slug=' + slug + '&_token=' + _token + '&model=' + model;
    $.ajax({
        type: 'POST',
        url: $("#before-slug").data("href"),
        data: postData,
        beforeSend: function (a) {
            blockUI();
        },
        success: function (output) {
            unBlockUI();
            output = $.parseJSON(output);
            $('input[name="slug"]').val(output);
            $("#url").editable("setValue", output)
        }
    });
}

$("body").delegate(".deleteRows ", "click", function () {
    var title = $(this).data('title');
    var confirm_btn = $(this).data('confirm');
    var cancel_btn = $(this).data('cancel');
    var done = $(this).data('done');
    var token = $(this).data('token');
    var link = $(this).data('link');
    var parent = $(this).closest('tr');
    var dataString = '&_token=' + token;
    var deleteMessages = $(this).data("message");
    var errorMessage = $(this).data("error");
    var clickedElement = $(this);

    if (!deleteMessages)
        deleteMessages = "";
    swal({
        title: "",
        text: "<strong>" + title + "</strong>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: confirm_btn,
        cancelButtonText: cancel_btn,
        closeOnConfirm: false,
        html: true
    }, function () {
        $.ajax({
            url: link,
            type: 'DELETE',
            cache: false,
            data: dataString,
            beforeSend: function (html) {
                blockUI();
            },
            success: function (outputs) {
                $.unblockUI();
                if (outputs.success == true) {
                    if (typeof outputs.removeClass != 'undefined') {
                        parent = clickedElement.parents().eq(3);
                    }
                    parent.fadeOut(600, function () {
                        parent.remove();
                    });
                    swal({
                        title: "",
                        text: "<strong>" + outputs.messages + "</strong>",
                        type: "success",
                        confirmButtonText: "OK",
                        timer: 4000,
                        html: true
                    });
                }
                else {
                    swal({
                        title: "",
                        text: "<strong>" + outputs.messages + "</strong>",
                        type: "warning",
                        confirmButtonText: "OK",
                        timer: 4000,
                        html: true
                    });
                }
            },
            error: function (outputs) {
                $.unblockUI();
                swal({
                    title: "",
                    text: "<strong>" + errorMessage + "</strong>",
                    type: "error",
                    confirmButtonText: "OK",
                    timer: 4000,
                    html: true
                });
            }
        });

    });
});




