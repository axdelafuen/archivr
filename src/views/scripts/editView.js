function sliderChanged(slider, id) {
    slider.parentNode.querySelector("span").innerHTML = slider.value

    output = slider.parentNode.parentNode.querySelectorAll("input")

    position = ""

    output.forEach(pos => {
        position = position + pos.value.toString() + " "
    })
    document.getElementById(id).setAttribute("position", position)
}

function sliderChangedX(){
    document.querySelectorAll(".elementPositionX").forEach(element => {
        element.setAttribute("value", document.getElementById("positionX").value.toString())
    })
}

function sliderChangedY(){
    document.querySelectorAll(".elementPositionY").forEach(element => {
        element.setAttribute("value", document.getElementById("positionY").value.toString())
    })
}

function sliderChangedZ(){
    document.querySelectorAll(".elementPositionZ").forEach(element => {
        element.setAttribute("value", document.getElementById("positionZ").value.toString())
    })
}