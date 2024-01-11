////////////////////////
// COMPONENTS A-FRAME //
////////////////////////

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

/*
AFRAME.registerComponent('animationcustom',{
  init: function(){
    this.el.setAttribute("animation","property:opacity;from:0.0;to:1.0;dur:1000")
  }
})
*/

