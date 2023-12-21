AFRAME.registerComponent('menu', {
  init: function() {
    var el = this.el;
    var menuBackGroundEl = document.createElement('a-entity');
    menuBackGroundEl.setAttribute('geometry', {
      primitive: 'box',
      width: 0.3,
      height: 0.10,
      depth: 0.01
    });
    menuBackGroundEl.setAttribute('material', {
    color: 'gray',
    opacity: 0.4
    });
    menuBackGroundEl.setAttribute('position', '0 0 -0.025');
    el.appendChild(menuBackGroundEl);
  },
});
