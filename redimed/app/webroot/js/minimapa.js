function initialize() {
    var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
    var myOptions = {
      zoom: 16,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(minimapa, myOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"Nuevo Lugar"
    });
  }