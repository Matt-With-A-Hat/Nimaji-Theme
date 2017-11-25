/**
 * ==============================================================
 * =Simple JavaScript
 * ==============================================================
 */
function deferVideos() {
    var vidDefer = document.getElementsByTagName('iframe');
    for (var i = 0; i < vidDefer.length; i++) {
        if (vidDefer[i].getAttribute('data-src')) {
            vidDefer[i].setAttribute('src', vidDefer[i].getAttribute('data-src'));
        }
    }
}
window.onload = deferVideos;

/**
 * ==============================================================
 * =jQuery
 * ==============================================================
 */

jQuery(function ($) {
    var navbar = $(".menu-navbar");
    var navPosX = getNavPosX();
    var mainMenu = $('#main-menu');
    if (mainMenu.length) {
        var menuHeight = mainMenu.height();
        var menuTopPos = mainMenu.offset().top;
    }
    var loggedin = $("#wpadminbar").length;
    var menuIcon = $(".hamburger");
    var submenuIcon = $(".open-submenu");
    var menuBackIcon = $(".menu-back");
    var viewportWidth = getViewportWidth();
    var dropdown = $(".dropdown");
    var dropdownContent = $('.dropdown-content');

    /**
     * =Rotate icon
     */
    $(".toggle-rotate").click(function () {
        $(this).children("i").toggleClass("down");
    });

    /**
     * =move fixed navbar down, if admin bar is displayed
     */
    if (loggedin !== 0) {
        $('#small-devices-spacer').addClass('small-devices-spacer');
    }

    /**
     * =Open menu item
     */
    menuIcon.click(function () {
        hamburger = $(this);
        navlayer = $(".nav-layer");
        navbox = $("#navbarNavDropdown");
        hamburger.toggleClass('is-active');
        navbox.toggleClass('is-active');

        if (navbox.hasClass('is-active')) {
            navlayer.fadeIn(500);
        } else {
            navlayer.fadeOut(500);
        }
    });

    /**
     * =Open submenu item
     */
    submenuIcon.click(function (e) {
        e.preventDefault();
        $submenu = $(this).closest('.dropdown').find('.dropdown-content');
        $submenu.toggleClass('is-active');
    });

    /**
     * =Close submenu item
     */
    menuBackIcon.click(function () {
        $(this).closest('dropdown').toggleClass('is-active');
    });

    /**
     * =Get viewport width
     * @returns {*|jQuery}
     */
    function getViewportWidth() {
        return $('body').width();
    }

    /**
     * =Get the X position of the navbar
     * @returns {*}
     */
    function getNavPosX() {
        if (navbar.length) {
            navPosX = navbar.offset().top;
            if (loggedin) {
                navPosX -= 32;
            }
            return navPosX;
        } else {
            return null;
        }
    }

    /**
     * =Fix menu on scroll
     */
    $(window).bind('scroll', function () {
        var headerImageHeight = $('.header--image').height();
        if ($(window).scrollTop() > navPosX - 32) {
            navbar.css('position', 'fixed');
            if (loggedin) {
                navbar.addClass('navbar-spacing-fix');
            }
        } else {
            navbar.css('position', 'relative');
            if (loggedin) {
                navbar.removeClass('navbar-spacing-fix');
            }
        }
    });

    /**
     * =reset viewport var on window rezise
     */
    $(window).resize(function () {
        viewportWidth = getViewportWidth();
        adjustSubmenuHeight();
        adjustSubmenuPosition();
        adjustTitleBox();
    });


    /**
     * =CSS Fix Functions
     */
    function adjustSubmenuHeight() {
        if (viewportWidth < 1024) {
            dropdownContent.css('height', menuHeight);
        } else {
            dropdownContent.css('height', '');
        }
    }

    function adjustSubmenuPosition() {
        if (viewportWidth < 1024) {
            dropdownContent.each(function () {
                $(this).css('top', menuTopPos);
            })
        } else {
            dropdownContent.each(function () {
                $(this).css('top', '');
            })
        }
    }

    function adjustTitleBox() {
        var headerImageHeight = $('.header--image').height();
        $('.header--title-area').css('height', headerImageHeight + 10);
    }

    $(document).ready(function () {
        adjustSubmenuHeight();
        adjustSubmenuPosition();
        adjustTitleBox();
    });
});

