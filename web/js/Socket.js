
var conn = new WebSocket('ws://localhost:8080');

conn.onmessage = function(e) {
    
    var json = JSON.parse(e.data);


    var html = '<table class="table table-striped table-inverse"><thead><tr><th>ID</th><th>Дата</th><th>Время</th></tr></thead><tbody>';

    for(var i in json) {

        html += '<tr><td>'+json[i].id +'</td>' + '<td>' + json[i].date + '<td>' + json[i].time_start +'</td></tr>';

        }

    html +='</tbody></table>';
    document.getElementById('site-index').innerHTML= html;
};

conn.onopen = function() {

};

