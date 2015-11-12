;(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);

	$doc.ready(function() {

		// Shop per page switcher
		$('#products_per_page').on('change', 'select', function() {
			Cookies.set('products_per_page', $(this).val());

			location.reload();
		});

		//Advanced Search
		$('.link-advanced').on('click', function(e) {
			e.preventDefault();

			$(this).next('.advanced-search-dropdown').stop().fadeToggle(200);
		});

		// Add class to Widget Layered nav, when using list, instead of dropdown
		$('.widget_layered_nav ul').closest('.widget_layered_nav').addClass('widget_layered_nav_dropdown');

		/*
		 | This function updates the next select only and makes
		 | sure all the selects down the row are reset when
		 | resetting a higher level select.
		 */
		function update_select( term_id, $select, $form ) {
			$select
				.parent()
					.nextAll('.search-controls')
						.find('select')
						.add($select)
							.prop('disabled', true)
							.find('option:gt(0)')
								.remove();

			if ( ! term_id ) {
				return;
			}

			$form.find('.preloader').stop().fadeIn(200);

			var ajax_data = {
				action: 'get_product_categories',
				parent: term_id
			};

			$.ajax({
				method : 'GET',
				url    : ajax_url,
				data   : ajax_data,
				success: function(data) {
					var parsedData = $.parseJSON( data );

					for ( var category_id in parsedData ) {
						var $option = $('<option data-url="' + parsedData[category_id].url + '" value="' + category_id + '">' + parsedData[category_id].name + '</option>');
						$select.append($option).prop('disabled', false);
					}

					$form.find('.preloader').stop().fadeOut(200);
				}
			});
		}

		/*
		 | Loop all the "search-controls" containers and bind an
		 | event that updates the next select down the row with
		 | the child terms of the current select's selected
		 | term. This way the functionality will work even
		 | if more term levels are added in the future.
		 */

		$('.search-advanced').find('.search-controls').each(function() {
			var $searchControl = $(this);
			var $form = $searchControl.closest('.search-advanced');

			$searchControl.find('> select').on('change', function() {
				var $categorySelect = $(this);

				var selected    = $categorySelect.val();
				var $nextSelect = $categorySelect.parent().next('.search-controls').find('> select');

				if ( $nextSelect.length ) {
					update_select( selected, $nextSelect, $form );					
				}
			});
		});

		// Search form redirecting for the selected category
		$('.search-advanced form').on('submit', function(e) {
			e.preventDefault();

			var $form = $(this);
			var link = $form.find('option[value!=""]:selected:last').data('url');
			if ( typeof link == 'undefined' ) {
				link = $form.attr('action');
			};

			window.location.href = link;
		});

		//Slider
		$('.slider .slides').bxSlider({
			prevText: '',
			nextText: '',
			auto: false
		});

		//Slider logos
		var settings = function() {
			var settings2 = {
				prevText: '',
				nextText: '',
				pager: false,
				minSlides: 1,
				maxSlides: 5,
				moveSlides: 1,
				slideWidth: '142px',
				slideMargin: 38,
				auto: true
			};
			var settings1 = {
				controls: false,
				pager: false,
				minSlides: 1,
				maxSlides: 3,
				moveSlides: 1,
				slideWidth: '90px',
				slideMargin: 10,
				auto: true
			};
			return ($(window).width()<768) ? settings1 : settings2;
		}
		var mySlider;
		function sliderReloader() {			
			mySlider.reloadSlider(settings());
		}

		var $logosSlider = $('.slider-logos .slides');
		if ( $logosSlider.length ) {
			mySlider = $logosSlider.bxSlider(settings());
			$(window).resize(sliderReloader);
		}

		//Btn Mobile Menu
		$('.btn-menu').on('click', function (e) {
			$(this).add($(this).next()).toggleClass('active');
		});

		//Widget Categories Span on Mobile
		$('.widget-categories span').on('click', function (e) {
			$(this).next().toggleClass('active');
		});

		//Product Accordion
		var activeItemClass = 'accordion-expanded';
		var accordionItemSelector = '.accordion-section';
	 
		$(accordionItemSelector).on('click', function() {
	 
			$(this)
				.toggleClass(activeItemClass)
					.siblings()
					.removeClass(activeItemClass);
		});
	});
})(jQuery, window, document);