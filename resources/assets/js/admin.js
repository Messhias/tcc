var currentLocation = window.location.pathname.split( '/' );

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

$(function() {
    $('#sign_in').validate({
        highlight: function(input) {
            console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function(input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function(error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
});

if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

$.AdminBSB = {};
$.AdminBSB.options = {
    colors: {
        red: '#F44336',
        pink: '#E91E63',
        purple: '#9C27B0',
        deepPurple: '#673AB7',
        indigo: '#3F51B5',
        blue: '#2196F3',
        lightBlue: '#03A9F4',
        cyan: '#00BCD4',
        teal: '#009688',
        green: '#4CAF50',
        lightGreen: '#8BC34A',
        lime: '#CDDC39',
        yellow: '#ffe821',
        amber: '#FFC107',
        orange: '#FF9800',
        deepOrange: '#FF5722',
        brown: '#795548',
        grey: '#9E9E9E',
        blueGrey: '#607D8B',
        black: '#000000',
        white: '#ffffff'
    },
    leftSideBar: {
        scrollColor: 'rgba(0,0,0,0.5)',
        scrollWidth: '4px',
        scrollAlwaysVisible: false,
        scrollBorderRadius: '0',
        scrollRailBorderRadius: '0'
    },
    dropdownMenu: {
        effectIn: 'fadeIn',
        effectOut: 'fadeOut'
    }
}

/* Left Sidebar - Function =================================================================================================
 *  You can manage the left sidebar menu options
 *  
 */
$.AdminBSB.leftSideBar = {
    activate: function() {
        var _this = this;
        var $body = $('body');
        var $overlay = $('.overlay');

        //Close sidebar
        $(window).click(function(e) {
            var $target = $(e.target);
            if (e.target.nodeName.toLowerCase() === 'i') { $target = $(e.target).parent(); }

            if (!$target.hasClass('bars') && _this.isOpen() && $target.parents('#leftsidebar').length === 0) {
                if (!$target.hasClass('js-right-sidebar')) $overlay.fadeOut();
                $body.removeClass('overlay-open');
            }
        });

        $.each($('.menu-toggle.toggled'), function(i, val) {
            $(val).next().slideToggle(0);
        });

        //When page load
        $.each($('.menu .list li.active'), function(i, val) {
            var $activeAnchors = $(val).find('a:eq(0)');

            $activeAnchors.addClass('toggled');
            $activeAnchors.next().show();
        });

        //Collapse or Expand Menu
        $('.menu-toggle').on('click', function(e) {
            var $this = $(this);
            var $content = $this.next();

            if ($($this.parents('ul')[0]).hasClass('list')) {
                var $not = $(e.target).hasClass('menu-toggle') ? e.target : $(e.target).parents('.menu-toggle');

                $.each($('.menu-toggle.toggled').not($not).next(), function(i, val) {
                    if ($(val).is(':visible')) {
                        $(val).prev().toggleClass('toggled');
                        $(val).slideUp();
                    }
                });
            }

            $this.toggleClass('toggled');
            $content.slideToggle(320);
        });

        //Set menu height
        _this.setMenuHeight();
        _this.checkStatuForResize(true);
        $(window).resize(function() {
            _this.setMenuHeight();
            _this.checkStatuForResize(false);
        });

        //Set Waves
        Waves.attach('.menu .list a', ['waves-block']);
        Waves.init();
    },
    setMenuHeight: function() {
        if (typeof $.fn.slimScroll != 'undefined') {
            var configs = $.AdminBSB.options.leftSideBar;
            var height = ($(window).height() - ($('.legal').outerHeight() + $('.user-info').outerHeight() + $('.navbar').innerHeight()));
            var $el = $('.list');

            $el.slimScroll({ destroy: true }).height("auto");
            $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

            $el.slimscroll({
                height: height + "px",
                color: configs.scrollColor,
                size: configs.scrollWidth,
                alwaysVisible: configs.scrollAlwaysVisible,
                borderRadius: configs.scrollBorderRadius,
                railBorderRadius: configs.scrollRailBorderRadius
            });
        }
    },
    checkStatuForResize: function(firstTime) {
        var $body = $('body');
        var $openCloseBar = $('.navbar .navbar-header .bars');
        var width = $body.width();

        if (firstTime) {
            $body.find('.content, .sidebar').addClass('no-animate').delay(1000).queue(function() {
                $(this).removeClass('no-animate').dequeue();
            });
        }

        if (width < 1170) {
            $body.addClass('ls-closed');
            $openCloseBar.fadeIn();
        } else {
            $body.removeClass('ls-closed');
            $openCloseBar.fadeOut();
        }
    },
    isOpen: function() {
        return $('body').hasClass('overlay-open');
    }
};
//==========================================================================================================================

/* Right Sidebar - Function ================================================================================================
 *  You can manage the right sidebar menu options
 *  
 */
$.AdminBSB.rightSideBar = {
        activate: function() {
            var _this = this;
            var $sidebar = $('#rightsidebar');
            var $overlay = $('.overlay');

            //Close sidebar
            $(window).click(function(e) {
                var $target = $(e.target);
                if (e.target.nodeName.toLowerCase() === 'i') { $target = $(e.target).parent(); }

                if (!$target.hasClass('js-right-sidebar') && _this.isOpen() && $target.parents('#rightsidebar').length === 0) {
                    if (!$target.hasClass('bars')) $overlay.fadeOut();
                    $sidebar.removeClass('open');
                }
            });

            $('.js-right-sidebar').on('click', function() {
                $sidebar.toggleClass('open');
                if (_this.isOpen()) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
            });
        },
        isOpen: function() {
            return $('.right-sidebar').hasClass('open');
        }
    }
    //==========================================================================================================================

/* Searchbar - Function ================================================================================================
 *  You can manage the search bar
 *  
 */
var $searchBar = $('.search-bar');
$.AdminBSB.search = {
        activate: function() {
            var _this = this;

            //Search button click event
            $('.js-search').on('click', function() {
                _this.showSearchBar();
            });

            //Close search click event
            $searchBar.find('.close-search').on('click', function() {
                _this.hideSearchBar();
            });

            //ESC key on pressed
            $searchBar.find('input[type="text"]').on('keyup', function(e) {
                if (e.keyCode == 27) {
                    _this.hideSearchBar();
                }
            });
        },
        showSearchBar: function() {
            $searchBar.addClass('open');
            $searchBar.find('input[type="text"]').focus();
        },
        hideSearchBar: function() {
            $searchBar.removeClass('open');
            $searchBar.find('input[type="text"]').val('');
        }
    }
    //==========================================================================================================================

/* Navbar - Function =======================================================================================================
 *  You can manage the navbar
 *  
 */
$.AdminBSB.navbar = {
        activate: function() {
            var $body = $('body');
            var $overlay = $('.overlay');

            //Open left sidebar panel
            $('.bars').on('click', function() {
                $body.toggleClass('overlay-open');
                if ($body.hasClass('overlay-open')) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
            });

            //Close collapse bar on click event
            $('.nav [data-close="true"]').on('click', function() {
                var isVisible = $('.navbar-toggle').is(':visible');
                var $navbarCollapse = $('.navbar-collapse');

                if (isVisible) {
                    $navbarCollapse.slideUp(function() {
                        $navbarCollapse.removeClass('in').removeAttr('style');
                    });
                }
            });
        }
    }
    //==========================================================================================================================

/* Input - Function ========================================================================================================
 *  You can manage the inputs(also textareas) with name of class 'form-control'
 *  
 */
$.AdminBSB.input = {
        activate: function() {
            //On focus event
            $('.form-control').focus(function() {
                $(this).parent().addClass('focused');
            });

            //On focusout event
            $('.form-control').focusout(function() {
                var $this = $(this);
                if ($this.parents('.form-group').hasClass('form-float')) {
                    if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
                } else {
                    $this.parents('.form-line').removeClass('focused');
                }
            });

            //On label click
            $('body').on('click', '.form-float .form-line .form-label', function() {
                $(this).parent().find('input').focus();
            });
        }
    }
    //==========================================================================================================================

/* Form - Select - Function ================================================================================================
 *  You can manage the 'select' of form elements
 *  
 */
$.AdminBSB.select = {
        activate: function() {
            if ($.fn.selectpicker) { $('select:not(.ms)').selectpicker(); }
        }
    }
    //==========================================================================================================================

/* DropdownMenu - Function =================================================================================================
 *  You can manage the dropdown menu
 *  
 */

$.AdminBSB.dropdownMenu = {
        activate: function() {
            var _this = this;

            $('.dropdown, .dropup, .btn-group').on({
                "show.bs.dropdown": function() {
                    var dropdown = _this.dropdownEffect(this);
                    _this.dropdownEffectStart(dropdown, dropdown.effectIn);
                },
                "shown.bs.dropdown": function() {
                    var dropdown = _this.dropdownEffect(this);
                    if (dropdown.effectIn && dropdown.effectOut) {
                        _this.dropdownEffectEnd(dropdown, function() {});
                    }
                },
                "hide.bs.dropdown": function(e) {
                    var dropdown = _this.dropdownEffect(this);
                    if (dropdown.effectOut) {
                        e.preventDefault();
                        _this.dropdownEffectStart(dropdown, dropdown.effectOut);
                        _this.dropdownEffectEnd(dropdown, function() {
                            dropdown.dropdown.removeClass('open');
                        });
                    }
                }
            });

            //Set Waves
            Waves.attach('.dropdown-menu li a', ['waves-block']);
            Waves.init();
        },
        dropdownEffect: function(target) {
            var effectIn = $.AdminBSB.options.dropdownMenu.effectIn,
                effectOut = $.AdminBSB.options.dropdownMenu.effectOut;
            var dropdown = $(target),
                dropdownMenu = $('.dropdown-menu', target);

            if (dropdown.size() > 0) {
                var udEffectIn = dropdown.data('effect-in');
                var udEffectOut = dropdown.data('effect-out');
                if (udEffectIn !== undefined) { effectIn = udEffectIn; }
                if (udEffectOut !== undefined) { effectOut = udEffectOut; }
            }

            return {
                target: target,
                dropdown: dropdown,
                dropdownMenu: dropdownMenu,
                effectIn: effectIn,
                effectOut: effectOut
            };
        },
        dropdownEffectStart: function(data, effectToStart) {
            if (effectToStart) {
                data.dropdown.addClass('dropdown-animating');
                data.dropdownMenu.addClass('animated dropdown-animated');
                data.dropdownMenu.addClass(effectToStart);
            }
        },
        dropdownEffectEnd: function(data, callback) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            data.dropdown.one(animationEnd, function() {
                data.dropdown.removeClass('dropdown-animating');
                data.dropdownMenu.removeClass('animated dropdown-animated');
                data.dropdownMenu.removeClass(data.effectIn);
                data.dropdownMenu.removeClass(data.effectOut);

                if (typeof callback == 'function') {
                    callback();
                }
            });
        }
    }
    //==========================================================================================================================

/* Browser - Function ======================================================================================================
 *  You can manage browser
 *  
 */
var edge = 'Microsoft Edge';
var ie10 = 'Internet Explorer 10';
var ie11 = 'Internet Explorer 11';
var opera = 'Opera';
var firefox = 'Mozilla Firefox';
var chrome = 'Google Chrome';
var safari = 'Safari';

$.AdminBSB.browser = {
        activate: function() {
            var _this = this;
            var className = _this.getClassName();

            if (className !== '') $('html').addClass(_this.getClassName());
        },
        getBrowser: function() {
            var userAgent = navigator.userAgent.toLowerCase();

            if (/edge/i.test(userAgent)) {
                return edge;
            } else if (/rv:11/i.test(userAgent)) {
                return ie11;
            } else if (/msie 10/i.test(userAgent)) {
                return ie10;
            } else if (/opr/i.test(userAgent)) {
                return opera;
            } else if (/chrome/i.test(userAgent)) {
                return chrome;
            } else if (/firefox/i.test(userAgent)) {
                return firefox;
            } else if (!!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)) {
                return safari;
            }

            return undefined;
        },
        getClassName: function() {
            var browser = this.getBrowser();

            if (browser === edge) {
                return 'edge';
            } else if (browser === ie11) {
                return 'ie11';
            } else if (browser === ie10) {
                return 'ie10';
            } else if (browser === opera) {
                return 'opera';
            } else if (browser === chrome) {
                return 'chrome';
            } else if (browser === firefox) {
                return 'firefox';
            } else if (browser === safari) {
                return 'safari';
            } else {
                return '';
            }
        }
    }
    //==========================================================================================================================

$(function() {
    $.AdminBSB.browser.activate();
    $.AdminBSB.leftSideBar.activate();
    $.AdminBSB.rightSideBar.activate();
    $.AdminBSB.navbar.activate();
    $.AdminBSB.dropdownMenu.activate();
    $.AdminBSB.input.activate();
    $.AdminBSB.select.activate();
    $.AdminBSB.search.activate();

    setTimeout(function() { $('.page-loader-wrapper').fadeOut(); }, 50);
});

$(function() {
    //Widgets count
    $('.count-to').countTo();

    //Sales count to
    $('.sales-count-to').countTo({
        formatter: function(value, options) {
            return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
        }
    });

    if ($("#real_time_chart").length)
        initRealTimeChart();
    if ($(".donut_chart").length || $("#donut_chart").length)
        initDonutChart();
    if ($(".sparkline").length)
        initSparkline();
});

var realtime = 'on';

// graph real time function

function initRealTimeChart() {
    //Real time ==========================================================================================
    var plot = $.plot('#real_time_chart', [getRandomData()], {
        series: {
            shadowSize: 0,
            color: 'rgb(0, 188, 212)'
        },
        grid: {
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        },
        lines: {
            fill: true
        },
        yaxis: {
            min: 0,
            max: 100
        },
        xaxis: {
            min: 0,
            max: 100
        }
    });

    function updateRealTime() {
        plot.setData([getRandomData()]);
        plot.draw();

        var timeout;
        if (realtime === 'on') {
            timeout = setTimeout(updateRealTime, 320);
        } else {
            clearTimeout(timeout);
        }
    }

    updateRealTime();

    $('#realtime').on('change', function() {
        realtime = this.checked ? 'on' : 'off';
        updateRealTime();
    });
    //====================================================================================================
}

// graph sparkline function


function initSparkline() {
    $(".sparkline").each(function() {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });
}
// donut chart function

function initDonutChart() {
    Morris.Donut({
        element: 'donut_chart',
        data: [{
                label: 'Chrome',
                value: 37
            }, {
                label: 'Firefox',
                value: 30
            }, {
                label: 'Safari',
                value: 18
            }, {
                label: 'Opera',
                value: 12
            },
            {
                label: 'Other',
                value: 3
            }
        ],
        colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)'],
        formatter: function(y) {
            return y + '%'
        }
    });
}

var data = [],
    totalPoints = 110;

function getRandomData() {
    if (data.length > 0) data = data.slice(1);

    while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y = prev + Math.random() * 10 - 5;
        if (y < 0) { y = 0; } else if (y > 100) { y = 100; }

        data.push(y);
    }

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]]);
    }

    return res;
}

