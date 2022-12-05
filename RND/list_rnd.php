<form id="myForm">

<input  list="answers" id="answer">
    <datalist id="answers">
        <option data-value="42">The answer</option>
        <option data-value="1337">Elite</option>
        <option data-value="69">Dirty</option>
        <option data-value="3">Pi</option>
    </datalist>

<input onchange='changeQuestion()' list="questions" id="question">
    <datalist id="questions">
        <option data-value="142">The Question</option>
        <option data-value="11337">Model</option>
        <option data-value="169">Condition</option>
        <option data-value="13">Value</option>
    </datalist>



    <input type="hidden" name="question" id="question-hidden">    
    <input type="hidden" name="answer" id="answer-hidden">
    <input type="submit">
</form>

<p>Submitted value (for debugging):</p>
<pre id="result-answer"></pre>
<BR>
<pre id="result-question"></pre>

<script>

function changeQuestion(){

    var input = document.getElementById('question'),
        list = input.getAttribute('list'),
        options = document.querySelectorAll('#' + list + ' option'),
        hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
        label = input.value;
        //alert (list);

        for(var i = 0; i < options.length; i++) {
        var option = options[i];

        if(option.innerText === label) {
            hiddenInput.value = option.getAttribute('data-value');
            break;
        }

    }

}



document.querySelector('input[list]').addEventListener('input', function(e) {
    var input = e.target,
        list = input.getAttribute('list'),
        options = document.querySelectorAll('#' + list + ' option'),
        hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
        label = input.value;

        
    //alert (list);
    //hiddenInput.value = label;
    hiddenInput.value="";

    for(var i = 0; i < options.length; i++) {
        var option = options[i];

        if(option.innerText === label) {
            hiddenInput.value = option.getAttribute('data-value');
            break;
        }

    }


    if(hiddenInput.value==""){
       // alert ("Wrong Value Selected");
    }
});

// For debugging purposes
document.getElementById("myForm").addEventListener('submit', function(e) {

    var value_answer = document.getElementById('answer-hidden').value;
    document.getElementById('result-answer').innerHTML = value_answer;
    e.preventDefault();

    var value_question = document.getElementById('question-hidden').value;
    document.getElementById('result-question').innerHTML = value_question;
    e.preventDefault();
});

</script>