
$( document ).ready(function() {

    var xhr = new XMLHttpRequest();
    xhr.responseType='json';
    xhr.open('GET', "populates.php", true);
    xhr.setRequestHeader('Content-Type','application/json');
    xhr.send();

    xhr.onreadystatechange = function (event){
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {

            var response = xhr.response;

            $.each(response, function (index,element) {
                $('input[name='+index+']').attr('value',element);
            });
        }
    }
    

    function uploadLocalStorage()
    {
        var numStorage = localStorage.length;
        var item = localStorage.length -1;
        console.log("uploadLocalStoraged has been invoked");
        if (numStorage) {
            console.log("there are "+numStorage+" obj in localStorage");

            var json = localStorage.getItem(''+item);

            console.log(localStorage.getItem(''+item));

            var xhr = new XMLHttpRequest();
            xhr.responseType = 'json';
            xhr.open('POST', "query.php", true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(json);

            xhr.onreadystatechange = function( event )
            {
                if (xhr.readyState == 4 && xhr.status == 200 ) {

                    var response = xhr.response;
                    localStorage.removeItem(''+item);
                    console.log('Item '+item+ ' removed from localStorage');
                    //numStorage=localStorage.length;
                    console.log(JSON.stringify(response));

                    if( localStorage.length )
                        uploadLocalStorage();
                }
            }

        }
    }

    Offline.options = {checks: {xhr: {url: '/VTA/index.html'}}};

    $('#invia').click(function (event) {

        event.preventDefault();
        Offline.check();

        if(Offline.state==="up"){

            var jsontest={};

            $('.form-control').each(function () {
                jsontest[$(this).attr('name')]=$(this).val();
            });

            if(localStorage.length>0){

                uploadLocalStorage();
            }

            var xhr = new XMLHttpRequest();
            xhr.responseType='json';
            xhr.open('POST', "query.php", true);
            xhr.setRequestHeader('Content-Type','application/json');
            xhr.send(JSON.stringify(jsontest));

            xhr.onreadystatechange = processRequest;

            function processRequest(e) {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {

                    var response = xhr.response;
                    console.log(JSON.stringify(response));
                }
            }
        }else{
            Offline.check();
            console.log(Offline.state);

            var json={};
            var pastData=localStorage.length;

            $('.form-control').each(function () {
                json[$(this).attr('name')]=$(this).val();
            });

            localStorage.setItem(''+pastData,JSON.stringify(json));
        }
    });

    $('#home_button').click(function () {

        $('#home_section').removeClass('hidden');
        $('#nav_buttons').removeClass('hidden');
        $('#gestione_section').addClass('hidden');

    });

    $('#gestione_button').click(function () {

        $('#home_section').addClass('hidden');
        $('#nav_buttons').addClass('hidden');
        $('#gestione_section').removeClass('hidden');

        $('#body_tabella').empty();

        var xhr = new XMLHttpRequest();
        xhr.responseType='json';
        xhr.open('GET', "table.php", true);
        xhr.setRequestHeader('Content-Type','application/json');
        xhr.send();

        xhr.onreadystatechange = function (event){
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {

                var response = xhr.response;

                $.each(response, function (index,element) {

                    var tr = $('<tr>').addClass('riga');

                    $.each(element, function (index2,element2) {

                        if(index2==='varieta') return false;

                        var td = $('<td>');
                        td.append( element2 );
                        tr.append( td );
                    });

                    $('#body_tabella').append( tr );
                });
            }
        }
    });

    $('#next').click(function () {

        if($('#page_status').attr('value')==1) {

            $('#informazioni_generali').addClass('hidden');
            $('#dati_dimensione_pianta').addClass('hidden');
            $('#caratteri_generali').addClass('hidden');

            $('#castello').removeClass('hidden');
            $('#chioma').removeClass('hidden');
            $('#esame_strumentale').removeClass('hidden');
            $('#tipologia_pavimentazione').removeClass('hidden');

            $('#previous').removeClass('hidden');
            $('#page_status').attr('value',2);
        }
        else if($('#page_status').attr('value')==2){

            $('#castello').addClass('hidden');
            $('#chioma').addClass('hidden');
            $('#esame_strumentale').addClass('hidden');
            $('#tipologia_pavimentazione').addClass('hidden');

            $('#bersaglio').removeClass('hidden');
            $('#colletto').removeClass('hidden');
            $('#next').addClass('hidden');
            $('#page_status').attr('value',3);
        }

    });

    $('#previous').click(function () {

        if($('#page_status').attr('value')==2) {

            $('#informazioni_generali').removeClass('hidden');
            $('#dati_dimensione_pianta').removeClass('hidden');
            $('#caratteri_generali').removeClass('hidden');

            $('#castello').addClass('hidden');
            $('#chioma').addClass('hidden');
            $('#esame_strumentale').addClass('hidden');
            $('#tipologia_pavimentazione').addClass('hidden');

            $('#previous').addClass('hidden');
            $('#page_status').attr('value',1);
        }
        else if($('#page_status').attr('value')==3){

            $('#castello').removeClass('hidden');
            $('#chioma').removeClass('hidden');
            $('#esame_strumentale').removeClass('hidden');
            $('#tipologia_pavimentazione').removeClass('hidden');

            $('#bersaglio').addClass('hidden');
            $('#colletto').addClass('hidden');

            $('#next').removeClass('hidden');

            $('#page_status').attr('value',2);
        }

    });

});

