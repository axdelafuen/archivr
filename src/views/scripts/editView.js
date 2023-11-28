function sliderChanged(slider, id) {
    slider.parentNode.querySelector("span").innerHTML = slider.value

    output = slider.parentNode.parentNode.querySelectorAll("input")

    position = ""

    output.forEach(pos => {
        position = position + pos.value.toString() + " "
    })
    document.getElementById(id).setAttribute("position", position)
}

function sliderChangedScale(slider, id) {
    slider.parentNode.querySelector("span").innerHTML = slider.value

    scale = "" + slider.value + " " + slider.value + " " + slider.value;

    document.getElementById(id).setAttribute("scale", scale);
}

function sliderChangedRotation(slider, id) {
    slider.parentNode.querySelector("span").innerHTML = slider.value
    
    output = slider.parentNode.parentNode.querySelectorAll("input")

    rotation = ""

    output.forEach(pos => {
        rotation = rotation + pos.value.toString() + " "
    })

    document.getElementById(id).setAttribute("rotation", rotation)
}

function changeRotationX() {
    document.querySelectorAll(".elementRotationX").forEach(element => {
        element.setAttribute("value", document.getElementById("rotationX").value.toString())
    })
}

function changeRotationY() {
    document.querySelectorAll(".elementRotationY").forEach(element => {
        element.setAttribute("value", document.getElementById("rotationY").value.toString())
    })
}

function changeRotationZ() {
    document.querySelectorAll(".elementRotationZ").forEach(element => {
        element.setAttribute("value", document.getElementById("rotationZ").value.toString())
    })
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

function changeScale(){
    document.querySelectorAll(".elementScale").forEach(element => {
        element.setAttribute("value", document.getElementById("scale").value.toString())
    })
}