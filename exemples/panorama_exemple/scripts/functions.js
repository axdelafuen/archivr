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
let camera = document.querySelector("#player")
camera.setAttribute("rotation",rotation)

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
}

function addPanel(computer)
{
if(AFRAME.utils.device.checkHeadsetConnected ())
  {
    let camera = document.querySelector("#player")
    let scene = document.querySelector("a-scene")
    let panel = document.createElement("a-image")
    if(!computer)
    {
      panel.setAttribute("src","./assets/images/computerBinding.png")
      panel.setAttribute("rotation","-50 0 0")
      panel.setAttribute("position","0 -5 -1")
      panel.addEventListener("click",function(){
        console.log("EMITED")
        goTo('./templates/batInfo.html')
      })
      panel.setAttribute("animationcustom")
      scene.append(panel)
    }
          
    let leftHand = document.createElement("a-entity")
    let rightHand =  document.createElement("a-entity")

    leftHand.setAttribute("id","left")
    rightHand.setAttribute("id","right")

    rightHand.setAttribute("hand-controls")
    leftHand.setAttribute("hand-controls")

    leftHand.setAttribute("laser-controls","hand:left")
    rightHand.setAttribute("laser-controls","hand: right")

    leftHand.setAttribute("raycaster","showLine: true;lineColor: blue; lineOpacity: 1;objects: [animationcustom]")
    rightHand.setAttribute("raycaster","showLine: true;lineColor: red; lineOpacity: 1;objects: [animationcustom]")

    camera.append(leftHand)
    camera.append(rightHand)
  }
}
