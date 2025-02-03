/**
 * Created by msp on 16/03/20.
 */
$(function() {
    // ------------------------------------------------------- //
    // Multi Level dropdowns
    // ------------------------------------------------------ //
    $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
        event.preventDefault();
        event.stopPropagation();

        $(this).siblings().toggleClass("show");

        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }

        //console.log($(this).closest('li').siblings());
        //$(this).closest('li').siblings().removeClass("show");
        $(this).closest('li').siblings().find('.show').removeClass("show");

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

jQuery.validator.setDefaults({
    debug: false,
    validClass: "is-valid",
    errorClass: "is-invalid",
    errorElement: "span",
    errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');

        if($(element).parent().is('.dropify-wrapper')) {
            error.insertAfter($(element).parent());
        } else if($(element).parent().is('.input-group')) {
            error.insertAfter($(element).parent());
        } else if($(element).parent().is('.intl-tel-input')) {
            error.insertAfter($(element).parent());
        } else if($(element).parent().is('.validator-group')) {
            error.insertAfter($(element).parent());
        } else {
            error.appendTo($(element).parent());
        }
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass(errorClass).removeClass(validClass);
        $(element).closest('.form-group').addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass(errorClass).addClass(validClass);
        $(element).closest('.form-group').removeClass(errorClass).addClass(validClass);
    }
});

$.fn.select2.defaults.set("theme", "bootstrap4");

$(function() {
    'use strict';

    $('.select2').change(function() {
        $(this).valid();
    });

});

$(function () {
    'use strict';
    Breakpoints();

    var showPopover = function () {
        console.log('mouseenter');

        var $this = $(this);

        var popoverId = $this.data('popover-id');
        var $content = $('#'+popoverId);
        $content.attr('data-show', '');

        var popper = Popper.createPopper(this, $content[0], {
            placement: 'right'
        });

        $this.data('app-popper', popper);
    };

    var hidePopover = function () {
        var $this = $(this);

        if ($(this).is('.popup')) {
            $this = $($(this).data('trigger'));
        }

        console.log('mouseleave');


//            var $this = $(this);

        setTimeout(function () {
            var popoverId = $this.data('popover-id');
            var $content = $('#'+popoverId);

            console.log($content.is(':hover'));
            console.log($this.is(':hover'));

            if ($content.is(':hover') || $this.is(':hover')) {
                return;
            }

//            let $content = $(this).find('.popup').first();
            $content.removeAttr('data-show');

            var popper = $this.data('app-popper');
            if (popper) {
                popper.destroy();
                $this.data('app-popper', null);
            }
        }, 30);
    };

    var onBreakpointChange = function () {
        var $el = $('.popup-trigger');

        if (Breakpoints.is('xs') || Breakpoints.is('sm')) {
           $el.unbind('mouseenter', showPopover);
           $el.unbind('focus', showPopover);
           $el.unbind('mouseleave', hidePopover);
           $el.unbind('blur', hidePopover);
        } else {
           $el.bind('mouseenter', showPopover);
           $el.bind('focus', showPopover);
           $el.bind('mouseleave', hidePopover);
           $el.bind('blur', hidePopover);
        }
    };

    Breakpoints.on('change', onBreakpointChange);

    onBreakpointChange();

    $('.popup-trigger').each(function () {
        $(this).find('.popup').bind('mouseleave', hidePopover);
        $(this).find('.popup').bind('blur', hidePopover);
        $(this).find('.popup').data('trigger', this);
        $(this).find('.popup').appendTo('body');
    });
});
