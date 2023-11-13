// external JavaScript Document (temponly.js)
// REMOVE THIS WHEN THE ASSIGNMENT IS DONE

function changeText(element) {
    // store the original text content
    element.setAttribute('data-original-text', element.innerText);
    // change the text content on hover
    element.innerText = "NOT DONE";
}

function resetText(element) {
    // reset the text content on mouseout
    element.innerText = element.getAttribute('data-original-text');
}