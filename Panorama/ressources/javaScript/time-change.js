// update opacity depenting on slider 3d element's value (unused)
AFRAME.registerComponent('time-change', {
    init: function() {
      this.bindMethods();
      this.el.sceneEl.addEventListener('sliderchanged', this.onSliderChanged);
    },
    bindMethods: function() {
        this.onSliderChanged = this.onSliderChanged.bind(this);
    },
    onSliderChanged: function(evt) {
      if(arrayViews.length === 4)
      {
        yearsVector = evt.detail.value * 300
      }
      else
      {
        yearsVector = evt.detail.value * 100
      }
      computerOpacityHandler(yearsVector)
    }
});