$(function() {
    skinChanger();
    activateNotificationAndTasksScroll();

    setSkinListHeightAndScroll();
    setSettingListHeightAndScroll();
    $(window).resize(function() {
        setSkinListHeightAndScroll();
        setSettingListHeightAndScroll();
    });
});

//Skin changer
function skinChanger() {
    $('.right-sidebar .demo-choose-skin li').on('click', function() {
        var $body = $('body');
        var $this = $(this);

        var existTheme = $('.right-sidebar .demo-choose-skin li.active').data('theme');
        $('.right-sidebar .demo-choose-skin li').removeClass('active');
        $body.removeClass('theme-' + existTheme);
        $this.addClass('active');

        $body.addClass('theme-' + $this.data('theme'));
    });
}

//Skin tab content set height and show scroll
function setSkinListHeightAndScroll() {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.demo-choose-skin');

    $el.slimScroll({ destroy: true }).height('auto');
    $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Setting tab content set height and show scroll
function setSettingListHeightAndScroll() {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.right-sidebar .demo-settings');

    $el.slimScroll({ destroy: true }).height('auto');
    $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Activate notification and task dropdown on top right menu
function activateNotificationAndTasksScroll() {
    $('.navbar-right .dropdown-menu .body .menu').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Google Analiytics ======================================================================================
addLoadEvent(loadTracking);
var trackingId = 'UA-30038099-6';

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function() {
            oldonload();
            func();
        }
    }
}

function loadTracking() {
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', trackingId, 'auto');
    ga('send', 'pageview');
}
//========================================================================================================
$(function() {
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover();
})

$(function() {
    //Textare auto growth
    if ($("textarea.auto-growth").length)
        autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    if ($(".datetimepicker").length) {
        $('.datetimepicker').bootstrapMaterialDatePicker({
            format: 'dddd DD MMMM YYYY - HH:mm',
            clearButton: true,
            weekStart: 1
        });
    }

    if ($(".datepicker").length) {
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'dddd DD MMMM YYYY',
            clearButton: true,
            weekStart: 1,
            time: false
        });
    }

    if ($(".timepicker").length) {
        $('.timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            date: false
        });
    }
});

