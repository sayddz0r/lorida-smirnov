const inputANode = document.querySelector('.calc-menu-firstnumbers');
const inputBNode = document.querySelector('.calc-menu-secondnumbers');
const selectOperationNode = document.querySelector('.calc-menu-operations');
const btnResultNode = document.querySelector('.button-blue');
const outputNode = document.querySelector('.calc-result');

btnResultNode.addEventListener('click', function() {
    const a = Number(inputANode.value);
    const b = Number(inputBNode.value);
    const operation = selectOperationNode.value;

    const result = calculate({
        a,
        b,
        operation
    });
    outputNode.innerHTML = result;
});

document.getElementById("btn-result").addEventListener('click', function () {
    document.getElementById("my-modal").classList.add("open")
})

document.getElementById("btn-close-result").addEventListener('click', function () {
    document.getElementById("my-modal").classList.remove("open")
})