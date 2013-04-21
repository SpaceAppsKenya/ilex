function getGeodata(url,target){

featureCollection = {
"layerDefinition": null,
"featureSet": {
"features": [],
"geometryType": "esriGeometryPoint"
}
};

var httpc= new XMLHttpRequest();
var params='';
httpc.open("POST",url,true);
httpc.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
httpc.setRequestHeader("Content-Length",params.length);
httpc.send(null);
httpc.onreadystatechange=function(){
if(httpc.readyState==4 && httpc.status==200){
//alert(httpc.responseText);
var jsonResult = httpc.responseText;
result=eval('(' + jsonResult + ')');

//get the data from the Json Objects
var features = [];


//loop through the json data;
dojo.forEach(result,function(item,i){
var attr = {};

	
	attr["description"] ="<b> " +
							"<form method='post' action='index.php' name='myform' id='myform'>"+
							    " <input type='hidden' name='ile' id='ile' value = '357302042224377'><br>" +
								"<b>Name.:</b><br>  <i> <input type='text' name='jina' id='jina'></i><br>" +
								"<b>E-mail.:</b><br>  <i> <input type='text' name='email' id='email'></i><br>" +
								"<b>Country.:</b><br>  <i> <input type='text' name='nchi' id='nchi'></i><br>" +
								"<b>Comment.</b> <br><input type='textarea' name='comment' id='comment'><br> <input type='submit' name='searchz' id='searchz' value='Comment'></form><i></i>" +					
								
								"<hr><b></b> <i>Bringing Mars Back Home </i>";
								
                                 
								
                                 


attr["photo"]=item.photo;
attr["pic"]=item.picha;
//icons[i]=item.icon;
 attr["picha"]=item.simu;
 //attr["mwenyewe"]=item.Ownership

var geometry = esri.geometry.geographicToWebMercator(new esri.geometry.Point(item.point_x, item.point_y, map.spatialReference)); //setting to the

graphic = new esri.Graphic(geometry);
graphic.setAttributes(attr);
features.push(graphic); //adding to features array

});
featureLayer.applyEdits(features, null, null);
}

};


//alert(icons[1]);
featureCollection.layerDefinition = {
"geometryType": "esriGeometryPoint",
"objectIdField": "ObjectID",
"drawingInfo": {
"renderer": {
"type": "simple",
"symbol": {
"type": "esriPMS",
"url": "./images/r1.jpg",
"contentType": "image/gif",
"width": 10,
"height": 10
}
}
},
"fields": [{
"name": "ObjectID",
"alias": "ObjectID",
"type": "esriFieldTypeOID"
},{
"name": "description",
"alias": "Description",
"type": "esriFieldTypeString"
},{
"name": "title",
"alias": "Title",
"type": "esriFieldTypeString"
}]
};

setTimeout("looper()", 5000);
}//end of the function for communicating with the php script;