$(function() {

    if ($('.colorpicker').length)
        $('.colorpicker').colorpicker();

    //Dropzone
    if ($('file').length) {
        Dropzone.options.frmFileUpload = {
            paramName: "file",
            maxFilesize: 2
        };
    }

    //Masked Input ============================================================================================================================
    var $demoMaskedInput = $('.demo-masked-input');

    //Date
    $demoMaskedInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });

    //Time
    $demoMaskedInput.find('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    $demoMaskedInput.find('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });

    //Date Time
    $demoMaskedInput.find('.datetime').inputmask('d/m/y h:s', { placeholder: '__/__/____ __:__', alias: "datetime", hourFormat: '24' });

    //Mobile Phone Number
    $demoMaskedInput.find('.mobile-phone-number').inputmask('+55 (99) 99999-9999', { placeholder: '+__ (__) ____-___' });
    //Phone Number
    $demoMaskedInput.find('.phone-number').inputmask('+55 (99) 9999-9999', { placeholder: '+__ (__) ____-___' });

    //Dollar Money
    $demoMaskedInput.find('.money-dollar').inputmask('99,99 $', { placeholder: '__,__ $' });
    //Euro Money
    $demoMaskedInput.find('.money-euro').inputmask('99,99 €', { placeholder: '__,__ €' });

    //IP Address
    $demoMaskedInput.find('.ip').inputmask('999.999.999.999', { placeholder: '___.___.___.___' });

    //Credit Card
    $demoMaskedInput.find('.credit-card').inputmask('9999 9999 9999 9999', { placeholder: '____ ____ ____ ____' });

    //CPF MASK
    $demoMaskedInput.find('.cpf-mask').inputmask('999.999.999-99', { placeholder: '___ ___ ___ __' });

    //RG MASK
    $demoMaskedInput.find('.rg-mask').inputmask('99.999.999-9', { placeholder: '__ ___ ___ __' });

    // CNPJ BRAZIL MASK
    $demoMaskedInput.find('.cnpj').inputmask('99.999.999/9999-99', { placeholder: '__ ___ ___ ___ __' });

    //ZIPCODE BRAZIL 
    $demoMaskedInput.find('.zipcode-mask-br').inputmask('99999-999', { placeholder: '_____ __' });

    //Email
    $demoMaskedInput.find('.email').inputmask({ alias: "email" });

    //Serial Key
    $demoMaskedInput.find('.key').inputmask('****-****-****-****', { placeholder: '____-____-____-____' });
    //===========================================================================================================================================

    //Multi-select
    $('#optgroup').multiSelect({ selectableOptgroup: true });

    //noUISlider
    if ($("#nouislider_basic_example").length) {
        var sliderBasic = document.getElementById('nouislider_basic_example');
        noUiSlider.create(sliderBasic, {
            start: [30],
            connect: 'lower',
            step: 1,
            range: {
                'min': [0],
                'max': [100]
            }
        });
        getNoUISliderValue(sliderBasic, true);

        //Range Example
        if ($("#nouislider_range_example").length) {

            var rangeSlider = document.getElementById('nouislider_range_example');
            noUiSlider.create(rangeSlider, {
                start: [32500, 62500],
                connect: true,
                range: {
                    'min': 25000,
                    'max': 100000
                }
            });
            getNoUISliderValue(rangeSlider, false);
        }
    }

});

