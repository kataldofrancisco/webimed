<?php
/**
 * CakeMap -- a google maps integrated application built on CakePHP framework.
 *
 * @author cbriones@lemontech.cl
 * @version 0.1
 * @license OPPL
 *
 * Modified by Mahmoud Lababidi <lababidi@bearsontherun.com>
 * Date  Enero 06, 2011
 * Rewritten by lemontech <info@lemontech.cl>
 * Date Enero, 2011
 */
class GoogleMapHelper extends appHelper {
	var $url = "https://maps.google.com/maps/api/js?sensor=false";
	var $helpers = array('Html');

	function map($default, $style_class = null) {
		$out = "
		<div id=\"map\" class=\"{$style_class}\"></div>
		<script type=\"text/javascript\">
			//<![CDATA[
			var latlngDefault = new google.maps.LatLng({$default['latitud']}, {$default['longitud']});
			var optionsDefault = {
				zoom: {$default['zoom']},
				center: latlngDefault,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};

			var map = new google.maps.Map(document.getElementById(\"map\"), optionsDefault);
			var infowindow = new google.maps.InfoWindow();

			google.maps.event.addListener(map, 'dragend', function() {
				cargarLugares(obtenerAreaMapa());
			});

			google.maps.event.addListener(map, 'bounds_changed', function() {
				generarDivInfoValorizacion();
			});

			google.maps.event.addListener(map, 'zoom_changed', function() {
				cargarLugares(obtenerAreaMapa());
			});

			google.maps.event.addListener(infowindow, 'closeclick', function() {
				desplegar_info_valorizacion = true;
				generarDivInfoValorizacion();
			});

			MyOverlay.prototype = new google.maps.OverlayView();
			MyOverlay.prototype.onAdd = function() {}
			MyOverlay.prototype.onRemove = function() {}
			MyOverlay.prototype.draw = function() {}

			//]]>
		</script>
		";

		return $out;
	}

	function addMarkers($markers) {
		$out = "
		<script type=\"text/javascript\">
			//<![CDATA[
			var locations = " . json_encode($markers) . "
			setMarkers(map, locations);
			generarDivInfoValorizacion();
			//]]>
		</script>
		";

		return $out;
	}

	function miniMap($default, $style_class = null) {
		$out = "
		<div id=\"map\" class=\"{$style_class}\"></div>
		<script type=\"text/javascript\">
			//<![CDATA[
			var latlngDefault = new google.maps.LatLng({$default['latitud']}, {$default['longitud']});
			var optionsDefault = {
				zoom: {$default['zoom']},
				center: latlngDefault,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};

			var map = new google.maps.Map(document.getElementById(\"map\"), optionsDefault);

			//]]>
		</script>
		";

		return $out;
	}
}
?>
