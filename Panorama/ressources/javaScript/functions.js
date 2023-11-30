///////////////
// FONCTIONS //
///////////////

function arrayRemove(arr, value) {
    return arr.filter(function (geeks) {
        return geeks != value;
    });
}

async function goTo(file="./base.html"){
  newScene = document.createElement("a-entity")
  newScene.setAttribute("id", "tmp")
  newScene.setAttribute('material', 'opacity', '0.5');
  baliseArray = document.querySelector("#base").childNodes
  baliseArray.forEach(element => {
  console.log(element.nodeName)
    if(element.nodeName === "#text" || element.nodeName === "#comment")
    {
      console.log("goTo(): no event to emit")
    }
    else{
      element.emit("startanim",null,false)
    }
  });
  // Load NewScene's Content
  fetch(file)
    .then(response => response.text())
    .then(text => {
      newScene.innerHTML= text;
      document.querySelector("a-scene").append(newScene)
    });
  arrayViews = []
  // Waiting fadeIn / fadeOut animation
  await new Promise(r => setTimeout(r, 1000));
  oldScene = document.querySelector("#base")
  oldScene.parentNode.removeChild(oldScene);
  newScene.setAttribute("id","base")
  newScene.childNodes.forEach(element  =>{
    if(element.nodeName !== "#text")
    {
      element.setAttribute("animation","property: opacity; from: 1.0; to: 0.0;startEvents: startanim; dur: 1000")
    }
  });
}
