function calculate() {
    let number1Input = document.querySelector("#number1");
    let number1 = number1Input.value;

    let operationChoice = document.querySelector("#operation");
    let operation = operationChoice.value;

    let number2Input = document.querySelector("#number2");
    let number2 = number2Input.value;

    fetch("calc_v2.php?number1=" + number1 + "&operation=" + operation + "&number2=" + number2)
        .then(response => response.json())
        .then(jsonObject => {
            let i;
            let endresult = "";
            for (i = 0; i < jsonObject.length; i++) {
                endresult = endresult + jsonObject[i];
            }
            let resultField = document.querySelector(".lastresult");
            resultField.innerHTML = "Последние вычисления:<br>" + endresult;
        })
}
