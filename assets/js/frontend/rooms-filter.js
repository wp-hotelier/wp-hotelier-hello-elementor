jQuery(function ($) {
	"use strict";

	var mediaQuery = window.matchMedia("(max-width: 767px)");

	var filter_label = $(".room-filters--toggle-yes").find(
		".widget-rooms-filter__group-label"
	);

	var defaultState = "open";

	$(window).on("resize", function () {
		if (mediaQuery.matches) {
			if (
				filter_label.closest(
					".room-filters--mobile-toggle-state-closed"
				).length > 0
			) {
				defaultState = "closed";
			}
		} else {
			if (
				filter_label.closest(".room-filters--toggle-state-closed")
					.length > 0
			) {
				defaultState = "closed";
			}
		}
	});

	if (filter_label.closest(".room-filters--toggle-state-closed").length > 0) {
		defaultState = "closed";
	}

	filter_label.on("click", function () {
		var _this = $(this);
		var content = _this.next("ul");
		var icon = _this.find("i");

		content.slideToggle("fast");

		if (_this.hasClass("open")) {
			_this.removeClass("open");

			if (icon.length > 0) {
				icon.attr("class", icon.attr("data-closed-icon"));
			}
		} else {
			_this.addClass("open");

			if (icon.length > 0) {
				icon.attr("class", icon.attr("data-open-icon"));
			}
		}
	});

	if (defaultState === "open") {
		filter_label.addClass("open");
	}
});