//Get noUISlider Value and write on
function getNoUISliderValue(slider, percentage) {
    slider.noUiSlider.on('update', function() {
        var val = slider.noUiSlider.get();
        if (percentage) {
            val = parseInt(val);
            val += '%';
        }
        $(slider).parent().find('span.js-nouislider-value').text(val);
    });
}

$(function() {
    $('.colorpicker').colorpicker();


    //Masked Input ============================================================================================================================
    var $demoMaskedInput = $('.demo-masked-input');

    //Date
    $demoMaskedInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });

    //Time
    $demoMaskedInput.find('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    $demoMaskedInput.find('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });

    //Date Time
    $demoMaskedInput.find('.datetime').inputmask('d/m/y h:s', { placeholder: '__/__/____ __:__', alias: "datetime", hourFormat: '24' });

    //Mobile Phone Number
    $demoMaskedInput.find('.mobile-phone-number').inputmask('+99 (999) 999-99-99', { placeholder: '+__ (___) ___-__-__' });
    //Phone Number
    $demoMaskedInput.find('.phone-number').inputmask('+99 (999) 999-99-99', { placeholder: '+__ (___) ___-__-__' });

    //Dollar Money
    $demoMaskedInput.find('.money-dollar').inputmask('99,99 $', { placeholder: '__,__ $' });
    //Euro Money
    $demoMaskedInput.find('.money-euro').inputmask('99,99 €', { placeholder: '__,__ €' });

    //IP Address
    $demoMaskedInput.find('.ip').inputmask('999.999.999.999', { placeholder: '___.___.___.___' });

    //Credit Card
    $demoMaskedInput.find('.credit-card').inputmask('9999 9999 9999 9999', { placeholder: '____ ____ ____ ____' });

    //Email
    $demoMaskedInput.find('.email').inputmask({ alias: "email" });

    //Serial Key
    $demoMaskedInput.find('.key').inputmask('****-****-****-****', { placeholder: '____-____-____-____' });
    //===========================================================================================================================================

    //Multi-select
    $('#optgroup').multiSelect({ selectableOptgroup: true });

    //noUISlider
    if ($("#nouislider_basic_example").length) {
        var sliderBasic = document.getElementById('nouislider_basic_example');
        noUiSlider.create(sliderBasic, {
            start: [30],
            connect: 'lower',
            step: 1,
            range: {
                'min': [0],
                'max': [100]
            }
        });
        getNoUISliderValue(sliderBasic, true);
    }

});

