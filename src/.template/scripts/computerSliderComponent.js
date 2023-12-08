//////////////////////
//  SLIDER HANDLING //
//////////////////////
let yearsVector = 0
let maxValue = 0 
let step
let arrayViews = []


AFRAME.registerComponent('thumbstick-logging',{
  init: function () {
    this.el.addEventListener('thumbstickmoved', this.logThumbstick);
    this.el.addEventListener('xbuttondown',this.xButtonListener)
  },
  logThumbstick: function (evt) {
    if(arrayViews.length === 4)
    {
      maxValue = 300
      step = 7
    }
    else
    {
      maxValue = 100
      step = 2
    }
    let minValue = 0
    
    if (evt.detail.x < -0.80) {
      if(yearsVector < maxValue){
        yearsVector=(yearsVector+step)
        computerOpacityHandler(yearsVector)
      }
    }
    if (evt.detail.x > 0.80) {
      if(yearsVector > minValue){
        yearsVector=(yearsVector-step)
        computerOpacityHandler(yearsVector)
      }   
    }
  },

  // To change
  xButtonListener: function(evt){
    goTo("templates/planPrincipal.html","0 0 0")
  }
});


AFRAME.registerComponent('sliderelement',{
  init: function(){
    let el = this.el
    arrayViews.push(el)
  },
  remove: function(){
    let el = this.el
    arrayViews = arrayRemove(arrayViews,el)
  }
})



document.addEventListener("keydown",(event)=>{ 
  let key = event.key
  let maxValue
  let step
  if(arrayViews.length === 4)
  {
    maxValue = 300
    step = 17
  }
  else
  {
    maxValue = 100
    step = 5
  }
  let minValue = 0
  
  if(key === "ArrowRight")
  {
    if(yearsVector < maxValue){
      yearsVector=(yearsVector+step)
      computerOpacityHandler(yearsVector)
    }
  }
  else if(key === "ArrowLeft")
  {
    if(yearsVector > minValue){
      yearsVector=(yearsVector-step)
      computerOpacityHandler(yearsVector)
    }
  }
})


function changeOpa2pics(value)
{

  value = value*0.01
  let view1 = arrayViews[0]
  let view2 = arrayViews[1]
  
  if(value.toFixed(2) == 1.00)
  {
    view1.setAttribute("opacity","0.01")
    view2.setAttribute("opacity","0.99")
  }
  else{
    let className1 = view1.getAttribute("class")
    setOpacity(className1,(1-value).toFixed(2))
    
    let className2 = view2.getAttribute("class")
    setOpacity(className2,value.toFixed(2))
  }
}


function changeOpa3Pics(value)
{
  if(value>50){
    let view1 = arrayViews[1]
    let view2 = arrayViews[2]

    view1.setAttribute("visible","true")
    view2.setAttribute("visible","true")

    let percentil = (value - 50)*0.02
    if(percentil == 1)
    {
      view1.setAttribute("visible","false")
    }
    else
    {
      let className1 = view1.getAttribute("class")
      setOpacity(className1,1-percentil)
      
      let className2 = view2.getAttribute("class")
      setOpacity(className2,percentil)
    }
  }
  else{

    let view1 = arrayViews[0]
    let view2 = arrayViews[1]


    arrayViews[2].setAttribute("visible","false")
    view1.setAttribute("visible","true")

    let percentil = value*0.02
    if(percentil === 1)
    {
      view1.setAttribute("visible","false")
    }
    else
    {
      let className1 = view1.getAttribute("class")
      setOpacity(className1,1-percentil)
      
      let className2 = view2.getAttribute("class")
      setOpacity(className2,percentil)
    }
  }
}


function changeOpa4Pics(value)
{
  if(value>200){
    let percentil = (value-200)*0.01
    

    let view1 = arrayViews[2]
    let view2 = arrayViews[3]
    
    view1.setAttribute("visible","true")
    view2.setAttribute("visible","true")
    arrayViews[1].setAttribute("visible","false")

    let className1 = view1.getAttribute("class")
    setOpacity(className1,1-percentil)
    
    let className2 = view2.getAttribute("class")
    setOpacity(className2,percentil)
}
  else if(value>100){
    let percentil = (value-100)*0.01
    console.log(percentil)

    let view1 = arrayViews[1]
    let view2 = arrayViews[2]
  
    view1.setAttribute("visible","true")
    view2.setAttribute("visible","true")

    arrayViews[0].setAttribute("visible","false")
    arrayViews[3].setAttribute("visible","false")

    let className1 = view1.getAttribute("class")
    setOpacity(className1,1-percentil)
    
    let className2 = view2.getAttribute("class")
    setOpacity(className2,percentil)
  }
  else{
    let percentil = value*0.01

    let view1 = arrayViews[0]
    let view2 = arrayViews[1]
    
    view1.setAttribute("visible","true")
    view2.setAttribute("visible","true")
    arrayViews[2].setAttribute("visible","false")
    

    let className1 = view1.getAttribute("class")
    setOpacity(className1,1-percentil)
    
    let className2 = view2.getAttribute("class")
    setOpacity(className2,percentil)
  }
}


function computerOpacityHandler(value)
{
  let size = arrayViews.length
  // if(size === 5)changeOpa5Pics(value)
  if(size === 4)changeOpa4Pics(value)
  else if(size === 3)changeOpa3Pics(value)
  else if(size ===2)changeOpa2pics(value)
}

function setOpacity(className,value)
{
  let elementArray = document.querySelectorAll("."+className)
  elementArray.forEach(element => {
    element.setAttribute("opacity",value)
  });
}
