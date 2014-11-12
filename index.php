<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <title>U.S.A. Airport Distance Calculator</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      
      <!-- Le styles -->
      <link href="/Airport-Distance/ui/css/bootstrap.css" rel="stylesheet">
      <link href="/Airport-Distance/ui/css/bootstrap-responsive.css" rel="stylesheet">
      <style>
      
      /* GLOBAL STYLES
      -------------------------------------------------- */
      /* Padding below the footer and lighter body text */
      
      body {
		  padding-bottom: 40px;
		  color: #5a5a5a;
      }
      
      /* CUSTOMIZE THE CAROUSEL
      -------------------------------------------------- */
      
      /* Carousel base class */
      .carousel {
		  margin-bottom: 20px;
      }
      
      .carousel .container {
		  position: relative;
		  z-index: 9;
      }
      
      .carousel-control {
		  height: 80px;
		  margin-top: 0;
		  font-size: 120px;
		  text-shadow: 0 1px 1px rgba(0,0,0,.4);
		  background-color: transparent;
		  border: 0;
		  z-index: 10;
      }
      
      .carousel .item {
		  height: 400px;
      }
      .carousel img {
		  position: absolute;
		  top: 0;
		  left: 0;
		  min-width: 100%;
		  height: 400px;
      }
      
      .carousel-caption {
		  background-color: transparent;
		  position: static;
		  max-width: 550px;
		  padding: 0 20px;
		  margin-top: 200px;
      }
      .carousel-caption h1,
      .carousel-caption .lead {
		  margin: 0;
		  line-height: 1.25;
		  color: #fff;
		  text-shadow: 0 1px 1px rgba(0,0,0,.4);
      }
      .carousel-caption .btn {
		  margin-top: 10px;
      }
      
      /* FORM CONTENT
      -------------------------------------------------- */
      
      /* Center align the text within the three columns below the carousel */
      .marketing .span4 {
		  text-align: center;
      }
      .marketing h2 {
		  font-weight: normal;
      }
      .marketing .span4 p {
		  margin-left: 10px;
		  margin-right: 10px;
      }
      
      /* RESPONSIVE CSS
      -------------------------------------------------- */
      
      @media (max-width: 979px) {
     
		  .carousel .item {
			  height: 500px;
		  }
		  .carousel img {
			  width: auto;
			  height: 500px;
		  }
      }
      
      
      @media (max-width: 767px) {
      
		  .carousel {
			  margin-left: -20px;
			  margin-right: -20px;
		  }
		  .carousel .container {
		  
		  }
		  .carousel .item {
			  height: 300px;
		  }
		  .carousel img {
			  height: 300px;
		  }
		  .carousel-caption {
			  width: 65%;
			  padding: 0 70px;
			  margin-top: 100px;
		  }
		  .carousel-caption h1 {
			  font-size: 30px;
		  }
		  .carousel-caption .lead,
		  .carousel-caption .btn {
			  font-size: 18px;
		  }
		  
		  .marketing .span4 + .span4 {
			  margin-top: 40px;
		  }
      
      }
      </style>
      
      <script src="http://code.jquery.com/jquery-1.10.1.min.js" type="text/javascript"></script>
      <script type="text/javascript">
		  /* load data immediately
		  * once data is loaded, hide "loading..." and make form visible.
		  */
		  var us_airs = new Array();
		  var airlocs = new Object();
		  $.getJSON('http://dg123.info/airport-distance/ui/data/airports.json',function(json)
		  {
			  var data = json.data;
			  for(i in data){
				  if(data[i][11] == "United States"){
					  us_airs.push(data[i][12] + ' - ' + data[i][9] + ' - ' + data[i][10]);
					  airlocs[data[i][12]] = new google.maps.LatLng(parseFloat(data[i][14]),parseFloat(data[i][15]));
				  }
			  }
			  $("#loading").hide();
			  $("#workspace").show();
		  });
		  /* 
		  * Data ex: [ 3699, "BE1AD45A-F851-4F75-A6FF-E96F86E812EA", 3699, 1370028886,
		  *   	 	     "717674", 1370028886, "717674", "{\n}", "3797", "John F Kennedy Intl",
		  *				 "New York", "United States", "JFK", "KJFK", "40.639751", "-73.778925",
		  *				 "13", "-5", "A" ]
		  */
      </script>
  
  </head>

  <body>
  
    <!-- Map
    ================================================== -->
    <div class="carousel slide">
        <div class="carousel-inner">
            <div id="airmap" class="item active" style="background-color:#CCC;"></div>
        </div>
    </div><!-- /.carousel -->
        
    <div class="container marketing" style="text-align:center">
        <h1>U.S.A. Airport Distance Calculator</h1>
        <div id="loading" class="row">
            <h4>loading...</h4>
        </div>
        <!-- Three columns of text below the carousel -->
        <div id="workspace" class="row" style="display:none;">
            <div class="span4">
                <h2>From:</h2>
                <p><input id="air_from" type="text" value="" data-provide="typeahead" data-items="10" autocomplete="off"></p>
            </div><!-- /.span4 -->
            <div class="span4">
                <div id="answer">
                </div>
                <a class="btn" id="ok">Go!</a>
                <br /><br />
                set "from" and "to" airports<br />
                <i style="color:#ccc">use city, airport name, or IATA code</i><br /><br />
                click "Go!" to get the distance in nautical miles
            </div><!-- /.span4 -->
            <div class="span4">
                <h2>To:</h2>
                <p><input id="air_goto" type="text" value="" data-provide="typeahead" data-items="10" autocomplete="off"></p>
            </div><!-- /.span4 -->
        </div><!-- /#workspace -->
    
    </div><!-- /.container -->
    
    
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry" type="text/javascript"></script>
    <script src="/Airport-Distance/ui/js/bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="/Airport-Distance/ui/js/gmaps.js"></script>
    <script>
    
	  var lvfrom;
	  var gointo;
	  
	  $(document).ready(function()
	  {
		  $('#air_from').typeahead({source: us_airs});
		  $('#air_goto').typeahead({source: us_airs}); 		
		  
		  $('#air_from, #air_goto').click(function(){
			  $(this).val('');								
		  });
		
		  var gmap = new MapManager();
		  gmap.baseMap('airmap');
		  
		  $("#ok").click(function(){
									
			  gmap.clearRoutes();
			  gmap.clearMarkers();
			  
			  lvfrom = $("#air_from").val().split(" - ");
			  gointo = $("#air_goto").val().split(" - ");
			  
			  if((typeof airlocs[lvfrom[0]] !== 'undefined') && (typeof airlocs[gointo[0]] !== 'undefined')){
				gmap.plotRoute(airlocs[lvfrom[0]],airlocs[gointo[0]]);
				var dist = getDistance(airlocs[lvfrom[0]],airlocs[gointo[0]]);
				$("#answer").html('<h3>The distance is approximately<br /><b><i>' + parseInt(dist) + '</i></b> nautical miles.</h3>');
			  }else{
				alert('Make sure both fields are filled in!');	
			  }
		  });
	  });
    
    </script>
  </body>
</html>