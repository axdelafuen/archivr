AFRAME.registerComponent('pinchbar', {
  init: function() {
    this.el.addEventListener("pinchedmoved",this.pinchMoved);
    this.el.setAttribute('pinchable', {
            pinchDistance: 0.1
    });
  },
  pinchMoved: function(evt){
    var el = this.el;
    console.log("In the function")
    var localPosition = this.localPosition;
    localPosition.copy(evt.detail.position);
    el.object3D.updateMatrixWorld();
    el.object3D.worldToLocal(localPosition);
    
    this.pickerEl.object3D.position.x = localPosition.x;
    this.pickerEl.object3D.position.y = localPosition.y;
  }
});
