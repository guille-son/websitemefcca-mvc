var wms_layers = [];

var format_nicaragua_wgs84_grados_0 = new ol.format.GeoJSON();
var features_nicaragua_wgs84_grados_0 = format_nicaragua_wgs84_grados_0.readFeatures(json_nicaragua_wgs84_grados_0, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_nicaragua_wgs84_grados_0 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_nicaragua_wgs84_grados_0.addFeatures(features_nicaragua_wgs84_grados_0);
var lyr_nicaragua_wgs84_grados_0 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_nicaragua_wgs84_grados_0, 
                style: style_nicaragua_wgs84_grados_0,
                interactive: true,
                title: '<img src="styles/legend/nicaragua_wgs84_grados_0.png" /> nicaragua_wgs84_grados'
            });
var format_MicrocreditosJustos_1 = new ol.format.GeoJSON();
var features_MicrocreditosJustos_1 = format_MicrocreditosJustos_1.readFeatures(json_MicrocreditosJustos_1, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_MicrocreditosJustos_1 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_MicrocreditosJustos_1.addFeatures(features_MicrocreditosJustos_1);
var lyr_MicrocreditosJustos_1 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_MicrocreditosJustos_1, 
                style: style_MicrocreditosJustos_1,
                interactive: true,
                title: '<img src="styles/legend/MicrocreditosJustos_1.png" /> MicrocreditosJustos'
            });
var format_EconomiaFamiliar_2 = new ol.format.GeoJSON();
var features_EconomiaFamiliar_2 = format_EconomiaFamiliar_2.readFeatures(json_EconomiaFamiliar_2, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_EconomiaFamiliar_2 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_EconomiaFamiliar_2.addFeatures(features_EconomiaFamiliar_2);
var lyr_EconomiaFamiliar_2 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_EconomiaFamiliar_2, 
                style: style_EconomiaFamiliar_2,
                interactive: true,
                title: '<img src="styles/legend/EconomiaFamiliar_2.png" /> EconomiaFamiliar'
            });

lyr_nicaragua_wgs84_grados_0.setVisible(true);lyr_MicrocreditosJustos_1.setVisible(true);lyr_EconomiaFamiliar_2.setVisible(true);
var layersList = [lyr_nicaragua_wgs84_grados_0,lyr_MicrocreditosJustos_1,lyr_EconomiaFamiliar_2];
lyr_nicaragua_wgs84_grados_0.set('fieldAliases', {'dpto': 'dpto', 'muni': 'muni', });
lyr_MicrocreditosJustos_1.set('fieldAliases', {'ID': 'ID', 'NOMBRE': 'NOMBRE', 'CEDULA': 'CEDULA', 'DEPARTAMEN': 'DEPARTAMEN', 'MUNICIPIO': 'MUNICIPIO', 'COMUNIDAD': 'COMUNIDAD', 'ETNIA': 'ETNIA', 'INVERSION': 'INVERSION', 'PROGRAMA': 'PROGRAMA', 'X1': 'X1', 'Y1': 'Y1', 'POINT_X': 'POINT_X', 'POINT_Y': 'POINT_Y', });
lyr_EconomiaFamiliar_2.set('fieldAliases', {'ID': 'ID', 'NOMBRE': 'NOMBRE', 'CEDULA': 'CEDULA', 'DEPARTAMEN': 'DEPARTAMEN', 'MUNICIPIO': 'MUNICIPIO', 'COMUNIDAD': 'COMUNIDAD', 'ETNIA': 'ETNIA', 'X': 'X', 'Y': 'Y', 'INVERSION': 'INVERSION', 'PROGRAMA': 'PROGRAMA', 'LONGITUD': 'LONGITUD', 'LATITUD': 'LATITUD', });
lyr_nicaragua_wgs84_grados_0.set('fieldImages', {'dpto': '', 'muni': '', });
lyr_MicrocreditosJustos_1.set('fieldImages', {'ID': 'TextEdit', 'NOMBRE': 'TextEdit', 'CEDULA': 'TextEdit', 'DEPARTAMEN': 'TextEdit', 'MUNICIPIO': 'TextEdit', 'COMUNIDAD': 'TextEdit', 'ETNIA': 'TextEdit', 'INVERSION': 'TextEdit', 'PROGRAMA': 'TextEdit', 'X1': 'TextEdit', 'Y1': 'TextEdit', 'POINT_X': 'TextEdit', 'POINT_Y': 'TextEdit', });
lyr_EconomiaFamiliar_2.set('fieldImages', {'ID': 'TextEdit', 'NOMBRE': 'TextEdit', 'CEDULA': 'TextEdit', 'DEPARTAMEN': 'TextEdit', 'MUNICIPIO': 'TextEdit', 'COMUNIDAD': 'TextEdit', 'ETNIA': 'TextEdit', 'X': 'TextEdit', 'Y': 'TextEdit', 'INVERSION': 'TextEdit', 'PROGRAMA': 'TextEdit', 'LONGITUD': 'TextEdit', 'LATITUD': 'TextEdit', });
lyr_nicaragua_wgs84_grados_0.set('fieldLabels', {'dpto': 'no label', 'muni': 'no label', });
lyr_MicrocreditosJustos_1.set('fieldLabels', {'ID': 'inline label', 'NOMBRE': 'inline label', 'CEDULA': 'inline label', 'DEPARTAMEN': 'inline label', 'MUNICIPIO': 'inline label', 'COMUNIDAD': 'inline label', 'ETNIA': 'inline label', 'INVERSION': 'inline label', 'PROGRAMA': 'inline label', 'X1': 'inline label', 'Y1': 'inline label', 'POINT_X': 'inline label', 'POINT_Y': 'inline label', });
lyr_EconomiaFamiliar_2.set('fieldLabels', {'ID': 'inline label', 'NOMBRE': 'inline label', 'CEDULA': 'inline label', 'DEPARTAMEN': 'inline label', 'MUNICIPIO': 'inline label', 'COMUNIDAD': 'inline label', 'ETNIA': 'inline label', 'X': 'inline label', 'Y': 'inline label', 'INVERSION': 'inline label', 'PROGRAMA': 'inline label', 'LONGITUD': 'inline label', 'LATITUD': 'inline label', });
lyr_EconomiaFamiliar_2.on('precompose', function(evt) {
    evt.context.globalCompositeOperation = 'normal';
});