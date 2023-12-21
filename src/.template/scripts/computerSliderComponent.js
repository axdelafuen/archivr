//////////////////////
//  SLIDER HANDLING //
//////////////////////
let yearsVector = 0
let maxValue = 0 
let step
let arrayViews = []

// Add event listener occulus handling 
// x button and left joystick
AFRAME.registerComponent('thumbstick-logging',{
  init: function () {
    this.el.addEventListener('thumbstickmoved', this.logThumbstick);
    this.el.addEventListener('xbuttondown',this.xButtonListener)
  },
  // compute yearsVector depending on thumbstick direction
  // yearsVector : store slider value
  // step : incrise step to go throught temporality faster
  // arrayview : contains all temporality's a-sky balise
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
  // Must be edited during panorama generation to point on the right place
  xButtonListener: function(){
    goTo("test.html","0 0 0")
  }
});

// Add each a-sky on arrayViews array
// And remove it on deletion
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

// Event handling for computer device
// listen to arrow keys for the slider
// M key to go on map (must be also edited during the panorama's generation)
document.addEventListener("keydown",(event)=>{ 
  let key = event.key
  if(key === "m")
  {
    // to change dynamicaly
    goTo("test.HTML","0 0 0")
  }
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

// Function to change element's opacity when there is 2 temporalities
function changeOpa2pics(value)
{
  // This function recieve a value between 0 and 100
  // Get the value to set opacity -> between 0 and 1
  value = value*0.01
  let view1 = arrayViews[0]
  let view2 = arrayViews[1]
  // Fix an A-frame bug when opacity is set to exactly 0 and 1, it doesn't work at all
  // If the value is close to 1 then show all second temporality's elements and hide other element
  if(value.toFixed(2) > 0.95)
  {
    view2.setAttribute("opacity","0.99")
    setOpacity(view1.getAttribute("class"),false)
    setOpacity(view2.getAttribute("class"),true)
  }
  // If the value is close to 0 then show all first temporality's elements and hide other element
  else if(value.toFixed(2)<0.05)
  {
    setOpacity(view1.getAttribute("class"),true)
    setOpacity(view2.getAttribute("class"),false) 
  }
  else{
    view1.setAttribute("opacity",(1-value).toFixed(2))
    view2.setAttribute("opacity",value.toFixed(2))
  }
}


// Function to change element's opacity when there is 3 temporalities
function changeOpa3Pics(value)
{
  // set opacity for sky N°2 and 3
  if(value>50){
    let view1 = arrayViews[1]
    let view2 = arrayViews[2]

    view1.setAttribute("visible","true")
    view2.setAttribute("visible","true")

    let percentil = (value - 50)*0.02
    if(percentil > 0.95)
    {
      view1.setAttribute("opacity","0.01")
      view2.setAttribute("opacity","0.99")
      setOpacity(view1.getAttribute("class"),false)
      setOpacity(view2.getAttribute("class"),true)
    }
    else if(percentil < 0.10){
      view1.setAttribute("opacity","0.99")
      view2.setAttribute("opacity","0.01")
      setOpacity(view1.getAttribute("class"),true)
      setOpacity(view2.getAttribute("class"),false) 
    }
    else
    {
      view1.setAttribute("opacity",1-percentil)
      view2.setAttribute("opacity",percentil)
    }
  }
  // set opacity for sky N°1 and 2
  else{

    let view1 = arrayViews[0]
    let view2 = arrayViews[1]

    setOpacity(arrayViews[2].getAttribute("class"),false)
    view1.setAttribute("visible","true")

    let percentil = value*0.02
    if(percentil > 0.95)
    {
      view1.setAttribute("opacity","0.01")
      view2.setAttribute("opacity","0.99")
      setOpacity(view1.getAttribute("class"),false)
      setOpacity(view2.getAttribute("class"),true)
    }
    else if(percentil < 0.05){
      
      view1.setAttribute("opacity","0.99")
      view2.setAttribute("opacity","0.01")
      setOpacity(view1.getAttribute("class"),true)
      setOpacity(view2.getAttribute("class"),false) 
    }
    else
    {
      view1.setAttribute("opacity",1-percentil)
      view2.setAttribute("opacity",percentil)
    }
  }
}


// Function to change element's opacity when there is 4 temporalities
// this function recieve a value between 0 and 200 in order to get an easier calcul for opacity
function changeOpa4Pics(value)
{
    // set opacity for sky N°3 and 4
  if(value>200){
    let percentil = (value-200)*0.01
    let view1 = arrayViews[2]
    let view2 = arrayViews[3]
    setOpacity(arrayViews[0].getAttribute("class"),false)
    setOpacity(arrayViews[1].getAttribute("class"),false)

    arrayViews[1].setAttribute("visible","false")
    
    view1.setAttribute("visible","true")
    view2.setAttribute("visible","true")
    
    if(percentil > 0.95)
    {
      setOpacity(view1.getAttribute("class"),false)
      setOpacity(view2.getAttribute("class"),true)
    }
    else if(percentil < 0.05)
    {
      setOpacity(view1.getAttribute("class"),true)
      setOpacity(view2.getAttribute("class"),false)
    }
    
    view1.setAttribute("opacity",1-percentil)
    view2.setAttribute("opacity",percentil)
}
  else if(value>100){
    let percentil = (value-100)*0.01
    let view1 = arrayViews[1]
    let view2 = arrayViews[2]
  
    arrayViews[0].setAttribute("visible","false")
    arrayViews[3].setAttribute("visible","false")

    setOpacity(arrayViews[0].getAttribute("class"),false)
    setOpacity(arrayViews[3].getAttribute("class"),false)

    view1.setAttribute("visible","true")
    view2.setAttribute("visible","true")

    if(percentil > 0.95)
    {
      setOpacity(view1.getAttribute("class"),false)
      setOpacity(view2.getAttribute("class"),true)
    }
    else if(percentil < 0.05)
    {
      setOpacity(view1.getAttribute("class"),true)
      setOpacity(view2.getAttribute("class"),false)
    }
    view1.setAttribute("opacity",1-percentil)
    view2.setAttribute("opacity",percentil)
  }
  else{
    let percentil = value*0.01

    let view1 = arrayViews[0]
    let view2 = arrayViews[1]
    
    view1.setAttribute("visible","true")
    view2.setAttribute("visible","true")
    arrayViews[2].setAttribute("visible","false")
    setOpacity(arrayViews[2].getAttribute("class"),false)
    
    if(percentil > 0.95)
    {
      setOpacity(view1.getAttribute("class"),false)
      setOpacity(view2.getAttribute("class"),true)
    }
    else if(percentil < 0.05)
    {
      setOpacity(view1.getAttribute("class"),true)
      setOpacity(view2.getAttribute("class"),false)
    }
    view1.setAttribute("opacity",1-percentil)
    view2.setAttribute("opacity",percentil)
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
  console.log(elementArray)
  console.log(value)
  elementArray.forEach(element => {
    if(element.nodeName !== "A-SKY")
    element.setAttribute("visible",value)
  });
}
