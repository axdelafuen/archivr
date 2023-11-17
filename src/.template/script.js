///////////////
// FONCTIONS //
///////////////
function updateSlider()
{
  
}
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

////////////////////////
// COMPONENTS A-FRAME //
////////////////////////

AFRAME.registerComponent('animationcustom', {
    init: async function () {
    this.el.setAttribute("animation","property: opacity; from: 0.0; to: 1.0; dur: 1000")
    if(this.el.parentNode.id === "base"){
      this.el.setAttribute("animation","property: opacity; from: 1.0; to: 0.0;startEvents: startanim; dur: 1000")
    }
  },
});


AFRAME.registerComponent('clickcontroller', {
  init: function () {
    this.el.addEventListener('triggerdown', this.logThumbstick);
  },
  logThumbstick: function (evt) {
    document.querySelector("a-box").setAttribute("color","red")
    evt.detail.el.getIntersection.setAttribute("color","purple")
  }
})

//
// AFRAME.registerComponent('cursor-listener', {
//     init: function () {
//       this.el.addEventListener('raycaster-intersected', evt => {
//         this.raycaster = evt.detail.el;
//       });
//       this.el.addEventListener('raycaster-intersected-cleared', evt => {
//         this.raycaster = null;
//       });
//     },
//     tick: function () {
//         if (!this.raycaster) { return; }  // Not intersecting.
//         let intersection = this.raycaster.components.raycaster.getIntersection(this.el);
//         this.raycaster.components.raycaster.far = intersection.distance
//         if (!intersection) { return; } // Not intersecting
//         // intersecting
//         console.log(intersection);
//     }
//   });

let arrayViews = []
AFRAME.registerComponent('sliderelement',{
  init: function(){
    let el = this.el
    arrayViews.push(el)
    console.log(arrayViews)
    updateSlider()
  },
  remove: function(){
    let el = this.el
    arrayViews = arrayRemove(arrayViews,el)
    console.log(arrayViews)
  }
})

AFRAME.registerComponent('map',{
  remove: function(){
    document.querySelector("#camera").setAttribute("look-controls","enabled: true; mouseEnabled: true");
  },
  init: function(){
    document.querySelector("#camera").setAttribute("rotation","0 0 0");
    document.querySelector("#camera").setAttribute("look-controls","enabled: false; mouseEnabled: false");
  }
})