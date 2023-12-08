////////////////////////
// COMPONENTS A-FRAME //
////////////////////////

// Lock camera movement when only on map
AFRAME.registerComponent('map',{
  remove: function(){
    document.querySelector("#camera").setAttribute("look-controls","enabled: true; mouseEnabled: true");
  },
  init: function(){
    if(!AFRAME.utils.device.isMobile ())
    {
      document.querySelector("#camera").setAttribute("look-controls","enabled: false; mouseEnabled: false");
    }
    document.querySelector("#camera").setAttribute("rotation","0 0 0");
  }
})

/*
AFRAME.registerComponent('animationcustom',{
  init: function(){
    this.el.setAttribute("animation","property:opacity;from:0.0;to:1.0;dur:1000")
  }
})
*/

