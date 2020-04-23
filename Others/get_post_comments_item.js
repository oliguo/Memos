var data=[];
$.each($('li'),function(k,v){
    var name=$.trim($($(v).find('a[class="_6qw4"]')).text());
    var comment=$.trim($($(v).find('span[class="_3l3x"]')).text());
    var comment_time=$.trim($($(v).find('abbr')).attr('data-tooltip-content'));
    var is_reply=$.trim($($(v).find('span[class="_4sso _4ssp"]')).text());
    if(is_reply===undefined){
        is_reply="";
    }
    if(name!=''&&comment!=''&&comment_time!=''){
        data.push([name,comment,comment_time,is_reply]);
    }
    //console.log(is_reply);
});
console.log(data);
var finalVal = '';

for (var i = 0; i < data.length; i++) {
    var value = data[i];

    for (var j = 0; j < value.length; j++) {
        var innerValue =  value[j]===null?'':value[j].toString();
        var result = innerValue.replace(/"/g, '""');
        if (result.search(/("|,|\n)/g) >= 0)
            result = '"' + result + '"';
        if (j > 0)
            finalVal += ',';
        finalVal += result;
    }

    finalVal += '\n';
}

console.log(finalVal);

var download = document.getElementById('download');
download.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(finalVal));
download.setAttribute('download', 'test.csv');
