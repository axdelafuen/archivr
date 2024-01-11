AFRAME.registerComponent('scene', {
  init: function () {
    if(AFRAME.utils.device.isMobile ())
    {
      mobileComponent(this.el)
      this.el.addEventListener('enter-vr', function () {
      addPanel(false);

    });
    } else {
      computerComponent(this.el)
      this.el.addEventListener('enter-vr', function () {
      addPanel(true);
    })
    }
}});

function computerComponent(scene)
{
  /////////////////////////
  // Show control pannel //
  /////////////////////////
  let panel = document.createElement("a-image")
  panel.setAttribute("src","./assets/images/computerBinding.png")
  panel.setAttribute("rotation","-50 0 0")
  panel.setAttribute("position","0 -1 -0.3")
  panel.addEventListener("click",function(){
    console.log("EMITED")
    goTo('./templates/batInfo.html')
  })
  panel.setAttribute("animationcustom")
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
  link.href ='./assets/styles/style.css';
  document.getElementsByTagName('HEAD')[0].appendChild(link);
}