//Get noUISlider Value and write on
function getNoUISliderValue(slider, percentage) {
    slider.noUiSlider.on('update', function() {
        var val = slider.noUiSlider.get();
        if (percentage) {
            val = parseInt(val);
            val += '%';
        }
        $(slider).parent().find('span.js-nouislider-value').text(val);
    });
}
var option = '';
var idCourse;
var idStudent;
var evalCount = 0;

if($("#evaluationStudent").length){

    $("#evaluationStudent").change(function(){
        if ( $( this ).val() != '' ){
            
            $.ajax({
                url: "getAlunoData/" + $(this).val(),
                beforeSend:function(){
                    option = '';
                    $( "#tabList" ).html( '' );
                    $( ".evaltions-inner-container" ).html( '' );
                    $( ".evaluations-container" ).addClass( 'hide' );
                },
                error:function(error){},
                success:function( success ){

                    console.log( success.student.id );
                    
                    for ( i in success.courses ){

                        if ( isNumber( success.courses[i] ) )
                            idCourse = success.courses[i];

                        if( success.courses[i] != null 
                            && success.courses[i] != undefined 
                            && !isNumber( success.courses[i] ) 
                            && !Date.parse( success.courses[i] )
                        ){
                            option += '<input name="course" type="radio" value="'+idCourse+'" id="'+idCourse+success.courses[i]+'" class="filled-in chk-col-brown courses-check-box" />';
                            option += '<label for="'+idCourse+success.courses[i]+'">'+success.courses[i]+'</label>'
                        }

                    }
                },
                complete:function(){
                    $( "#tabList" ).append( option );
                }
            });

        }

    });

    $(document).on( 'change', ".courses-check-box",function(event){

        var id = $( this ) . val( );

        if ( $( this ) . is( ":checked" ) ){
            $.ajax({
                url : "disciplineDataByCourseID",
                method:'GET',
                data:{
                    'id' : id
                },
                beforeSend:function(){
                    option =    '';
                    $( ".disciplinesContainer" ).html( '' );
                    $( ".evaltions-inner-container" ).html( '' );
                    $( ".evaluations-container" ).addClass( 'hide' );
                },
                error:function(error){},
                success:function(success){

                    for( i in success.discipline ){
                        option += '<input name="discipline" type="radio" value="'+success.discipline[i].id+'" id="'+success.discipline[i].id+'" class="filled-in chk-col-brown" />';
                        option += '<label class="discipline-checkbox" for="'+success.discipline[i].id+'">'+success.discipline[i].discipline_name+'</label>'
                    }

                },
                complete:function(){
                    $( ".disciplinesContainer" ).append( option );
                    $( ".disciplinesContainer" ).removeClass( 'hide' );
                    $( '.disciplines').removeClass( 'hide' );
                }
            });
        }
        
    });

    $( document ).on( 'click', ".discipline-checkbox",function(){

        if( currentLocation[1] == "add-foul" ){
            
            var inputs = "<div class='col-sm-12 col-xs-12 col-md-12 col-lg-12'>";
                inputs += "<input type='text' id='quantity' name='quantity' class='form-control' placeholder='Digite a quantidade' value='' required/>";
            inputs += "</div>";

        }else{

            var inputs = "<div class='col-sm-12 col-xs-12 col-md-6 col-lg-6'>";
                inputs += "<input type='text' id='first' name='first' class='form-control' placeholder='Digite a primeira nota' value='' required/>";
            inputs += "</div>";
            
            inputs += "<div class='col-sm-12 col-xs-12 col-md-6 col-lg-6'>";
                    inputs += "<input type='text' id='second' name='second' class='form-control' placeholder='Digite a segunda nota' value='' required/>";
            inputs += "</div>";

            inputs += "<div class='col-sm-12 col-xs-12 col-md-6 col-lg-6'>";
                inputs += "<input type='text' id='third' name='third' class='form-control' placeholder='Digite a terceira nota' value='' required/>";
            inputs += "</div>";

            
            inputs += "<div class='col-sm-12 col-xs-12 col-md-6 col-lg-6'>";
                inputs += "<input type='button' id='add' name='add' class='btn btn-lg btn-danger btn-add-evaluation' value='+'/>";
            inputs += "</div>";
        }
        
        $( ".evaluations-container" ).removeClass( 'hide' );
        $( ".evaltions-inner-container" ).html( inputs );
            
    });

    $( document ) . on ( 'click', '.btn-add-evaluation', function() {
        
        var inputs = '<div class="others-container"><div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
            inputs += "<input type='text' id='' class='form-control' name='others["+evalCount+"][name]' placeholder='Titulo' value=''>";
        inputs += "</div>";

        inputs += '<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
            inputs += '<input type="text" id="" class="form-control" name="others['+evalCount+'][value]" placeholder="Nota" value="">';
        inputs += "</div>";
        
        inputs += '<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
            inputs += '<button type="button" id="" class="btn btn-danger delete-evaluation" >';
                inputs += "<i class='material-icons'>delete</i>";
            inputs += '</button>'
        inputs += "</div></div>";

        inputs += "<hr>";

        evalCount++;
        
        $( ".others-evaluations" ).append( inputs );
    });

    $( document ) . on ( 'click', '.delete-evaluation', function(){
        $ ( this ) . parent() . parent() . remove();
    }); 
}

