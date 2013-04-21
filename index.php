<!DOCTYPE HTML>
<?php
include('db/connection.php');
	$rova = $_POST['ile'];
	$jina = $_POST['jina'];
	$email = $_POST['email'];
	$email = $_POST['nchi'];
	$com = $_POST['comment'];
	
 $query_searchz = "insert into  comments (rover,  name, email, country, comment, saa, tarehe)
	 values('".$rova."','".$jina."','".$email."','".$email."','".$com."',now(),curdate()')";
	 
	 $query_exec = mysql_query($query_searchz) or die(mysql_error());
?>
  <html>  
  <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7,IE=9" />
    <!--The viewport meta tag is used to improve the presentation and behavior of the samples 
      on iOS devices-->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no"/>
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content="0">
    <title> 
    </title> 

	<!-- Style element goes here -->
    <link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/3.0/js/dojo/dijit/themes/claro/claro.css">    
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <!--link rel="stylesheet" type="text/css" href="css/div3.css"-->
	<link rel="stylesheet" type="text/css" href="css/jah.css">
	
		
	<!-- ArcGIS Javascript Stylesheets -->    
	
	<link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/2.5/js/esri/dijit/css/Popup.css"/>
	<link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/2.0/js/dojo/dojox/grid/resources/Grid.css">
	<link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/2.0/js/dojo/dojox/grid/resources/tundraGrid.css">
	<link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/2.5/js/dojo/dijit/themes/claro/claro.css">
		
    <script type="text/javascript"> 
      var djConfig = {
        parseOnLoad: true,
		baseUrl: './',
					  modulePaths: {
						// if use local copy, make sure the path reference is relative to 'baseUrl', e.g.:
						//'agsjs': '../build/agsjs'
						// use absolute path for online version. Note sometimes googlecode.com can be slow.
						'agsjs': 'http://gmaps-utility-gis.googlecode.com/svn/tags/agsjs/1.07/build/agsjs'
					  }		
      };
    </script> 
		
	
   
	<script type="text/javascript" src="http://serverapi.arcgisonline.com/jsapi/arcgis/?v=2.5"></script>
	
	<!-- Load external scripts ->
	<script type="text/javascript" src="js/csoMap.js"></script>		
	<!--script type="text/javascript" src="js/csoWin.js"></script>
	<script type="text/javascript" src="js/csoSearch.js"></script-->
		<script type="text/javascript" src="js/rover_one.js"></script>
		<script type="text/javascript" src="js/rover_two.js"></script>
	<script type="text/javascript" src="js/rover_three.js"></script>
	<script type="text/javascript" src="js/rover_four.js"></script>

	<!-- Load jQuery and jQuery UI via Google AJAX Libraries API-->
	<link rel="stylesheet" href="js/themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="js/ui/jquery.ui.core.js"></script>
	<script src="js/ui/jquery.ui.widget.js"></script>
	<script src="js/ui/jquery.ui.mouse.js"></script>
	<script src="js/ui/jquery.ui.sortable.js"></script>
	<script src="js/ui/jquery.ui.accordion.js"></script>
	<script src="js/ui/jquery.ui.button.js"></script>
	<script src="js/ui/jquery.ui.draggable.js"></script>
	<script src="js/ui/jquery.ui.position.js"></script>
	<script src="js/ui/jquery.ui.resizable.js"></script>
	<script src="js/ui/jquery.ui.dialog.js"></script>
    <script type="text/javascript"> 
		dojo.require("dijit.dijit"); // optimize: load dijit layer
		dojo.require("dijit.layout.BorderContainer");
		dojo.require("dijit.layout.ContentPane");
		dojo.require("esri.map");
		dojo.require("esri.virtualearth.VETiledLayer");
		dojo.require("dijit.TitlePane");
		dojo.require("esri.dijit.BasemapGallery");
		dojo.require("esri.arcgis.utils");
		dojo.require("agsjs.layers.GoogleMapsLayer");	
		dojo.require("esri.layers.FeatureLayer");
		dojo.require("esri.dijit.OverviewMap");
		
		//Required for WMS support
		dojo.require("dijit.layout.AccordionContainer");
		dojo.require("esri.geometry");
		dojo.require("esri.layers.wms");

    
       var map;

      function init() {
	  var popup = new esri.dijit.Popup(null, dojo.create("div"));
	  
        var initExtent = new esri.geometry.Extent({
          "xmin": 4073959.0882260322,
          "ymin": -152904.42845964813,
          "xmax": 4125706.956375027,
          "ymax":-130508.37917212165,
          "spatialReference": {
            "wkid": 102100
          }
        });
       map = new esri.Map("map", {
		extent: initExtent,
		infoWindow: popup
	});
	
		//Hide the popup if its outside the map's extent
	dojo.connect(map,"onMouseDrag",function(evt){
		if(map.infoWindow.isShowing){
			var loc = map.infoWindow.getSelectedFeature().geometry;
			if(!map.extent.contains(loc)){
				map.infoWindow.hide();
			}
		}
	});
        //Add the topographic layer to the map. View the ArcGIS Online site for services http://arcgisonline/home/search.html?t=content&f=typekeywords:service    
        var basemapUrl = "http://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer";
        var basemap = new esri.layers.ArcGISTiledMapServiceLayer(basemapUrl);
        map.addLayer(basemap);
        
        dojo.connect(map, "onLoad", function(map) {
          //resize the map when the browser resizes
          dojo.connect(dijit.byId('map'), 'resize', map,map.resize);
          var overviewMap = new esri.dijit.OverviewMap({map: map},dojo.byId("overviewDiv"));
          overviewMap.startup();
        });
		
		
		
var popupTemplate = new esri.dijit.PopupTemplate({
// title: "{title}",

		
		
description:"{description}",
showAttachments:true/*,
mediaInfos:[
{
 "title": " PHOTO",
		  "caption": "CSO Photos",
		  "type": "image",
		  "value":{
		  "sourceURL":"images/dot1.jpg",
		  "linkURL":"./"
}
}
]

*/
});

popupTemplate.setTitle("Sojourner");
//create a feature layer based on the feature collection

getGeodata("db/rover_one.php?","map"); // function that involves looping though DB
//function runs once
featureLayer = new esri.layers.FeatureLayer(featureCollection, {
id: 'flickrLayer',
infoTemplate: popupTemplate
});
map.infoWindow.resize(250,250);
//associate the features with the popup on click
dojo.connect(featureLayer,"onClick",function(evt){
map.infoWindow.setFeatures([evt.graphic]);
map.infoWindow.show(evt.mapPoint);


				

});


//add the feature layer

map.addLayers([featureLayer]);


		
var popupTemplatez = new esri.dijit.PopupTemplate({
// title: "{title}",

		
		
description:"{description}",
showAttachments:true/*,
mediaInfos:[
{
 "title": " PHOTO",
		  "caption": "CSO Photos",
		  "type": "image",
		  "value":{
		  "sourceURL":"images/dot1.jpg",
		  "linkURL":"./"
}
}
]

*/
});

popupTemplatez.setTitle("Spirit");
//create a feature layer based on the feature collection

getGeodataz("db/rover_two.php?","map"); // function that involves looping though DB
//function runs once
featureLayerz = new esri.layers.FeatureLayer(featureCollection, {
id: 'flickrLayer',
infoTemplate: popupTemplatez
});
map.infoWindow.resize(250,250);
//associate the features with the popup on click
dojo.connect(featureLayerz,"onClick",function(evt){
map.infoWindow.setFeatures([evt.graphic]);
map.infoWindow.show(evt.mapPoint);


				

});


//add the feature layer

map.addLayers([featureLayerz]);



		
var popupTemplatey = new esri.dijit.PopupTemplate({
// title: "{title}",

		
		
description:"{description}",
showAttachments:true/*,
mediaInfos:[
{
 "title": " PHOTO",
		  "caption": "CSO Photos",
		  "type": "image",
		  "value":{
		  "sourceURL":"images/dot1.jpg",
		  "linkURL":"./"
}
}
]

*/
});

popupTemplatey.setTitle("Opportunity");
//create a feature layer based on the feature collection

getGeodatay("db/rover_three.php?","map"); // function that involves looping though DB
//function runs once
featureLayery = new esri.layers.FeatureLayer(featureCollection, {
id: 'flickrLayer',
infoTemplate: popupTemplatey
});
map.infoWindow.resize(250,250);
//associate the features with the popup on click
dojo.connect(featureLayery,"onClick",function(evt){
map.infoWindow.setFeatures([evt.graphic]);
map.infoWindow.show(evt.mapPoint);


				

});


//add the feature layer

map.addLayers([featureLayery]);




		
var popupTemplatet = new esri.dijit.PopupTemplate({
// title: "{title}",

		
		
description:"{description}",
showAttachments:true/*,
mediaInfos:[
{
 "title": " PHOTO",
		  "caption": "CSO Photos",
		  "type": "image",
		  "value":{
		  "sourceURL":"images/dot1.jpg",
		  "linkURL":"./"
}
}
]

*/
});

popupTemplatet.setTitle("Curiosity");
//create a feature layer based on the feature collection

getGeodatat("db/rover_four.php?","map"); // function that involves looping though DB
//function runs once
featureLayert = new esri.layers.FeatureLayer(featureCollection, {
id: 'flickrLayer',
infoTemplate: popupTemplatey
});
map.infoWindow.resize(250,250);
//associate the features with the popup on click
dojo.connect(featureLayert,"onClick",function(evt){
map.infoWindow.setFeatures([evt.graphic]);
map.infoWindow.show(evt.mapPoint);


				

});


//add the feature layer

map.addLayers([featureLayert]);




dojo.connect(map, 'onLoad', function(theMap) {
//resize the map when the browser resizes
dojo.connect(dijit.byId('map'), 'resize', map,map.resize);
});

		
		
		
		
		
		
      createBasemapGallery();
      }
function createBasemapGallery() {
//add the basemap gallery, in this case we'll display maps from ArcGIS.com including bing maps
var basemapGallery = new esri.dijit.BasemapGallery({
 showArcGISBasemaps: true,
                //bingMapsKey: 'Ah29HpXlpKwqVbjHzm6mlwMwgw69CYjaMIiW_YOdfTEMFvMr5SNiltLpYAcIocsi',
                toggleReference: true,
                googleMapsApi: {
                  v: '3.6' // use a specific version is recommended for production system.
                },
                map: map
              }, "basemapGallery");

basemapGallery.startup();

dojo.connect(basemapGallery, "onError", function(msg) {console.log(msg)});
	//An event handler for on selection change for the basemap
	dojo.connect(basemapGallery,"onSelectionChange",function(){
		    var basemap = basemapGallery.getSelected(); 
		    //console.log(basemap.id + " is the current basemap");
	});
	
/*	The onload event is tied to a function that changes the default basemap layer selected
	for now we are gonna use google basemaps*/
	dojo.connect(basemapGallery,"onLoad",function(){
		basemapGallery.select("google_road");
	});	
}

function looper() {
 featureLayer.clear();
getGeodata("../db/rover_one.php?","map");


}


      dojo.addOnLoad(init);
    </script> 
	
	<script>
	$(function() {
		$( "#accordion" )
			.accordion({
				header: "> div > h3"
			})
			.sortable({
				axis: "y",
				handle: "h3",
				stop: function( event, ui ) {
					// IE doesn't register the blur when sorting
					// so trigger focusout handlers to remove .ui-state-focus
					ui.item.children( "h3" ).triggerHandler( "focusout" );
				}
			});
	});
	</script>
	<script type="text/javascript">
                $(function() {
                $(".btmiddle").click(function() {
                    if ($(".btmiddle").hasClass("bt")) {
                        $(".btmiddle").removeClass("bt");
                        $(".btmiddle").addClass("clicked");
                        $("#menu").show();
                    } else {
                        $(".btmiddle").removeClass("clicked");
                        $(".btmiddle").addClass("bt");
                        $("#menu").hide();
                    }
                });
            });
			
			 $(function() {
                $(".btmiddle1").click(function() {
                    if ($(".btmiddle1").hasClass("bt")) {
                        $(".btmiddle1").removeClass("bt");
                        $(".btmiddle1").addClass("clicked");
                        $("#filterz").show();
                    } else {
                        $(".btmiddle1").removeClass("clicked");
                        $(".btmiddle1").addClass("bt");
                        $("#filterz").hide();
                    }
                });
            });
            
			$(function() {
                $(".btright").click(function() {
                    if ($(".btright").hasClass("bt")) {
                        $(".btright").removeClass("bt");
                        $(".btright").addClass("clicked");
                        $("#gallery").show();
                    } else {
                        $(".btright").removeClass("clicked");
                        $(".btright").addClass("bt");
                        $("#gallery").hide();
                    }
                });
            });
        </script>
			<script>
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	$(function() {
		$( "#dialog" ).dialog({
			autoOpen: false,
			show: "blind",
			hide: "explode"
		});

		$( "#fungua" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			return false;
		});
	});
	</script>
		<!--
            Code below pulls out the div elements that show the charts
        -->
        <script>
            jQuery(function($) {
                $('a.panel').click(function() {
                    var $target = $($(this).attr('href')),
                    $other = $target.siblings('.active'),
                    animIn = function () {
                        $target.addClass('active').show().css({
                            left: -($target.width())
                        }).animate({
                            left: 0
                        }, 500);
                    };
        
                    if (!$target.hasClass('active') && $other.length > 0) {
                        $other.each(function(index, self) {
                            var $this = $(this);
                            $this.removeClass('active').animate({
                                left: -$this.width()
                            }, 500, animIn);
                        });
                    } else if (!$target.hasClass('active')) {
                        animIn();
                    }
                });

            });
        </script>
    <!--
        fixes or styles the div element for the charts
        -->
        <style>
            div.panel {
                position: absolute;
                width: 450px;
                height: 400px;
                display: none;
            }
        </style>
	
		
  </head> 

  <body class="claro"> 
	<!-- Map area-->  
    <div id="base" dojotype="dijit.layout.BorderContainer" design="headline" gutters="false" style="width:100%;height:100%;margin:0;">
		<div id="map" dojotype="dijit.layout.ContentPane" addarcgisbasemaps="true" region="center" style="border:1px solid #000;padding:0;">
		  <!--div style="position:absolute; right:20px; top:10px; z-Index:999;">
			<div dojoType="dijit.TitlePane" title="Switch Basemap" closable="false"  open="false">
			  <div dojoType="dijit.layout.ContentPane" style="width:380px; height:280px; overflow:auto;">
			  <div id="basemapGallery" ></div></div>
			</div>
		  </div-->
		  
		  <div id="box"  style="position:absolute; right:30%;  z-Index:999;">
    <a href="javascript: searchz();" class="bt btleft">Search<span id="fungua"><img src="img/16table.png"/>&#9734; </span></a>
    <a href="#" class="bt btmiddle">Reports <span>&#9660;</span></a>
    <a href="#" class="bt btmiddle1">Share this <span>&#9660;</span></a>
	<a href="#" class="bt btright">Switch Basemap <span>&#9660;</span></a>
	
