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

// Lock camera movement when only on map
AFRAME.registerComponent('map',{
  remove: function(){
    document.querySelector("#camera").setAttribute("look-controls","enabled: true; mouseEnabled: true");
  },
  init: function(){
    document.querySelector("#camera").setAttribute("rotation","0 0 0");
    document.querySelector("#camera").setAttribute("look-controls","enabled: false; mouseEnabled: false");
  }
})


AFRAME.registerComponent('clickcontroller', {
  init: function () {
    this.el.addEventListener('triggerdown', this.logThumbstick);
  },
  logThumbstick: function (evt) {
    // Quand il appuis, abonne à tous les éléments l'évent "raycaster-intersected" et quand il est emis, alors exec le onclick
    document.querySelector("a-box").setAttribute("color","red")
    evt.detail.el.getIntersection.setAttribute("color","purple")
  },
  thumbstickup: function(evt){
    // Enlève l'évent raycaster-intersected des éléments
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
