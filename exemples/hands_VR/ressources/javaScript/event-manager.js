AFRAME.registerComponent('event-manager', {
    init: function() {
        this.bindMethods();
        this.darkModeButtonEl = document.querySelector('#darkModeButton');
        this.darkModeButtonEl.addEventListener('click', this.onClick);
    },
    bindMethods: function() {
        this.onClick = this.onClick.bind(this);
    },
    onClick: function(evt) {
    var targetEl = evt.target;
    if (targetEl === this.darkModeButtonEl) {
      // logic for map acces
      // ex :
      // goTo('plan.html')
    }
    else {
      console.log("Logic to add")
    }
  }
});