</div>
<div id="menu" style="position:absolute; left:40%; top:15%; z-Index:999;">
    <div id="triangle"></div>
    <div id="tooltip_menu">
        <a href="#" class="menu_top">
            <img src="img/1.png"/>
            Graphs
        </a>
        <a href="#">
            <img src="img/2.png"/>
            Charts
        </a>
        <a href="#" class="menu_bottom">
            <img src="img/3.png"/>
            Tabular
        </a>
    </div>
</div>


<div id="gallery" dojoType="dijit.layout.ContentPane" style="position:absolute; width:55%; top:20%; left:20%; height:auto; z-Index:999; overflow:auto;">
<div id="basemapGallery" ></div></div>

<!--div style="position:absolute; right:10px; top:10px; z-Index:999;">
<div id="accordion" STYLE="font-family: Arial Black; width:auto; font-size: 10px; color: black">
	<div class="group">
		<h3><a href="#">Search By Category</a></h3>
		<div>
		 <form>
	<select name="typo" id="typo" onchange="jin_ajax_loop()">
	<option value="">Select Category</option>
	<?php
  $query = "SELECT * FROM `tbl_typology`;";
$result = mysql_query($query); 


while ($row = mysql_fetch_array($result)){
?>
<font face="verdana" size ="0.5" color="green">
<option value="<?php echo $row['CSOTypeID']; ?>"><?php echo $row['CSOTypeName']; ?></a> </option>
</font>
<?php
}
?>
</select>

