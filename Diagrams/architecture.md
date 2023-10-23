```plantuml
title "Architecture :"

left to right direction

frame "ArchiVR" {



cloud Server #aliceblue;line:blue;line.dotted;text:blue{

node webApp as "Web App" #lightgrey

node generator as "Generator" #lightgrey

node api as "Web API" #lightgrey

database db as "Database"#lightgray{
artifact datas
}
}


webApp --> api
webApp -> generator
api --> datas

}
```