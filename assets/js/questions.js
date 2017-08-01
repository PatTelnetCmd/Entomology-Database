$(document).ready(function(){

    //Getting the questions json file
    //Question Dropdown List
    $.ajax({
        url: "../assets/js/questions.json",
        dataType: "json",
        success: function (data) {

            var questions = data;
            console.log(questions);
            var listItems = '<option selected="selected" value="">---- Select Security Question -----</option>';

            for(var i = 0; i < questions.questions.length; i++){
                console.log(questions.questions[i].question);
                listItems += "<option value='" + questions.questions[i].question + "'>" + questions.questions[i].question + "</option>";
            }

            $("#question").html(listItems);

        }
    });

});