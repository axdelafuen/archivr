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
  // Set slider's value to 0
  yearsVector = 0
}



function addPanel(computer)
{
  if(AFRAME.utils.device.checkHeadsetConnected ())
    {
      let camera = document.querySelector("#player")

      let panel = document.createElement("a-image")
      if(!computer)
      {
        panel.setAttribute("src","./ressources/assets/computerBinding.png")
        panel.setAttribute("rotation","-50 0 0")
        panel.setAttribute("position","0 -2 -1")
        document.querySelector("a-scene").append(panel)
      }
            
      let leftHand = document.createElement("a-entity")
      let rightHand =  document.createElement("a-entity")

      leftHand.setAttribute("id","left")
      rightHand.setAttribute("id","right")

      rightHand.setAttribute("hand-controls")
      leftHand.setAttribute("hand-controls")

      leftHand.setAttribute("laser-controls","hand:left")
      rightHand.setAttribute("laser-controls","hand: right")

      leftHand.setAttribute("raycaster","showLine: true;lineColor: blue; lineOpacity: 1;objects: [class]")
      rightHand.setAttribute("raycaster","showLine: true;lineColor: red; lineOpacity: 1;objects: [class]")

      camera.append(leftHand)
      camera.append(rightHand)
    }
}


function clickHandler(pane)
{
  if(pane.visibility === false)
  {
    pane.visibility = true
    let className = pane.getAttribute("class")
    fadeIn(className,pane)
    pane.setAttribute("opacity","1.0")
  }
  else
  {
    pane.visibility = false
    let className = pane.getAttribute("class")
    fadeOut(className,pane)
    pane.setAttribute("opacity","1.0")
  }
}

function fadeIn(className,exept)
{
  let array = document.querySelectorAll("."+className)
  array.forEach(element => {
    if(element !== exept)
    {
      element.setAttribute("animation","property: opacity;to: 1.0;dur: 700")
    }
  });
}



function fadeOut(className,exept)
{
  let array = document.querySelectorAll("."+className)
  array.forEach(element => {
    if(element !== exept){
      element.setAttribute("animation","property: opacity;to: 0.0;dur: 700")
    }
  });
}



