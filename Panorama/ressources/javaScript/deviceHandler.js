AFRAME.registerComponent('scene', {
  init: function () {
    if(AFRAME.utils.device.isMobile ())
    {
      mobileComponent(this.el)
    }
    else
    {
      computerComponent(this.el)
    }
  },
});



function computerComponent(scene)
{
  /////////////////////////
  // Show control pannel //
  /////////////////////////
  let panel = document.createElement("a-image")
  panel.setAttribute("src","./ressources/assets/computerBinding.png")
  panel.setAttribute("rotation","-50 0 0")
  panel.setAttribute("position","0 -0.8 -0.3")
  scene.append(panel) 
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
  document.querySelector('a-scene').addEventListener('enter-vr', function () {
    if(AFRAME.utils.device.checkHeadsetConnected ())
    {
      let panel = document.createElement("a-image")
      panel.setAttribute("src","./ressources/assets/computerBinding.png")
      panel.setAttribute("rotation","-50 0 0")
      panel.setAttribute("position","0 -2 -1")
      this.append(panel)
      
      let leftHand = document.createElement("a-entity")
      let rightHand =  document.createElement("a-entity")

      leftHand.setAttribute("id","left")
      rightHand.setAttribute("id","right")

      rightHand.setAttribute("hand-controls")
      leftHand.setAttribute("hand-controls")

      leftHand.setAttribute("laser-controls","hand:left")
      rightHand.setAttribute("laser-controls","hand: right")

      leftHand.setAttribute("raycaster","showLine: true;lineColor: blue; lineOpacity: 1")
      rightHand.setAttribute("raycaster","showLine: true;lineColor: red; lineOpacity: 1")

      scene.append(leftHand)
      scene.append(rightHand)
    }
  });
}
