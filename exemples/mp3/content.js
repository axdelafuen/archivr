
function fadeIn(group="default")
{
  let elements = document.querySelectorAll("."+group)
  elements.forEach(Element => {
    Element.setAttribute("animation"," property: opacity;from:0.0;to: 1.0; dur: 500")
  });
}

function fadeOut(group="default")
{
  let elements = document.querySelectorAll("."+group)
  elements.forEach(element => {
    let opa = element.getAttribute("opacity")
    element.setAttribute("animation"," property: opacity;from:"+opa +";to: 0.0; dur: 500")
  });
}

function soundhandler(element,src){
  let sound = element.getAttribute("sound")
  // Si l'attribut sound n'est pas set, alors on lance le son
  // Sinon on coupe la lecture et supprime l'attribut
  if(!sound)
  {
    // Permet de supprimer tous les sons en cours de lecture. 
    let arraySound = document.querySelectorAll('[sound]')
    arraySound.forEach(mp3 => {
    mp3.components.sound.stopSound()
    mp3.removeAttribute("sound")
  });
  

    element.setAttribute("sound","src: "+src)
    element.components.sound.playSound();
  }
  else {
    element.components.sound.stopSound();
    element.removeAttribute("sound")
  }
   

} 

AFRAME.registerComponent('fades', {
  init: function(){
    let element = this.el
    element.setAttribute("opacity","0.0")
    if(!element.getAttribute("class")){
      element.setAttribute("class","default")
    }
  }
})

