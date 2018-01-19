
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

import VueInternalization from 'vue-i18n';
import Locales from './vue-i18n-locales.generated.js';

Vue.use(VueRouter);
Vue.use(VueInternalization);
Vue.config.lang = locale;
const i18n = new VueInternalization({ locale, messages: Locales });

/*Object.keys(Locales).forEach(function (lang) {
  Vue.locale(lang, Locales[lang])
});*/

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('DD.MM.YYYY')
  }
});

Vue.component('register', require('./components/Register.vue'));
Vue.component('slides', require('./components/Slides.vue'));

const routes = [
	{ path: '/', component: require('./components/Dashboard.vue') },
    { path: '/profile', component: require('./components/Profile.vue') },
    { path: '/settings', component: require('./components/Settings.vue') },
    { path: '/alerts', component: require('./components/Alerts.vue') },
    { path: '/messages', component: require('./components/Messages.vue') },
    { path: '/leasing', component: require('./components/Leasing.vue') },
    { path: '/services', component: require('./components/Services.vue') },
];

let router = new VueRouter({
    //mode: 'history',
    history: true,
    //hashbang: false,
    linkActiveClass: 'active',
	routes // short for routes: routes
});

const app = new Vue({
    el: '#app',
    i18n,
    router,
    data() {
        return {
            user: null
        }
    },
    watch: {
        $route (to, from) {
        }
    },
    mounted() {
        axios.get(
            '/api/user'
        ).then(response => {
            this.user = response.data;
            Events.$emit('data-user-loaded', this.user)
        }, response => {
            
        })
    }
});


import Events  from './event.js';

import moment from 'moment';
import Swiper from 'swiper';
import 'ekko-lightbox';
import SmoothScroll from 'smooth-scroll';

var owlCarousel = require('owl.carousel2');

require('./calc_leasing');

function initMap() {
	var uluru = {lat: 47.0489699, lng: 28.869372};
	var map = new google.maps.Map(document.getElementById('google-map'), {
	  zoom: 15,
	  center: uluru
	});
	var marker = new google.maps.Marker({
	  position: uluru,
	  map: map
	});
}

$(function() {

	$('[data-toggle="tooltip"]').tooltip();

	initMap();

	var swiper = new Swiper('.swiper-container', {
        pagination: {
        	el: '.swiper-pagination',
        	clickable: true
        },
        autoplay: {
        	enabled: true,
        	delay: 5000,
        	disableOnInteraction: false
        },
        effect: 'fade'
    });

    $('.apartments .apartment-list, .slide-list').owlCarousel({
        items: 4,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
            },
            768: {
                items: 3,
            },
            979: {
                items: 4,
            }
        },
        margin: 20,
        nav: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left fa-2x" aria-hidden="true"></i>', '<i class="fa fa-angle-right fa-2x" aria-hidden="true"></i>']
    });

    var bt = $('#back-top');
    $(window).scroll(function(){
    	if ($(this).scrollTop() > 100) {
    		bt.fadeIn()
    	} else { bt.fadeOut() }
    });
    var $scrollEl = $('html,body');
    bt.find('a').click(function(){ $scrollEl.animate({scrollTop:0}, 400); return false });


    /*//Sticky
	var stickyToggle = function(sticky, stickyWrapper, scrollElement) {
		var stickyHeight = sticky.outerHeight();
		var stickyTop = stickyWrapper.offset().top;
		if (scrollElement.scrollTop() >= stickyTop) {
		  stickyWrapper.height(stickyHeight);
		  sticky.addClass('is-sticky');
		} else {
		  sticky.removeClass('is-sticky');
		  stickyWrapper.height('auto');
		}
	};

	// Find all data-toggle="sticky-onscroll" elements
	$('[data-toggle="sticky-onscroll"]').each(function() {
		var sticky = $(this);
		var stickyWrapper = $('<div>').addClass('sticky-wrapper'); // insert hidden element to maintain actual top offset on page
		sticky.before(stickyWrapper);
		sticky.addClass('sticky');

		// Scroll & resize events
		$(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function() {
			stickyToggle(sticky, stickyWrapper, $(this));
		});

		// On page load
		stickyToggle(sticky, stickyWrapper, $(window));
	});*/

	$('.navbar-toggler').on('click', function(e) {
		e.preventDefault();
		var target = $(this).data('target');
		if ($(target).hasClass('reveal')) {
			$(target).removeClass('reveal');
			//$(this).removeClass('bg-white');
			$(this).find('i').removeClass('flaticon-multiply').addClass('flaticon-menu-2');
		} else {
			$(target).addClass('reveal');
			//$(this).addClass('bg-white');
			$(this).find('i').removeClass('flaticon-menu-2').addClass('flaticon-multiply');
		}
	});

	$('[data-toggle="tree-toggle"]').click(function () {
		$(this).parent().children('ul.nav').toggle(200);
	});

	$('.page-content #content .content img').each(function() {
		var $that = $(this);
		$that.attr('data-toggle', 'lightbox')
			.attr('data-remote', $that.attr('src'))
			.attr('data-gallery', 'lightbox')
			.css('cursor', 'pointer');
	});

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({alwaysShowClose: true});
    });

    $('[data-toggle="swiper-title-more"]').on('click', function(event) {
    	event.preventDefault();
    	var $parent_swiper = $(this).closest('.swiper-title');
    	var $parent = $(this).closest('.swiper-descr');
      	$(this).closest('span').hide();
      	$('.slides', $parent).show();

 		/*$parent_swiper.addClass('flipInY animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
      		$(this).removeClass('flipInY animated');
    	});*/

    });

    $('[data-toggle="calc-apartment"]').on('click', function(event) {
    	event.preventDefault();
    	let price = $(this).data('price');
    	$('#calculator_content form').hide();
    	$('#calculator_content').removeClass('d-none');
    	$('#calculator_content form input#app_price').val(price);
    	$('#calculator_content form button[data-toggle="calc_leasing"]').click();
    });

    if (location.hash) {
    	var target = location.hash.split('#');
    	if (target[1]) {
	    	target = target[1].replace('/', '');
	    	if (target) {
	    		var scroll = new SmoothScroll();
	    		var anchor = document.querySelector('#content-'+target);
	    		var options = { speed: 1000, easing: 'easeOutCubic', header: 'header.fixed-top' };
				setTimeout(() => {
					scroll.animateScroll( anchor, null, options );
				}, 1000);
			}
		}
	}

});