if( $( "#EditEvaluationStudent").length ){

    $( document ).on( 'click', ".discipline-checkbox",function(){

        var inputs = '';

        if( $( this ) . is( ":checked" ) ){
            if( currentLocation[1] == "edit-foul" ){

                $.ajax({
                    url: '/getFoulsById/' + $("#id").val(),
                    method: 'GET',
                    beforeSend:function(){},
                    error:function( error ){},
                    success:function( success ){
                        for( i in success){                            
                            inputs += "<div class='col-sm-12 col-xs-12 col-md-12 col-lg-12'>";
                                inputs += "<input type='text' id='quantity' name='quantity' class='form-control' placeholder='Digite a primeira nota' value='" + success[ i ].quantity + "' required/>";
                            inputs += "</div>";                            
                        }
                    },
                    complete:function(){
                        $( ".evaluations-container" ).removeClass( 'hide' );
                        $( ".evaltions-inner-container" ).html( inputs );
                        inputs = '';
                    }
                });

            }else{
                $.ajax({
                    url     :   '/getEvaluationsByDiscipline/' + $( this ) . val(),
                    method  :   'GET',
                    beforeSend:function(){
                        inputs = '';
                        $( ".evaltions-inner-container" ).html( '' );
                    },
                    error:function(error){},
                    success:function(success){
                        for( i in success){

                            inputs += "<div class='col-sm-12 col-xs-12 col-md-6 col-lg-6'>";
                                inputs += "<input type='text' id='first' name='first' class='form-control' placeholder='Digite a primeira nota' value='" + success[ i ].first + "' required/>";
                            inputs += "</div>";
                            
                            inputs += "<div class='col-sm-12 col-xs-12 col-md-6 col-lg-6'>";
                                inputs += "<input type='text' id='second' name='second' class='form-control' placeholder='Digite a segunda nota' value='" + success[ i ].second + "' required/>";
                            inputs += "</div>";
                            
                            inputs += "<div class='col-sm-12 col-xs-12 col-md-6 col-lg-6'>";
                                inputs += "<input type='text' id='third' name='third' class='form-control' placeholder='Digite a terceira nota' value='" + success[ i ].third + "' required/>";
                            inputs += "</div>";                        
                            
                        }
                        inputs += "<div class='col-sm-12 col-xs-12 col-md-6 col-lg-6'>";
                            inputs += "<input type='button' id='add' name='add' class='btn btn-lg btn-danger btn-add-evaluation' value='+'/>";
                        inputs += "</div>";
                    },
                    complete:function(){
                        $( ".evaluations-container" ).removeClass( 'hide' );
                        $( ".evaltions-inner-container" ).html( inputs );
                        inputs = '';
                    }
                });
    
                $.ajax({
                    url     :   '/getOthersEvaluationsByDiscipline/' + $( this ) . val(),
                    method  :   'GET',
                    beforeSend:function(){
                        $( ".others-evaluations" ).html( '' );
                        inputs = '';
                    },
                    error:function(error){},
                    success:function(success){
                        console.log( success );
                        for( i in success){

                            if( success != null){

                                for ( i in success ){
                                    inputs = '<div class="others-container"><div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
                                        inputs += "<input type='text' id='' class='form-control' name='others["+evalCount+"][name]' placeholder='Titulo' value='" + success[ i ].name +  "'>";
                                    inputs += "</div>";
                            
                                    inputs += '<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
                                        inputs += '<input type="text" id="" class="form-control" name="others['+evalCount+'][value]" placeholder="Nota" value="' + success[ i ].value + '">';
                                    inputs += "</div>";
                                    
                                    inputs += '<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
                                        inputs += '<button type="button" id="" class="btn btn-danger delete-evaluation" >';
                                            inputs += "<i class='material-icons'>delete</i>";
                                        inputs += '</button>'
                                    inputs += "</div></div>";
                            
                                    inputs += "<hr>";
                                    
                                    evalCount++;
                                }
                                
                            }
                            
                        }                    
                    },
                    complete:function(){                    
                        $( ".others-evaluations" ).html( inputs );
                        inputs = '';
                    }
                });
            }
                                   
        }
    });
    
    $( document ) . on ( 'click', '.btn-add-evaluation', function() {

        
        var inputs = '<div class="others-container"><div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
            inputs += "<input type='text' id='' class='form-control' name='others["+evalCount+"][name]' placeholder='Titulo' value=''>";
        inputs += "</div>";

        inputs += '<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
            inputs += '<input type="text" id="" class="form-control" name="others['+evalCount+'][value]" placeholder="Nota" value="">';
        inputs += "</div>";
        
        inputs += '<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">';
            inputs += '<button type="button" id="" class="btn btn-danger delete-evaluation" >';
                inputs += "<i class='material-icons'>delete</i>";
            inputs += '</button>'
        inputs += "</div></div>";

        inputs += "<hr>";

        evalCount++;
        
        $( ".others-evaluations" ).append( inputs );
    });
}