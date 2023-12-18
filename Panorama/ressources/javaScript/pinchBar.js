AFRAME.registerComponent('pinchbar', {
  init: function() {
    this.localPositionValue = new THREE.Vector3();
    this.el.setAttribute('pinchable', {
            pinchDistance: 0.1
    });
    this.pinchMoved = this.pinchMoved.bind(this);
    this.el.addEventListener("pinchedmoved",this.pinchMoved);
  },
  pinchMoved: function(evt){
    var el = this.el;
    debug()
    var halfWidth = this.data.width / 2;
    var localPosition = this.localPosition;
    localPosition.copy(evt.detail.position);
    el.object3D.updateMatrixWorld();
    el.object3D.worldToLocal(localPosition);
    if (localPosition.x < -halfWidth || localPosition.x > halfWidth) {
      return;
    }
    el.object3D.position.x = localPosition.x;
    el.object3D.position.z = localPosition.z;
  }
});
