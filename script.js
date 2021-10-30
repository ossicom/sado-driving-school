//für hamburger menu
const toggleButton = document.getElementsByClassName(`toggle-button`)[0];
const navbarLinks = document.getElementsByClassName(`navbar-links`)[0];

toggleButton.addEventListener(`click`, () => {
  navbarLinks.classList.toggle(`active`);
});

//für header php mailer
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
/* 
//function für update
function changeText() {
  document.getElementById('ereignis').innerHTML =
    document.getElementById('datum').value;
}

// create div element
let divElement = document.createElement('div');

// create text node
let divElementText = document.createTextNode('Dynamically created div element');

// append text node to div
divElement.appendChild(divElementText);

// append div element to document
document.body.appendChild(divElement);
*/

/*function myFunction() {
  var x = document.getElementById('eingabe').innerHTML;
  document.getElementById('ereignis').innerHTML = x;
} */
/*function ekle() {
  document.getElementById('ereignis').innerHTML =
    document.getElementById('yazi').Value;
} */

/*//das funktioniert
// 1- variable zu id "ereignis zuweisen"
const ereignis = document.getElementById('ereignis');

// 2- variable zuweisen und neuen h4 tag erstellen
const newParagraph = document.createElement('h4');

// 3- variable zuweisen und neuen Text für h4 erstellen
const newText = document.createTextNode('Dies ist der neue Text in mydiv');

// 4- Text zum h4 tag zuweisen
newParagraph.appendChild(newText);

// 5- html tag h4 zum div mit id ereignis zuweisen
ereignis.appendChild(newParagraph); */

function newHtmlTag() {
  const ereignis = document.getElementById('ereignis');
  const newParagraph = document.createElement('h4');
  const newText = document.getElementById('yazi');
  newParagraph.appendChild(newText);
  ereignis.appendChild(newParagraph);
}
