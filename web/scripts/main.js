$(document).ready(function () {
    $('[id="gewonnen"]').css("background-color", "#4DDB4D");
    $('[id="verloren"]').css("background-color", "#FF3030");
    $('[id="gelijk"]').css("background-color", "#FFFF33");
});
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});
var i = 0;
$(function () {
    $("#add").click(function () {

        if (5 > $(".attr").length) {
            var cycleBlock = '<div class="col-lg-12 field-goalform-' + i + '-playerid" id="item' + i + '">';
            cycleBlock += '<label class="control-label" for="goalform-0-playerid">Speler</label><select id="goalform-0-playerid" class="form-control" name="GoalForm[' + i + '][playerId]"> <option value="1">Robbe</option> <option value="2">Pieter</option><option value="4">Giel</option> <option value="7">Frederique</option> <option value="11">Elias</option> <option value="13">Cedric </option> <option value="14">Jorg</option> <option value="17">Jeroen</option></select><span class="glyphicon glyphicon-remove" onclick="deleteElm(item'+i+'.id);"/>';
            cycleBlock += '</div>';
            var $cycleBlock = $(cycleBlock);
            $('#fields').append($cycleBlock);
            i++;
        } else {

            alert('Maximum attributes limit reached');
        }


    });
});

function deleteElm(elementID)
{
    var elem = document.getElementById(elementID);
    elem.parentNode.removeChild(elem);
}