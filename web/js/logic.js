/**
 * Created by Alix Rincon  on 05/02/2019.
 */
$(document).ready(function () {

    //Funcion que serializa el objeto para enviarlo en el data.
    function objectifyForm(formArray) {

        var returnArray = {};
        for (var i = 0; i < formArray.length; i++) {
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    }
    //Carga las ciudades en el combo de seleccion cities.
    function loadCities() {
        var request = $.ajax({
            type: 'GET',
            url: 'http://localhost/decameron/web/city/index',
            dataType: "json",
        });
        request.done(function (data) {
            $.each(data, function (key, value) {
                $("#cities").append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    }
    loadCities();

    //Creacion del Hotel
    $('#postHotel').on('click', function (e) {
        e.preventDefault();
        $("#createHotelForm select, input").next().html("");
        var data = $('#createHotel').serializeArray();
        var request = $.ajax({
            type: 'POST',
            url: 'http://localhost/decameron/web/hotel/create',
            dataType: "json",
            data: objectifyForm(data),
        });
        request.done(function (data) {
            localStorage.setItem("currentHotel",data.id);
            $("#acomodationAssign").css('display', 'block');
            $("#createHotelForm").css('display', 'none');
        });
        request.fail(function (jqXHR, textStatus) {
            $.each( jqXHR.responseJSON, function( key, value ) {
                $("#createHotelForm select[name='" + value.field + "'], input[name='" + value.field + "']").next().html(value.message);
            });
        });
    });
    //Carga los tipos de habitacion
    function loadHotelRoomType() {
        var request = $.ajax({
            type: 'GET',
            url: 'http://localhost/decameron/web/hotelroomtype/index',
            dataType: "json",
        });
        request.done(function (data) {
            $.each(data, function (key, value) {
                $("#typerooms").append('<option value=' + value.id + '>' + value.name + '</option>');
                localStorage.setItem("HotelRoomType:" + value.id,value.name);
            });
        });
    }
    loadHotelRoomType();

    //En el change del combo tipo de habitacion envia los valores name y id de acuerdo a las acomodaciones permitidas.
    $("#typerooms").change(function () {

        $("#accomodation")
            .attr("disabled","disabled")
            .find('option')
            .remove()
            .end()
            .append('<option value="">Seleccione Tipo Acomodación</option>');

        var request = $.ajax({
            type: 'GET',
            url: 'http://localhost/decameron/web/roomconfig/getbyid/' + $(this).val(),
            dataType: "json",
        });
        request.done(function (data) {
            $.each(data, function (key, value) {
                $("#accomodation").attr("disabled",false).append('<option value=' + value.Id + '>' + value.accomodationtypeName + '</option>');
                localStorage.setItem("AcomodationType:" + value.Id ,value.accomodationtypeName);
            });
        });
    });

    //En el clic del  boton añadir crea los valores registrados para tipo habitacion, acomodacion y cantidad para el hotel
    $('#add').on('click', function (e) {
        e.preventDefault();
        $("#acomodationAssign select, input").next().html("");
        var data = $('#assignRoom').serializeArray();
        var request = $.ajax({
            type: 'POST',
            url: 'http://localhost/decameron/web/hotelhasrooms/create',
            dataType: "json",
            data: {
                'idhotel' : localStorage.getItem("currentHotel"),
                'idroomconfig' : $("#accomodation").val(),
                'amount' : $("#amount").val()
            }
        });
        request.done(function (data) {
            $("#selecctionRows .emptyrow").remove();
            $("#selecctionRows").append('<tr><td>' + data.amount + '</td><td>' +
                localStorage.getItem("HotelRoomType:" + $("#typerooms").val()) + '</td><td>' +
                localStorage.getItem("AcomodationType:" + $("#accomodation").val()) + '</td></tr>');
            $('#closeapp').attr("disabled", false);
        });
        request.fail(function (jqXHR, textStatus) {
            $.each( jqXHR.responseJSON, function( key, value ) {
                $("#acomodationAssign select[name='" + value.field + "'], input[name='" + value.field + "']").next().html(value.message);
            });
        });
    });

    //clic del boton finalizar hace un location.reload
    $('#closeapp').on('click', function (e) {
        e.preventDefault();
        location.reload();
    });

});