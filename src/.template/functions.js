///////////////
// FONCTIONS //
///////////////

function arrayRemove(arr, value) {
    return arr.filter(function (geeks) {
        return geeks != value;
    });
}
async function goTo(file,rotation="0 0 0")
{ 
  let newScene = document.createElement("a-entity")
  fetch(file)
    .then(response => response.text())
    .then(text => {
      newScene.innerHTML= text;
      document.querySelector("a-scene").append(newScene)
  });
  await new Promise(r => setTimeout(r, 1000));
  
  let base = document.querySelector("#base")
  base.parentNode.removeChild(base);
  newScene.setAttribute("id","base")
  
  let camera = document.querySelector("#player")
  camera.setAttribute("rotation",rotation)
}