</form>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Search By Sector</a></h3>
		<div>
	<select name="secta" id="secta" onchange="secta()">
	<option value="">Select Sector</option>
	<?php
  $query2 = "SELECT * FROM `tbl_sector`;";
$result2 = mysql_query($query2); 


//create combo box for webform
while ($row2 = mysql_fetch_array($result2)){
?>

<font face="verdana" size ="0.5" color="green">
<option value="<?php echo $row2['ID']; ?>"><?php echo $row2['Name']; ?> </option>
</font>
<?php
}
?>
</select>
		</div>
	</div>
	
	
</div>
</div-->

</div>
		</div>
    </div>
	<div id="legend" style="position:absolute; left:10px; bottom:10px; z-Index:999;">
	<form action="">
<input type="checkbox" name="r1" value="r1" checked="checked">Sojourner<br>
<input type="checkbox" name="r2" value="r2" checked="checked">Spirit<br>
<input type="checkbox" name="r3" value="r3" checked="checked">Opportunity<br>
<input type="checkbox" name="r4" value="r4" checked="checked">Curiosity
</form>
	</div>
	

	<div class="demo">

<div id="dialog" title="Search Results">
	<table id ="stud_tbl"  align="center">
			</table id ="all_stud_tbl" > 
	</div>



</div><!-- End demo -->
	
	
  </body> 

  </html>