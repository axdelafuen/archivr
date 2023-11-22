
//////////////////////
//  SLIDER HANDLING //
//////////////////////

let arrayViews = []
AFRAME.registerComponent('sliderelement',{
  init: function(){
    let el = this.el
    arrayViews.push(el)
  },
  remove: function(){
    let el = this.el
    arrayViews = arrayRemove(arrayViews,el)
    // console.log(arrayViews)
  }
})


var yearsVector = 0
document.addEventListener("keydown",(event)=>{ 
  let maxValue
  let step
  console.log("Keydown")
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
  let key = event.key
  
  if(key === "ArrowRight")
  {
    if(yearsVector < maxValue){
      yearsVector=(yearsVector+step)
      opacityHandler(yearsVector)
    }
  }
  else if(key === "ArrowLeft")
  {
    if(yearsVector > minValue){
      yearsVector=(yearsVector-step)
      opacityHandler(yearsVector)
    }
  }
})


function changeOpa2pics(value)
{

  value = value*0.01
  let paysage1 = arrayViews[0]
  let paysage2 = arrayViews[1]
  
  if(value.toFixed(2) == 1.00)
  {
    paysage1.setAttribute("opacity","0.01")
    paysage2.setAttribute("opacity","0.99")
  }
  else{
    paysage1.setAttribute("opacity",(1-value).toFixed(2))
    paysage2.setAttribute("opacity",value.toFixed(2));
  }
}


function changeOpa3Pics(value)
{
  if(value>50){
    let paysage1 = arrayViews[1]
    let paysage2 = arrayViews[2]

    paysage1.setAttribute("visible","true")
    paysage2.setAttribute("visible","true")

    let percentil = (value - 50)*0.02
    if(percentil == 1)
    {
      paysage1.setAttribute("visible","false")
    }
    else
    {
      paysage1.setAttribute("opacity",1-percentil)
      paysage2.setAttribute("opacity",percentil)
    }
  }
  else{

    let paysage1 = arrayViews[0]
    let paysage2 = arrayViews[1]


    arrayViews[2].setAttribute("visible","false")
    paysage1.setAttribute("visible","true")

    let percentil = value*0.02
    if(percentil === 1)
    {
      paysage1.setAttribute("visible","false")
    }
    else
    {
      paysage1.setAttribute("opacity",1-percentil)
      paysage2.setAttribute("opacity",percentil)
    }
  }
}


function changeOpa4Pics(value)
{
  if(value>200){
    let percentil = (value-200)*0.01
    

    let paysage1 = arrayViews[2]
    let paysage2 = arrayViews[3]
    
    paysage1.setAttribute("visible","true")
    paysage2.setAttribute("visible","true")
    arrayViews[1].setAttribute("visible","false")


    paysage1.setAttribute("opacity",1-percentil)
    paysage2.setAttribute("opacity",percentil)
  }
  else if(value>100){
    let percentil = (value-100)*0.01
    console.log(percentil)

    let paysage1 = arrayViews[1]
    let paysage2 = arrayViews[2]
  
    paysage1.setAttribute("visible","true")
    paysage2.setAttribute("visible","true")

    arrayViews[0].setAttribute("visible","false")
    arrayViews[3].setAttribute("visible","false")

    paysage1.setAttribute("opacity",1-percentil)
    paysage2.setAttribute("opacity",percentil)   
  }
  else{
    let percentil = value*0.01

    let paysage1 = arrayViews[0]
    let paysage2 = arrayViews[1]
    
    paysage1.setAttribute("visible","true")
    paysage2.setAttribute("visible","true")
    arrayViews[2].setAttribute("visible","false")
    

    paysage1.setAttribute("opacity",1-percentil)
    paysage2.setAttribute("opacity",percentil)
  }
}

function opacityHandler(value)
{
  let skyArray = document.querySelectorAll("a-sky")
  let size = skyArray.length
  if(size === 5)changeOpa5Pics(value)
  else if(size === 4)changeOpa4Pics(value)
  else if(size === 3)changeOpa3Pics(value)
  else changeOpa2pics(value)
}
