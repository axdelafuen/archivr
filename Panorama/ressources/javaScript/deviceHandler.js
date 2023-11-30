AFRAME.registerComponent('scene', {
  schema: {
    renderer: {},
    sceneSmall: {}
  },
  init: function () {
    if(AFRAME.utils.device.isMobile ())
    {
      mobileComponent(this)
    }
    else
    {
      computerComponent(this)
    }
  },
});



function computerComponent()
{
  /////////////////////////
  // Show control pannel //
  /////////////////////////
  let panel = document.createElement("a-image")
  panel.setAttribute("src","./ressources/javaScript/assets/computerPane.png")

  
  document.querySelector('a-scene').addEventListener('enter-vr', function () {
    if(AFRAME.utils.device.checkHeadsetConnected ())
    {
      let leftHand = document.createElement("a-entity")
      let rightHand =  document.createElement("a-entity")

      leftHand.setAttribute("id","left")
      rightHand.setAttribute("id","right")
      
      leftHand.setAttribute("laser-controls","hand:left")
      rightHand.setAttribute("laser-controls","hand: right")
      
      leftHand.setAttribute("raycaster","showLine: true;lineColor: blue; lineOpacity: 1")
      rightHand.setAttribute("raycaster","showLine: true;lineColor: red; lineOpacity: 1")
      
      let scene =  document.querySelector("a-scene")
      scene.append(leftHand)
      scene.append(rightHand)
      console.log(rightHand)
    }
  });
}

function mobileComponent()
{  
  //////////////////////////
  // Add css file for HUD //
  //////////////////////////
  let link = document.createElement('link');
  link.rel="stylesheet";
  link.type ='text/css';
  link.href ='./ressources/css/style.css';
  document.getElementsByTagName('HEAD')[0].appendChild(link);
  //////////////////////////////
  // Remove useless button(s) //
  // ///////////////////////////
  let skyNumber = document.querySelectorAll("a-sky").length
  if(skyNumber===1)
  {
    console.log("OnlyOne sky")
  }
  else
  {
    
    let controlEntity = document.querySelector(".hud")

    let buttonArray = controlEntity.querySelectorAll("button")
    console.log(buttonArray)
    buttonArray.forEach(element=>{
      if(skyNumber === 0)
      {
        element.remove()
      }
      else
      {
        element.innerText="skyGetvalueyears"+element.id
        skyNumber--
      }
    })
  }
}
