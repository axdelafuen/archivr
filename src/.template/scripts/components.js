// Lock camera movement when only on map
AFRAME.registerComponent('map',{
  remove: function(){
    // On remove, enabled look-controls component which gives back the posibility to move the camera againj
    document.querySelector("#camera").setAttribute("look-controls","enabled: true; mouseEnabled: true");
  },
  init: function(){
    // If a map is added in the html, set camera's rotation to 0 0 0 and disabled camera's movement
    if(!AFRAME.utils.device.isMobile ())
    {
      document.querySelector("#camera").setAttribute("look-controls","enabled: false; mouseEnabled: false");
    }
    document.querySelector("#camera").setAttribute("rotation","0 0 0");
  }
})

// Create a fadeIn animation
AFRAME.registerComponent('animationcustom',{
  init: function(){
    this.el.setAttribute("animation","property:opacity;from:0.0;to:1.0;dur:1000")
  }
})

AFRAME.registerComponent('houdini',{
  init: function(){
    this.visibility = false
  }
})
