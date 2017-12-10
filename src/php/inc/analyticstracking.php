<?php

//this is a test whether only including this tracking code works, because the further down code seems to not work
?>
<script>
	//Google Analytics MM
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function () {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'https://google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-90192248-2', 'auto');
	ga('send', 'pageview');

	//Google Analytics Optout
	(function () {
		var gaProperty = 'UA-90192248-2';
		var disableStr = 'ga-disable-' + gaProperty;
		if (document.cookie.indexOf(disableStr + '=true') > -1) {
			window[disableStr] = true;
		}
		function gaOptout() {
			document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
			window[disableStr] = true;
		}
	})();

</script>