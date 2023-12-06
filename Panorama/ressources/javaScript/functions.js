///////////////
// FONCTIONS //
///////////////


// Remove an element from an array 
function arrayRemove(arr, value) {
    return arr.filter(function (geeks) {  
        return geeks != value;
    });
}


// Switch current views
async function goTo(file,rotation="0 0 0")
{ 
  // Create futur new scene
  let newScene = document.createElement("a-entity")
  // Load html content from the file
  fetch(file)
    .then(response => response.text())
    .then(text => {
      newScene.innerHTML= text;
      document.querySelector("a-scene").append(newScene)
  });
  // Wait 1 seconde, corresponding to the fadeIn animation
  await new Promise(r => setTimeout(r, 1000));
  
  let base = document.querySelector("#base")
  // Remove old scene
  base.parentNode.removeChild(base);
  
  newScene.setAttribute("id","base")
  
  let camera = document.querySelector("#camera")
  camera.setAttribute("rotation",rotation)
}
