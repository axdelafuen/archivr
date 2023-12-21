AFRAME.registerComponent('button-vr', {
  schema:{
    class1: {default: 'none'},
    class2: {default: 'none'},
    class3: {default: 'none'},
    class4: {default: 'none'}
  },
  init: function() {
    // Adding button depending on number of temporality (4 max)
    if(!AFRAME.utils.device.checkHeadsetConnected ())return
    if(this.data.class1 !== 'none'){
      let emptyPane = document.createElement("a-entity")
      emptyPane.setAttribute("position","0 -0.030 -0.015")
      let img = document.createElement("a-image")
      img.setAttribute("src","./ressources/assets/emptyPane.png")
      emptyPane.append(img)

      let button1 = document.createElement("a-box")
      button1.setAttribute("class","pressable")
      button1.setAttribute("position","-0.332 0.280 -0.006")
      button1.setAttribute("scale","0.05 0.05 0.05")
      button1.setAttribute("color","yellow")
      button1.setAttribute("onclick","mobileOpacityHandler('class1')")
      let text1 = document.createElement("a-text")
      text1.setAttribute("scale","0.1 0.1 0.1")
      text1.setAttribute("color","black")
      text1.setAttribute("value",this.data.class1)
      text1.setAttribute("position","-0.294 0.282 0.006")
      
      this.el.append(emptyPane)
      this.el.append(button1)
      this.el.append(text1)
    }
    if(this.data.class2 !== 'none'){
      let button2 = document.createElement("a-box")
      button2.setAttribute("class","pressable")
      button2.setAttribute("position","-0.332 0.147 -0.007")
      button2.setAttribute("scale","0.05 0.05 0.05")
      button2.setAttribute("color","yellow")
      button2.setAttribute("onclick","mobileOpacityHandler('class2')")
      let text2 = document.createElement("a-text")
      text2.setAttribute("scale","0.1 0.1 0.1")
      text2.setAttribute("color","black")
      text2.setAttribute("value",this.data.class2)
      text2.setAttribute("position","-0.294 0.138 0.004")
      
      this.el.append(button2)
      this.el.append(text2)     
    }
    if(this.data.class3 !== 'none'){
      let button3 = document.createElement("a-box")
      button3.setAttribute("class","pressable")
      button3.setAttribute("position","-0.005 0.280 -0.006")
      button3.setAttribute("scale","0.05 0.05 0.05")
      button3.setAttribute("color","yellow")
      button3.setAttribute("onclick","mobileOpacityHandler('class3')")
      let text3 = document.createElement("a-text")
      text3.setAttribute("scale","0.1 0.1 0.1")
      text3.setAttribute("color","black")
      text3.setAttribute("value",this.data.class3)
      text3.setAttribute("position","0.021 0.282 0.006")
      
      this.el.append(button3)
      this.el.append(text3)     
    }
    if(this.data.class4 !== 'none'){
      let button4 = document.createElement("a-box")
      button4.setAttribute("class","pressable")
      button4.setAttribute("position","-0.005 0.147 -0.007")
      button4.setAttribute("scale","0.05 0.05 0.05")
      button4.setAttribute("color","yellow")
      button4.setAttribute("onclick","mobileOpacityHandler('class4')")
      let text4 = document.createElement("a-text")
      text4.setAttribute("scale","0.1 0.1 0.1")
      text4.setAttribute("color","black")
      text4.setAttribute("value",this.data.class4)
      text4.setAttribute("position","0.021 0.138 0.004")
      
      this.el.append(button4)
      this.el.append(text4)     
    }
  },
});




const HTMLPHONE = `
<a-entity>
    <a-box scale="0.05 0.05 0.05" position="-0.332 0.147 -0.007" color="yellow" onclick="mobileOpacityHandler('class2')"></a-box>
    <a-text scale="0.1 0.1 0.1" color="black" value="Years \: 30333" id="button2" position="-0.294 0.138 0.004"></a-text>
</a-entity>
  
<a-entity>
    <a-box scale="0.05 0.05 0.05" position="-0.005 0.280 -0.006" color="yellow" onclick="mobileOpacityHandler('class3')"></a-box>
  <a-text scale="0.1 0.1 0.1" color="black" value="Years \: 2022" id="button3" position="0.021 0.282 0.006"></a-text>
</a-entity>

<a-entity>
  <a-box scale="0.05 0.05 0.05" position="-0.005 0.147 -0.007" color="yellow" onclick="mobileOpacityHandler('class4')"></a-box>
  <a-text scale="0.1 0.1 0.1" color="black" value="Years \: 1999" id="button4" position="0.021 0.282 0.006"></a-text>
</a-entity>
`
