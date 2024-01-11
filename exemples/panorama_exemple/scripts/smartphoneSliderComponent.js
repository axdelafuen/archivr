function mobileOpacityHandler(value)
{
  let arrayElements = document.querySelectorAll("."+value)
  arrayViews.forEach(element =>{
    // récup class
    let classe = element.getAttribute("class")
    let falseValue = document.querySelectorAll("."+classe)
    falseValue.forEach(element=>{
      element.setAttribute("visible","false")
    })
  })
  arrayElements.forEach(element => {
    element.setAttribute("visible","true")
    element.setAttribute("opacity","1.0")
  });
}
