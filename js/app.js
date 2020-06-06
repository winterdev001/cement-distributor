// for page including in html file
function includeHTML() {
    var z, i, elmnt, file, xhttp;
    /*loop through a collection of all HTML elements:*/
    z = document.getElementsByTagName("*");
    for (i = 0; i < z.length; i++) {
        elmnt = z[i];
        /*search for elements with a certain atrribute:*/
        file = elmnt.getAttribute("include-html");
        if (file) {
            /*make an HTTP request using the attribute value as the file name:*/
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    if (this.status == 200) { elmnt.innerHTML = this.responseText; }
                    if (this.status == 404) { elmnt.innerHTML = "Page not found."; }
                    /*remove the attribute, and call this function once more:*/
                    elmnt.removeAttribute("include-html");
                    includeHTML();
                }
            }
            xhttp.open("GET", file, true);
            xhttp.send();
            /*exit the function:*/
            return;
        }
    }
};

includeHTML();

// include end

// navigation
$(window).scroll(function () {
    if ($(window).scrollTop() >= 490) {
        $('.navigation').addClass('fixed-header');
        $('.navigation ').addClass('sec-color');
        $('.navigation .navbar-brand span').removeClass('nav-brand-txt');
        $('.search-form input').removeClass('seacrh-input');
        $('.search-form button').removeClass('search-btn');
        $('.navigation .navbar-brand span').addClass('nav-brand-txt-after');
        $('.search-form input').addClass('search-input-after');
        $('.search-form button').addClass('search-btn-after');

    }
    else {
        $('.navigation').removeClass('fixed-header');
        $('.navigation ').removeClass('sec-color');
        $('.navigation .navbar-brand span').removeClass('nav-brand-txt-after');
        $('.navigation .navbar-brand span').addClass('nav-brand-txt');
        $('.search-form input').addClass('seacrh-input');
        $('.search-form button').addClass('search-btn');
        $('.search-form input').removeClass('search-input-after');
        $('.search-form button').removeClass('search-btn-after');
    }
});
// /. navigation

// best selling 
$(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});
// / .best selling

// active link
$(document).ready(function () {
    var pathname = window.location.pathname;

    // console.log(pathname);
    if (pathname.includes("/products") || pathname.includes("/product_details")) {
        $('.navbar-nav .home').removeClass('active');
        $('.navbar-nav .products').addClass('active');
    } else if (pathname.includes("/about")) {
        $('.navbar-nav .home').removeClass('active');
        $('.navbar-nav .about').addClass('active');
    } else if (pathname.includes("/contact")) {
        $('.navbar-nav .home').removeClass('active');
        $('.navbar-nav .contact').addClass('active');
    } else {
        $('.navbar-nav .home').addClass('active');
    }
});

// product_details
class ImageViewer {
    constructor(selector) {
        this.selector = selector;
        $(this.secondaryImages).click(() => this.setMainImage(event));
        $(this.mainImage).click(() => this.showLightbox(event));
        $(this.lightboxClose).click(() => this.hideLightbox(event));
    }

    get secondaryImageSelector() {
        return '.secondary-image';
    }

    get mainImageSelector() {
        return '.main-image';
    }

    get lightboxImageSelector() {
        return '.lightbox';
    }

    get lightboxClose() {
        return '.lightbox-controls-close';
    }

    get secondaryImages() {
        var secondaryImages = $(this.selector).find(this.secondaryImageSelector).find('img');
        return secondaryImages;
    }

    get mainImage() {
        var mainImage = $(this.selector).find(this.mainImageSelector);
        return mainImage;
    }

    get lightboxImage() {
        var lightboxImage = $(this.lightboxImageSelector);
        return lightboxImage;
    }

    setLightboxImage(event) {
        var src = this.getEventSrc(event);
        this.setSrc(this.lightboxImage, src);
    }

    setMainImage(event) {
        var src = this.getEventSrc(event);
        this.setSrc(this.mainImage, src);
    }

    getSrc(node) {
        var image = $(node).find('img');
    }

    setSrc(node, src) {
        var image = $(node).find('img')[0];
        image.src = src;
    }

    getEventSrc(event) {
        return event.target.src;
    }

    showLightbox(event) {
        this.setLightboxImage(event);
        $(this.lightboxImageSelector).addClass('show');
    }

    hideLightbox() {
        $(this.lightboxImageSelector).removeClass('show');
    }
}
new ImageViewer('.image-viewer');

// pricing
$(document).ready(function () {
    $('.num-in span').click(function () {
        var $input = $(this).parents('.num-block').find('input.in-num');
        if ($(this).hasClass('minus')) {
            var count = parseFloat($input.val()) - 1;
            count = count < 10 ? 10 : count;
            if (count < 2) {
                $(this).addClass('dis');
            }
            else {
                $(this).removeClass('dis');
            }
            $input.val(count);
        }
        else {
            var count = parseFloat($input.val()) + 1
            $input.val(count);
            if (count > 1) {
                $(this).parents('.num-block').find(('.minus')).removeClass('dis');
            }
        }

        $input.change();
        return false;
    });

});
// /pricing

// broad product description
var tabs = document.getElementById('icetab-container').children;
var tabcontents = document.getElementById('icetab-content').children;

var myFunction = function () {
    var tabchange = this.mynum;
    for (var int = 0; int < tabcontents.length; int++) {
        tabcontents[int].className = ' tabcontent';
        tabs[int].className = ' icetab';
    }
    tabcontents[tabchange].classList.add('tab-active');
    this.classList.add('current-tab');
}


for (var index = 0; index < tabs.length; index++) {
    tabs[index].mynum = index;
    tabs[index].addEventListener('click', myFunction, false);
}
// / .broad description
