AFRAME.registerComponent('event-manager', {
    init: function() {
        this.bindMethods();
        this.map = document.querySelector('#map');
        this.map.addEventListener('click', this.onClick);
    },
    bindMethods: function() {
        this.onClick = this.onClick.bind(this);
    },
    onClick: function(evt) {
    var targetEl = evt.target;
    if (targetEl === this.map) {
      goTo('base.html')
    }
    else {
      console.log("Logic to add")
    }
  }
});
