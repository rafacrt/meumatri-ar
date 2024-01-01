/**
 * Turn on/off contentEditable property
 * 
 * @param {*} elementId 
 * @param {*} buttonId 
 */
function toggleContentEditable(elementId, buttonId) {
    const element = document.getElementById(elementId);
    const button = document.getElementById(buttonId);
  
    if (element.getAttribute('contenteditable') === 'true') {
      element.setAttribute('contenteditable', 'false');
      button.classList.remove('botao-editando');
    } else {
      element.setAttribute('contenteditable', 'true');
      button.classList.add('botao-editando');
    }
  }
